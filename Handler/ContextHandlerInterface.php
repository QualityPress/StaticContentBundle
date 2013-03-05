<?php

namespace QualityPress\Bundle\StaticContentBundle\Manager;

/**
 * ContextManagerInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContextManagerInterface
{
    
    function has($context);
    
    function get($context);
    
    function getContexts();
    
}
