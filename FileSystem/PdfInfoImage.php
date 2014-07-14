<?php

namespace UEC\MediaPdfBundle\FileSystem;

class PdfInfoImage
{
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
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
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
     */
    public function setPath($path)
    {
        $this->path = $path;
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
     */
    public function setContent($content = null)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}