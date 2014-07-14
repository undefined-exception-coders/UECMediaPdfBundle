<?php

namespace UEC\MediaPdfBundle\CDN;

use UEC\MediaBundle\CDN\AbstractCDN;

class CDNMediaPdf extends AbstractCDN
{
    /**
     * {@inheritdoc}
     */
    public function getThumbPath()
    {
        if ($this->mediaProvider->getProcessed()) {
            return $this->mediaProvider->getMediaPdfImages()->first()->getPath();
        }
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilePath()
    {
        return $this->mediaProvider->getMedia()->getPath();
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $options = array())
    {
        return $this->mediaProvider->getMedia()->getPath();
    }
}