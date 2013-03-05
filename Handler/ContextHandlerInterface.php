<?php

namespace QualityPress\Bundle\StaticContentBundle\Handler;

use QualityPress\Bundle\StaticContentBundle\Model\ContextInterface;

/**
 * ContextHandlerInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContextHandlerInterface
{
    
    /**
     * Check existency of context
     * 
     * @param string $context
     * @return boolean
     */
    function has($context);
    
    /**
     * Get context object
     * 
     * @param string $context
     * @return null|ContextInterface
     */
    function get($context);
    
    /**
     * Get array of contexts
     * 
     * @return array
     */
    function getContexts();
    
}
