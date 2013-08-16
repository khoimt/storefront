<?php
class SF_Plugin_AdminContext extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        if ($request->getParam('isAdmin') !== false) {
            $o_Layout = Zend_Layout::getMvcInstance();
            $o_Layout->setLayout('admin');
        }
    }
}