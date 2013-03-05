<?php

namespace QualityPress\Bundle\StaticContentBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
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
    
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof ContentInterface) {
            $entity->preUpdate();
        }
    }
    
}