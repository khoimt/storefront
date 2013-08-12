<?php

class Storefront_ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        $o_Err = $this->_getParam('error_handler')->exception;
        $this->view->message = $o_Err->getMessage();
        $this->view->traceAsTring = '';
        if (APPLICATION_ENV == 'development') {
            $this->view->traceAsTring = $o_Err->getTraceAsString();
        }
    }
}
