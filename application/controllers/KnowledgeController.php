<?php

class KnowledgeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       //get request object
       $request = $this->getRequest();

       //set the form to be displayed
       $form = new Application_Form_Knowledge();
      
       //if it is a post, then process data and redirect back to index
       if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $knowledge = new Application_Model_Knowledge($form->getValues());
                $mapper  = new Application_Model_KnowledgeMapper();
                $mapper->save($knowledge);
                return $this->_helper->redirector('index');
            }
        }

        //set the add knowledge form
       $this->view->form = $form;

       //fetch current knowledge
       $mapper = new Application_Model_KnowledgeMapper();
       $this->view->knowledge = $mapper->fetchRecent(10);
    }
}



