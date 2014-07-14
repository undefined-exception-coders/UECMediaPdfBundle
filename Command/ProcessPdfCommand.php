<?php

namespace UEC\MediaPdfBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UEC\MediaPdfBundle\FileSystem\PdfInfoImage;
use UEC\MediaPdfBundle\Model\MediaPdf;
use UEC\MediaPdfBundle\Model\MediaPdfImageInterface;

class ProcessPdfCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('uec_media_pdf:process:unprocessed');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mediaPdfModelName = $this->getContainer()->getParameter('uec_media_pdf.model.pdf.class');
        $repository = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository($mediaPdfModelName);

        $mediaPdf = $repository->findOneBy(array(
            'processed' => false,
            'processing' => false,
        ));

        /** @var $mediaPdf MediaPdf */
        if (null !== $mediaPdf) {
            $basePath = $this->getContainer()->getParameter('uec_media_pdf.base_file_path');
            $filePath = $basePath.'/'.$mediaPdf->getMedia()->getPath();

            if (file_exists($filePath)) {
                $manager = $this->getContainer()->get('uec_media_pdf.model_manager');

                $mediaPdf->setProcessing(true);
                $manager->updateMediaProvider($mediaPdf);

                $images = $this->getContainer()->get('uec_media_pdf.handler.pdf_process')->extractImagesFromFile($filePath);
                $mediaPdfImageClass = $this->getContainer()->getParameter('uec_media_pdf.model.pdf_image.class');

                /** @var $image PdfInfoImage */
                foreach ($images as $image) {
                    /** @var $mediaPdfImage MediaPdfImageInterface */
                    $mediaPdfImage = new $mediaPdfImageClass();
                    $mediaPdfImage->setContent($image->getContent());
                    $mediaPdfImage->setPath(str_replace(rtrim($basePath, '/').'/', '', $image->getPath()));
                    $mediaPdfImage->setPageNumber($image->getPageNumber());

                    $mediaPdf->addMediaPdfImage($mediaPdfImage);
                }

                $mediaPdf->setTotalPageNumber(count($images));
                $mediaPdf->setProcessing(false);
                $mediaPdf->setProcessed(true);

                $manager->updateMediaProvider($mediaPdf);
            }
        }

        $output->writeln('Done!');
    }
} 