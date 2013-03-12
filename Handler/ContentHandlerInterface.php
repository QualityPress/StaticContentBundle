<?php

namespace QualityPress\Bundle\StaticContentBundle\Handler;

use QualityPress\Bundle\StaticContentBundle\Model\ContentInterface;

/**
 * ContentHandlerInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContentHandlerInterface
{
    
    /**
     * Get content object
     * 
     * @param string $name Identity of content
     * @return ContentInterface
     */
    function get($name);
    
    /**
     * Get contents by context
     * 
     * @param string $context Name of context identity
     * @return array
     */
    function getByContext($context);
    
    /**
     * Check existency of content by identity
     * 
     * @param type $name
     * @return boolean
     */
    function has($name);
    
    /**
     * Get array of contents
     * 
     * @return array
     */
    function getContents();
    
    /**
     * @return boolean
     */
    function isReady();
    
}
