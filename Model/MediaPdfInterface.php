<?php

namespace UEC\MediaPdfBundle\Model;

interface MediaPdfInterface
{
    /**
     * @param int $size
     * @return MediaPdfInterface
     */
    public function setSize($size);

    /**
     * @return int
     */
    public function getSize();

    /**
     * @param int $totalPageNumber
     * @return MediaPdfInterface
     */
    public function setTotalPageNumber($totalPageNumber);

    /**
     * @return int
     */
    public function getTotalPageNumber();

    /**
     * @param boolean $processed
     * @return MediaPdfInterface
     */
    public function setProcessed($processed);

    /**
     * @return boolean
     */
    public function getProcessed();

    /**
     * @param boolean $processing
     * @return MediaPdfInterface
     */
    public function setProcessing($processing);

    /**
     * @return boolean
     */
    public function getProcessing();

    /**
     * @param MediaPdfImageInterface $mediaPdfImage
     * @return MediaPdfInterface
     */
    public function addMediaPdfImage(MediaPdfImageInterface $mediaPdfImage);

    /**
     * @param MediaPdfImageInterface $mediaPdfImage
     */
    public function removeMediaPdfImage(MediaPdfImageInterface $mediaPdfImage);

    /**
     * @return array
     */
    public function getMediaPdfImages();
} 