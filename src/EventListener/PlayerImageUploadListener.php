<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-09-12
 * Time: 12:48
 */

namespace App\EventListener;

use App\Entity\Player;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PlayerImageUploadListener
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

    private function uploadFile($entity)
    {
        if (!$entity instanceof Player) {
            return;
        }

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

        if (!$entity instanceof Player) {
            return;
        }

        if ($fileName = $entity->getBrochure()) {
            $entity->setBrochure(
                new File($this->uploader->getTargetDirectory().'/'.$fileName)
            );
        }
    }

}