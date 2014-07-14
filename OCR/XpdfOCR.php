<?php

namespace UEC\MediaPdfBundle\OCR;

use XPDF\PdfToText;

class XpdfOCR implements OCRPdfInterface
{
    /**
     * @var PdfToText
     */
    protected $xpdf;

    function __construct($bin, $timeout)
    {
        $this->xpdf = PdfToText::create(array(
            'pdftotext.binaries' => $bin,
            'pdftotext.timeout' => $timeout,
        ));
    }

    /**
     * Get text of a single page of the file
     *
     * @param string $file
     * @param int $page
     * @return string
     */
    public function getContentFromFile($file, $page)
    {
        return $this->xpdf->getText($file, $page, $page);
    }
} 