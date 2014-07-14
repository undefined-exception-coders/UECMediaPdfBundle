<?php

namespace UEC\MediaPdfBundle\OCR;

class TesseractOCR implements OCRImageInterface
{
    protected $tempDir;

    function __construct($tempDir)
    {
        $this->tempDir = $tempDir;
    }

    /**
     * Get text of an image file
     *
     * @param string $file
     * @return string
     */
    public function getContentFromImg($file)
    {
        $tesseract = new \TesseractOCR($file);
        $tesseract->setTempDir($this->tempDir);

        return $tesseract->recognize();
    }
} 