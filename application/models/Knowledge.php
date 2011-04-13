<?php

class Application_Model_Knowledge
{
    protected $_id;
    protected $_knowledge;
    protected $_created;
    protected $_modified;
    protected $_tags;

     public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid knowledge property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid knowledge property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setKnowledge($text)
    {
        $this->_knowledge = (string) $text;
        return $this;
    }

    public function getKnowledge()
    {
        return $this->_knowledge;
    }

    public function setTags($tags)
    {
        $this->_tags = (string) $tags;
        return $this;
    }

    public function getTags()
    {
        return $this->_tags;
    }

    public function getCreated()
    {
        return $this->_created;
    }

    public function getModified()
    {
        return $this->_modified;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
}

