<?php

namespace UEC\MediaPdfBundle\Form;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use UEC\MediaBundle\FileSystem\FileInfoInterface;
use UEC\MediaBundle\Form\FormProcessorInterface;
use UEC\MediaPdfBundle\FileSystem\FileInfo;

class FormProcessor implements FormProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getFileInfo($file)
    {
        if (null === $file) {
            return new FileInfo();
        }

        if ($file instanceof UploadedFile) {
            return new FileInfo($file);
        } else {
            throw new \Exception('File type is not supported');
        }
    }
} 