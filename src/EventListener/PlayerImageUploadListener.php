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

class PlayerImageUploadListener extends ImageUploadListener
{
    public function __construct(FileUploader $uploader, string $targetDirectory)
    {
        parent::__construct($uploader, $targetDirectory);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Player) {
            return;
        }

        parent::postLoad($args);
    }

    public function uploadFile($entity)
    {
        if (!$entity instanceof Player) {
            return;
        }

        parent::uploadFile($entity);
    }
}