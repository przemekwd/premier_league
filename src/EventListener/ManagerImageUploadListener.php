<?php
/**
 * Author: Przemysław Mincewicz
 * Date: 2018-10-09
 * Time: 15:23
 */

namespace App\EventListener;

use App\Entity\Manager;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ManagerImageUploadListener extends ImageUploadListener
{
    public function __construct(FileUploader $uploader, string $targetDirectory)
    {
        parent::__construct($uploader, $targetDirectory);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Manager) {
            return;
        }

        parent::postLoad($args);
    }

    public function uploadFile($entity)
    {
        if (!$entity instanceof Manager) {
            return;
        }

        parent::uploadFile($entity);
    }
}