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
    
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof ContentInterface) {
            $entity->setCreatedAt(new \DateTime('now'));
        }
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof ContentInterface) {
            $entity
                ->setUpdatedAt(new \DateTime('now'))
                ->setCreatedAt(new \DateTime('now'))
            ;
        }
    }
    
}