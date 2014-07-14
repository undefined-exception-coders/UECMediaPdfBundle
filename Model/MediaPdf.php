<?php

namespace UEC\MediaPdfBundle\Model;

use UEC\MediaBundle\Model\MediaProvider;

abstract class MediaPdf extends MediaProvider implements MediaPdfInterface
{
    /**
     * @var int
     */
    protected $size;

    /**
     * @var int
     */
    protected $totalPageNumber;

    /**
     * @var bool
     */
    protected $processed;

    /**
     * @var bool
     */
    protected $processing;

    /**
     * @var array
     */
    protected $images;

    /**
     * @param int $size
     * @return MediaPdfInterface
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $totalPageNumber
     * @return MediaPdfInterface
     */
    public function setTotalPageNumber($totalPageNumber)
    {
        $this->totalPageNumber = $totalPageNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPageNumber()
    {
        return $this->totalPageNumber;
    }

    /**
     * @param boolean $processed
     * @return MediaPdfInterface
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * @param boolean $processing
     * @return MediaPdfInterface
     */
    public function setProcessing($processing)
    {
        $this->processing = $processing;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getProcessing()
    {
        return $this->processing;
    }
}