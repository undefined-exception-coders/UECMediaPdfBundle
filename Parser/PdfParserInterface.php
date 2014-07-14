<?php

namespace UEC\MediaPdfBundle\Parser;

interface PdfParserInterface
{
    /**
     * Extracts a specific page and save it as image file
     *
     * @param string $file
     * @param int $pageNumber
     * @param int $quality
     * @param string $output
     */
    public function extractPageToImg($file, $pageNumber, $quality, $output);

    /**
     * Get the numbers of pages
     *
     * @param string $file
     * @return int
     */
    public function getNumberOfPages($file);
} 