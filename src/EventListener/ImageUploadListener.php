<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-10-09
 * Time: 15:20
 */

namespace App\EventListener;

use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader, string $targetDirectory)
    {
        $uploader->setTargetDirectory($targetDirectory);
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function uploadFile($entity)
    {
        $file = $entity->getImage();

        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setImage($fileName);
        } elseif ($file instanceof File) {
            $entity->setImage($file->getFilename());
        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($fileName = $entity->getImageFile()) {
            $entity->setImage(
                new File($this->uploader->getTargetDirectory() . '/' . $fileName)
            );
        }
    }
}