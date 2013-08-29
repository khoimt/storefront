<?php
class SF_Plugin_AdminContext extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        if ($request->getParam('isAdmin', 0) === 1) {
            echo 'abc';
            $o_Layout = Zend_Layout::getMvcInstance();
            $o_Layout->setLayout('admin');
        }
    }
}