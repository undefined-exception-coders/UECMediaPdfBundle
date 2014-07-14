<?php

namespace UEC\MediaPdfBundle\Handler;

use UEC\MediaPdfBundle\FileSystem\PdfInfo;
use UEC\MediaPdfBundle\FileSystem\PdfInfoImage;
use UEC\MediaPdfBundle\OCR\OCRImageInterface;
use UEC\MediaPdfBundle\OCR\OCRInterface;
use UEC\MediaPdfBundle\OCR\OCRPdfInterface;
use UEC\MediaPdfBundle\Parser\PdfParserInterface;

class PdfProcessHandler
{
    /**
     * @var \UEC\MediaPdfBundle\Parser\PdfParserInterface
     */
    protected $pdfParser;

    /**
     * @var \UEC\MediaPdfBundle\OCR\OCRInterface
     */
    protected $OCR;

    /**
     * @var integer
     */
    protected $extractQuality;

    /**
     * @var null|int
     */
    protected $extractLimit;

    function __construct(PdfParserInterface $pdfParser, $extractQuality, $extractLimit = null)
    {
        $this->pdfParser = $pdfParser;
        $this->extractQuality = $extractQuality;
        $this->extractLimit = $extractLimit;
    }

    /**
     * @param \UEC\MediaPdfBundle\OCR\OCRInterface $OCR
     */
    public function setOCR(OCRInterface $OCR = null)
    {
        $this->OCR = $OCR;
    }

    /**
     * Execute the process for extract images and get text content from pdf
     *
     * @param $filePath
     * @return array
     */
    public function extractImagesFromFile($filePath)
    {
        $filename = pathinfo($filePath, PATHINFO_FILENAME);
        $numberOfPages = $this->pdfParser->getNumberOfPages($filePath);

        $extractDir = pathinfo($filePath, PATHINFO_DIRNAME).'/images/'.$filename;
        mkdir($extractDir, 0777, true);

        $limit = null === $this->extractLimit
            ? $numberOfPages
            : $this->extractLimit;

        if ($limit > $numberOfPages) {
            $limit = $numberOfPages;
        }

        $images = array();

        for ($pageNumber = 0; $pageNumber < $limit; $pageNumber++) {
            $imagePath = sprintf($extractDir.'/%s_%d.jpg', $filename, $pageNumber);
            $this->pdfParser->extractPageToImg($filePath, $pageNumber, $this->extractQuality, $imagePath);

            $content = null;

            if (null !== $this->OCR) {
                if ($this->OCR instanceof OCRImageInterface) {
                    $content = $this->OCR->getContentFromImg($imagePath);
                } elseif ($this->OCR instanceof OCRPdfInterface) {
                    $content = $this->OCR->getContentFromFile($filePath, $pageNumber, $pageNumber);
                }
            }

            $pdfInfoImage = new PdfInfoImage();
            $pdfInfoImage->setPageNumber($pageNumber+1);
            $pdfInfoImage->setPath($imagePath);
            $pdfInfoImage->setContent($content);

            $images[] = $pdfInfoImage;
        }

        return $images;
    }
}