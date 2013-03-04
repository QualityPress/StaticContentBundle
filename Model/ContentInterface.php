<?php

namespace QualityPress\Bundle\StaticContentBundle\Model;

/**
 * ContentInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContentInterface
{
    
    /**
     * Define content body
     * 
     * @param string $body
     * @return self
     */
    function setBody($body);
    
    /**
     * Get body
     * 
     * @return string
     */
    function getBody();
    
    /**
     * Set identify|identifier
     * 
     * @param string $identity
     * @return self
     */
    function setIdentity($identity);
    
    /**
     * Return identity
     * 
     * @return string
     */
    function getIdentity();
    
    /**
     * Set context
     * 
     * @param string $context
     * @return self
     */
    function setContext($context);
    
    /**
     * Get context
     * 
     * @return string
     */
    function getContext();
    
}
