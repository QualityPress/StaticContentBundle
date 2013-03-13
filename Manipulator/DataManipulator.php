<?php

namespace QualityPress\Bundle\StaticContentBundle\Manipulator;

use QualityPress\Bundle\StaticContentBundle\Handler\ContextHandlerInterface;
use QualityPress\Bundle\StaticContentBundle\Manager\ContentManagerInterface;

/**
 * DataManipulator
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class DataManipulator
{
    
    protected $contextHandler;
    protected $contentManager;
    protected $contents;
    
    public function __construct(ContentManagerInterface $contentManager, ContextHandlerInterface $contextHandler, array $contents)
    {
        $this->contentManager   = $contentManager;
        $this->contextHandler   = $contextHandler;
        $this->contents         = $contents;
    }
    
    public function rebuild()
    {
        $this->truncate();
        return $this->build();
    }
    
    public function getContextHandler()
    {
        return $this->contextHandler;
    }

    public function getContentManager()
    {
        return $this->contentManager;
    }
    
    /**
     * Truncate database table
     */
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
    
    /**
     * Create items on database
     * @return int
     */
    protected function build()
    {
        $em = $this->getContentManager()->getEntityManager();
        $cmd = $em->getClassMetadata($this->getContentManager()->getClass());
        
        $builded = 0;
        foreach ($this->contents as $ident => $config) {
            if ($this->getContextHandler()->has($config['context'])) {                
                $content = $this->getContentManager()->create();
                $content->setIdentity($ident)->setContext($config['context']);
                
                if (isset($config['defaults'])) {
                    foreach ($config['defaults'] as $field => $value) {
                        // Check field as columnName
                        if (true === in_array($field, $cmd->getColumnNames())) {
                            $cmd->setFieldValue($content, $cmd->getFieldForColumn($field), $value);
                        }
                        // Check field as fieldName
                        else if (true === in_array($field, $cmd->getFieldNames())) {
                            $cmd->setFieldValue($content, $field, $value);
                        }
                    }
                }
                               
                $this->getContentManager()->persist($content);
                $builded++;
            }
        }
        
        return $builded;
    }
    
}