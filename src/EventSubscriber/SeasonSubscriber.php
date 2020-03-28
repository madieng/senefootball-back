<?php

namespace App\EventSubscriber;

use App\Entity\Season;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class SeasonSubscriber
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Season) {
            $name = $entity->getStartDate()->format('Y') . ' - ' . $entity->getEndDate()->format('Y');
            $entity->setName($name);
        }
    }
}
