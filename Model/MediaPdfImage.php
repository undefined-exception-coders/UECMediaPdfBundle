<?php

namespace UEC\MediaPdfBundle\Model;

abstract class MediaPdfImage implements MediaPdfImageInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var MediaPdfInterface
     */
    protected $media;

    /**
     * @var int
     */
    protected $pageNumber;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $content;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $pageNumber
     * @return MediaPdfImageInterface
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param string $path
     * @return MediaPdfImageInterface
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $content
     * @return MediaPdfImageInterface
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param \UEC\MediaPdfBundle\Model\MediaPdfInterface $media
     * @return MediaPdfImageInterface
     */
    public function setMedia(MediaPdfInterface $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return \UEC\MediaPdfBundle\Model\MediaPdfInterface
     */
    public function getMedia()
    {
        return $this->media;
    }
}