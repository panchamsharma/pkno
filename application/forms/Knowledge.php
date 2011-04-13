<?php

class Application_Form_Knowledge extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add the comment element
        $this->addElement('textarea', 'knowledge', array(
            'label'      => 'Content',
            'required'   => true,
         ));

        // Add the tags element
        $this->addElement('text', 'tags', array(
            'label'      => 'Tags',
            'required'   => false,
         ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}

