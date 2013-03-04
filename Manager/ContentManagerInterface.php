<?php

namespace QualityPress\Bundle\StaticContentBundle\Manager;

use QualityPress\Bundle\StaticContentBundle\Model\ContentInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ContentManagerInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContentManagerInterface
{
    
    /**
     * Find one by identity
     * 
     * @param string $identity
     * @return mixed null|ContentInterface
     */
    function findOne($identity);
    
    /**
     * Find a collection of contents by params
     * 
     * @param array $params
     * @return mixed null|ArrayCollection
     */
    function findBy(array $params);
    
    /**
     * Find a collection of content results
     * 
     * @return mixed null|ArrayCollection
     */
    function findAll();
    
    /**
     * Return object class name
     * 
     * @return string
     */
    function getClass();
    
    /**
     * Return an object em
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    function getEntityManager();
    
    /**
     * Create a content object
     * @return ContentInterface
     */
    function create();
    
    /**
     * Persist a data object
     * 
     * @param \QualityPress\Bundle\StaticContentBundle\Model\ContentInterface $content
     * @param boolean $flush
     */
    function persist(ContentInterface $content, $flush = true);
    
}
