<?php

class Storefront_IndexController extends Zend_Controller_Action 
{
    public function init()
    {    
    }
    
    public function indexAction()
    {
        $this->getHelper('ViewRenderer')->setNorender(true);
        echo 'Hello World!';
        die;
    }
}