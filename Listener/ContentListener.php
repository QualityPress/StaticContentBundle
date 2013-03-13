<?php

namespace QualityPress\Bundle\StaticContentBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use QualityPress\Bundle\StaticContentBundle\Model\ContentInterface;

/**
 * ContentListener
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class ContentListener
{
    
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof ContentInterface) {
            $entity->prePersist();
        }
    }
    
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $em     = $args->getEntityManager();
        if ($entity instanceof ContentInterface) {
            $entity->preUpdate();
            $cm = $em->getClassMetadata(get_class($entity));
            $em->getUnitOfWork()->recomputeSingleEntityChangeSet($cm, $entity);
        }
    }
    
}