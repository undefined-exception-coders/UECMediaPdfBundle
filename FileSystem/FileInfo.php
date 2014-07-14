<?php

namespace UEC\MediaPdfBundle\FileSystem;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use UEC\MediaBundle\FileSystem\FileInfoInterface;

class FileInfo implements FileInfoInterface
{
    /**
     * @var string
     */
    protected $tmpName;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $error;

    /**
     * @var bool
     */
    protected $isUploadedFile;

    function __construct(UploadedFile $file = null)
    {
        if (null === $file) {
            $this->isUploadedFile = false;
        } else {
            $this->tmpName = $file->getPathname();
            $this->name = $file->getClientOriginalName();
            $this->size = $file->getClientSize();
            $this->type = $file->getMimeType();
            $this->error = $file->getError();
            $this->isUploadedFile = true;
        }
    }

    /**
     * @return string
     */
    public function getTmpName()
    {
        return $this->tmpName;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * This method must return true if the file is coming from $_FILES, or false instead.
     *
     * @return bool
     */
    public function isUploadedFile()
    {
        return $this->isUploadedFile;
    }

} 