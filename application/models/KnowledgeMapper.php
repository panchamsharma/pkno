<?php

class Application_Model_KnowledgeMapper
{

    protected $_dbTable_Knowledge;
    protected $_dbTable_Tags;

    public function setDbTableKnowledge($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable_Knowledge = $dbTable;
        return $this;
    }

    public function getDbTableKnowledge()
    {
        if (null === $this->_dbTable_Knowledge) {
            $this->setDbTableKnowledge('Application_Model_DbTable_Knowledge');
        }
        return $this->_dbTable_Knowledge;
    }

    public function setDbTableTags($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable_Tags = $dbTable;
        return $this;
    }

    public function getDbTableTags()
    {
        if (null === $this->_dbTable_Tags) {
            $this->setDbTableTags('Application_Model_DbTable_Tags');
        }
        return $this->_dbTable_Tags;
    }

    public function save(Application_Model_Knowledge $knowledge)
    {
        $data = array(
            'knowledge' => $knowledge->getKnowledge(),
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $knowledge->getId())) {
            unset($data['id']);
            $this->getDbTableKnowledge()->insert($data);
        } else {
            $this->getDbTableKnowledge()->update($data, array('id = ?' => $id));
        }

        if ($knowledge->getTags() != null) {
            $data_tags = array(
               'knowledge_id' => "1",
                'tag' => $knowledge->getTags(),
                'created' => date('Y-m-d H:i:s'),
            );

            $this->getDbTableTags()->insert($data_tags);
        }
    }

    public function find($id, Application_Model_Knowledge $knowledge)
    {
        $result = $this->getDbTableKnowledge()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $knowledge->setId($row->id)
                  ->setKnowledge($row->knowledge)
                  ->setCreated($row->created)
                  ->setModified($row->modified);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTableKnowledge()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Knowledge();
            $entry->setId($row->id)
                  ->setKnowledge($row->knowledge)
                  ->setCreated($row->created)
                  ->setModified($row->modified);
            $entries[] = $entry;
        }
        return $entries;
    }

}

