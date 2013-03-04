<?php

namespace QualityPress\Bundle\StaticContentBundle\Manipulator;

use QualityPress\Bundle\StaticContentBundle\Manager\ContextManagerInterface;
use QualityPress\Bundle\StaticContentBundle\Manager\ContentManagerInterface;

/**
 * DataManipulator
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class DataManipulator
{
    
    protected $contextManager;
    protected $contentManager;
    protected $contents;
    
    public function __construct(ContentManagerInterface $contentManager, ContextManagerInterface $contextManager, array $contents)
    {
        $this->contentManager   = $contentManager;
        $this->contextManager   = $contextManager;
        $this->contents         = $contents;
    }
    
    public function rebuild()
    {
        $this->truncate();
        return $this->build();
    }
    
    public function getContextManager()
    {
        return $this->contextManager;
    }

    public function getContentManager()
    {
        return $this->contentManager;
    }
    
    protected function truncate()
    {        
        $em = $this->getContentManager()->getEntityManager();
        $cmd = $em->getClassMetadata($this->getContentManager()->getClass());
        $connection = $em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->beginTransaction();
        
        try {
            $connection->query('SET FOREIGN_KEY_CHECKS = 0');
            $query = $dbPlatform->getTruncateTableSql($cmd->getTableName());
            $connection->executeUpdate($query);
            $connection->query('SET FOREIGN_KEY_CHECKS = 1');
            $connection->commit();
        }
        catch (\Exception $e) {
            $connection->rollback();
        }
    }
    
    protected function build()
    {
        $builded = 0;
        foreach ($this->contents as $ident => $config) {
            if ($this->getContextManager()->has($config['context'])) {
                $context = $this->getContextManager()->get($config['context']);
                
                $content = $this->getContentManager()->create();
                $content->setIdentity($ident)->setContext($config['context']);
                
                $this->getContentManager()->persist($content);
                $builded++;
            }
        }
        
        return $builded;
    }
    
}