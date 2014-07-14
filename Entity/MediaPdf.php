<?php

namespace UEC\MediaPdfBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use UEC\MediaPdfBundle\Model\MediaPdf as BaseMediaPdf;
use UEC\MediaPdfBundle\Model\MediaPdfImageInterface;
use UEC\MediaPdfBundle\Model\MediaPdfInterface;

class MediaPdf extends BaseMediaPdf
{
    function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @param MediaPdfImageInterface $mediaPdfImage
     * @return MediaPdfInterface
     */
    public function addMediaPdfImage(MediaPdfImageInterface $mediaPdfImage)
    {
        $mediaPdfImage->setMedia($this);
        $this->images[] = $mediaPdfImage;

        return $this;
    }

    /**
     * @param MediaPdfImageInterface $mediaPdfImage
     */
    public function removeMediaPdfImage(MediaPdfImageInterface $mediaPdfImage)
    {
        $this->images->removeElement($mediaPdfImage);
    }

    /**
     * @return ArrayCollection
     */
    public function getMediaPdfImages()
    {
        return $this->images;
    }
} 