<?php

namespace App\EventSubscriber;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class ActiveSubscriber
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $entity->setActive(true);
    }
}
