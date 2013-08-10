<?php

class Storefront_IndexController extends Zend_Controller_Action 
{
    public function init()
    {    
    }
    
    public function indexAction()
    {
        Storefront_Model_Foo::helloFoo();
    }
}