<?php

namespace QualityPress\Bundle\StaticContentBundle\Model;

/**
 * Content
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
abstract class Content implements ContentInterface
{
    
    protected $body;
    protected $identity;
    protected $context;
    
    public function getBody()
    {
        return $this->body;
    }
    
    public function getContext()
    {
        return $this->context;
    }

    public function getIdentity()
    {
        return $this->identity;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }
    
    public function setContext($context)
    {
        $this->context = $context;
        return $this;
    }

    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }
    
}