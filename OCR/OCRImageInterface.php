<?php

namespace UEC\MediaPdfBundle\OCR;

interface OCRImageInterface extends OCRInterface
{
    /**
     * Get text of an image file
     *
     * @param string $file
     * @return string
     */
    public function getContentFromImg($file);
} 