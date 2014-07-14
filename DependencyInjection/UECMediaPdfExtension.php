<?php

namespace UEC\MediaPdfBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class UECMediaPdfExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load(sprintf('%s.xml', $container->getParameter('uec_media.db_driver')));

        $container->setParameter('uec_media_pdf.model.pdf.class', $config['model']['pdf']);
        $container->setParameter('uec_media_pdf.model.pdf_image.class', $config['model']['pdf_image']);
        $container->setParameter('uec_media_pdf.ocr_enabled', $config['ocr']['enabled']);
        $container->setParameter('uec_media_pdf.extract_mode', $config['extract_mode']);
        $container->setParameter('uec_media_pdf.extract_limit', $config['extract_limit']);
        $container->setParameter('uec_media_pdf.extract_quality', $config['extract_quality']);
        $container->setParameter('uec_media_pdf.base_file_path', $config['base_file_path']);
        $container->setParameter('uec_media_pdf.form_name', $config['form_name']);


        $ocrService = $config['ocr']['service'];

        if ($config['ocr']['enabled']) {
            if (null === $ocrService) {
                throw new \Exception('OCR service must be defined');
            } else {
                $container->setParameter('uec_media_pdf.ocr.tesseract.temp_dir', $config['ocr']['services']['tesseract']['temp_dir']);
                $container->setParameter('uec_media_pdf.ocr.xpdf.bin', $config['ocr']['services']['xpdf']['bin']);
                $container->setParameter('uec_media_pdf.ocr.xpdf.timeout', $config['ocr']['services']['xpdf']['timeout']);

                if (array_key_exists($ocrService, $config['ocr']['services'])) {
                    $ocrService = $config['ocr']['services'][$ocrService]['service'];
                }

                $container->setAlias('uec_media_pdf.ocr', $ocrService);
                $loader->load('ocr.xml');
            }
        }

        $container->setAlias('uec_media_pdf.cdn', $config['cdn']);
        $container->setAlias('uec_media_pdf.file_system', $config['file_system']);
        $container->setAlias('uec_media_pdf.form_processor', $config['form_processor']);
        $container->setAlias('uec_media_pdf.model_manager', $config['model_manager']);
        $container->setAlias('uec_media_pdf.parser', $config['parser']);

        $loader->load('cdn.xml');
        $loader->load('file_system.xml');
        $loader->load('form.xml');
        $loader->load('handler.xml');
        $loader->load('parser.xml');
        $loader->load('provider.xml');
    }
}
