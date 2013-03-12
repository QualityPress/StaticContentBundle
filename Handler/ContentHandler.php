<?php

namespace QualityPress\Bundle\StaticContentBundle\Handler;

use QualityPress\Bundle\StaticContentBundle\Manager\ContentManagerInterface;

/**
 * ContentHandler
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class ContentHandler implements ContentHandlerInterface
{

    protected $contentManager;
    protected $contents;
    protected $ready = false;

    public function __construct(ContentManagerInterface $contentManager)
    {
        $this->contentManager = $contentManager;
        $this->contents = array();
    }

    protected function populate()
    {
        $contentManager = $this->contentManager;
        foreach ($contentManager->findAll() as $content) {
            $this->contents[$content->getIdentity()] = $content;
        }
    }

    public function has($name)
    {
        return (true === key_exists($name, $this->getContents()));
    }

    public function get($name)
    {
        return ($this->has($name)) ? $this->contents[$name] : null;
    }

    public function getContents()
    {
        if (false === $this->isReady()) {
            $this->populate();
            $this->ready = true;
        }
            
        return $this->contents;
    }
    
    public function getByContext($context)
    {
        $contents = array();
        foreach ($this->getContents() as $content) {
            if (strtolower($content->getContext()) === strtolower($context)) {
                $contents[] = $content;
            }
        }
        
        return $contents;
    }
    
    public function isReady()
    {
        return $this->ready;
    }

}