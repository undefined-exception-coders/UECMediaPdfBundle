<?php

namespace UEC\MediaPdfBundle\Model;

interface MediaPdfImageInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $pageNumber
     * @return MediaPdfImageInterface
     */
    public function setPageNumber($pageNumber);

    /**
     * @return int
     */
    public function getPageNumber();

    /**
     * @param string $path
     * @return MediaPdfImageInterface
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $content
     * @return MediaPdfImageInterface
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param \UEC\MediaPdfBundle\Model\MediaPdfInterface $media
     * @return MediaPdfImageInterface
     */
    public function setMedia(MediaPdfInterface $media);

    /**
     * @return \UEC\MediaPdfBundle\Model\MediaPdfInterface
     */
    public function getMedia();
} 