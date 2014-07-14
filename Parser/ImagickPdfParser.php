<?php

namespace UEC\MediaPdfBundle\Parser;

class ImagickPdfParser implements PdfParserInterface
{

    /**
     * Extracts a specific page and save it as image file
     *
     * @param string $file
     * @param int $pageNumber
     * @param int $quality
     * @param string $output
     */
    public function extractPageToImg($file, $pageNumber, $quality, $output)
    {
        $img = new \Imagick();
        $img->setresolution($quality, $quality);
        $img->readimage(sprintf('%s[%d]', $file, $pageNumber));
        $img->setimageformat('jpg');
        $img->flattenimages();
        $img->writeimage($output);
    }

    /**
     * Get the numbers of pages
     *
     * @param string $file
     * @return int
     */
    public function getNumberOfPages($file)
    {
        $document = new \Imagick($file);
        return $document->getnumberimages();
    }
}