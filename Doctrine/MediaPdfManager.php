<?php

namespace UEC\MediaPdfBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use UEC\MediaBundle\Model\MediaProviderInterface;
use UEC\MediaBundle\Model\MediaProviderManager;
use UEC\MediaPdfBundle\FileSystem\PdfInfo;
use UEC\MediaPdfBundle\FileSystem\PdfInfoImage;
use UEC\MediaPdfBundle\Model\MediaPdfImageInterface;
use UEC\MediaPdfBundle\Model\MediaPdfInterface;

class MediaPdfManager extends MediaProviderManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $pdfClassName;

    /**
     * @var string
     */
    protected $pdfImageClassName;

    function __construct(EntityManager $em, $pdfClassName, $pdfImageClassName)
    {
        $this->em = $em;
        $this->pdfClassName = $pdfClassName;
        $this->pdfImageClassName = $pdfImageClassName;
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->pdfClassName;
    }

    /**
     * {@inheritdoc}
     */
    public function fillMediaProviderData(MediaProviderInterface &$mediaProvider, $data)
    {
        if ($data instanceof PdfInfo
            && $mediaProvider instanceof MediaPdfInterface
        ) {
            $mediaProvider->setTotalPageNumber($data->getTotalPage());
            $mediaProvider->setSize($data->getSize());
            $mediaProvider->setProcessed($data->getProcessed());
            $mediaProvider->setProcessing(false);

            /** @var $image PdfInfoImage */
            foreach ($data->getImages() as $image) {
                /** @var $mediaPdfImage MediaPdfImageInterface */
                $mediaPdfImage = new $this->pdfImageClassName();
                $mediaPdfImage->setContent($image->getContent());
                $mediaPdfImage->setPath($image->getPath());
                $mediaPdfImage->setPageNumber($image->getPageNumber());
                $mediaPdfImage->setMedia($mediaProvider);

                $mediaProvider->addMediaPdfImage($mediaPdfImage);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function doSaveMediaProvider(MediaProviderInterface $mediaProvider)
    {
        $this->em->persist($mediaProvider);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    protected function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->pdfClassName)->findOneBy($criteria);
    }
}