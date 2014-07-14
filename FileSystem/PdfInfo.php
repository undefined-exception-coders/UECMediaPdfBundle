<?php

namespace UEC\MediaPdfBundle\FileSystem;

class PdfInfo
{
    /**
     * @var int
     */
    protected $size;

    /**
     * @var int
     */
    protected $totalPage;

    /**
     * @var bool
     */
    protected $processed;

    /**
     * @var array
     */
    protected $images;

    function __construct()
    {
        $this->totalPage = 0;
        $this->processed = false;
        $this->images = array();
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $totalPage
     */
    public function setTotalPage($totalPage)
    {
        $this->totalPage = $totalPage;
    }

    /**
     * @return int
     */
    public function getTotalPage()
    {
        return $this->totalPage;
    }

    /**
     * @param boolean $processed
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;
    }

    /**
     * @return boolean
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * @param PdfInfoImage $pdfInfoImage
     */
    public function addImages(PdfInfoImage $pdfInfoImage)
    {
        $this->images[] = $pdfInfoImage;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images)
    {
        $this->images = $images;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }
}