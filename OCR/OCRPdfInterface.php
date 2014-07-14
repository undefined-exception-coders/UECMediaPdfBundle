<?php

namespace UEC\MediaPdfBundle\OCR;

interface OCRPdfInterface extends OCRInterface
{
    /**
     * Get text of a single page of the file
     *
     * @param string $file
     * @param int $page
     * @return string
     */
    public function getContentFromFile($file, $page);
} 