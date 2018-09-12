<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-09-12
 * Time: 12:54
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    public function setTargetDirectory(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }
}
