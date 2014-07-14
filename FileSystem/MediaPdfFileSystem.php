<?php

namespace UEC\MediaPdfBundle\FileSystem;

use UEC\MediaBundle\FileSystem\FileInfoInterface;
use UEC\MediaBundle\FileSystem\FileSystemInterface;
use UEC\MediaBundle\Model\MediaProviderInterface;
use UEC\MediaBundle\Path\PathGeneratorInterface;
use UEC\MediaPdfBundle\ExtractMode;
use UEC\MediaPdfBundle\Handler\PdfProcessHandler;

class MediaPdfFileSystem implements FileSystemInterface
{
    /**
     * @var string
     */
    protected $extractMode;

    /**
     * @var \UEC\MediaPdfBundle\Handler\PdfProcessHandler
     */
    protected $pdfProcessHandler;

    function __construct($extractMode, PdfProcessHandler $pdfProcessHandler)
    {
        $this->extractMode = $extractMode;
        $this->pdfProcessHandler = $pdfProcessHandler;
    }

    /**
     * {@inheritdoc}
     */
    public function upload(FileInfoInterface $fileInfo, MediaProviderInterface $mediaProvider, $filePath)
    {
        if (!$fileInfo->isUploadedFile()) {
            return false;
        }

        if (move_uploaded_file($fileInfo->getTmpName(), $filePath)) {
            $pdfInfo = new PdfInfo();
            $pdfInfo->setSize(filesize($filePath));

            if ($this->extractMode == ExtractMode::RUNTIME) {
                $images = $this->pdfProcessHandler->extractImagesFromFile($filePath);

                $pdfInfo->setImages($images);
                $pdfInfo->setTotalPage(count($images));
                $pdfInfo->setProcessed(true);
            }

            return $pdfInfo;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilePath(FileInfoInterface $fileInfo, MediaProviderInterface $mediaProvider, PathGeneratorInterface $pathGenerator)
    {
        return $pathGenerator->generate($mediaProvider);
    }
} 