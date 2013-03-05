<?php

namespace QualityPress\Bundle\StaticContentBundle\Handler;

/**
 * ContextHandlerInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContextHandlerInterface
{
    
    function has($context);
    
    function get($context);
    
    function getContexts();
    
}
