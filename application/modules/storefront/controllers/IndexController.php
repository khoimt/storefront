<?php

class Storefront_IndexController extends Zend_Controller_Action 
{
    public function init()
    {    
    }
    
    public function indexAction()
    {
        $o_Catalog = new Storefront_Model_Catalog();
        $arr = $o_Catalog->getCategoriesByParentId(0);
        print_r($arr->toArray());
    }
}