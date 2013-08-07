<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initViewDisplay()
    {
        $this->bootstrap('View');
        $o_View = $this->view;
        if ($o_View instanceof Zend_View) {
            $o_View->setEncoding('UTF-8');
            $o_View->doctype()->setDoctype('XHTML1_STRICT');
            
            $o_View->headMeta()->appendHttpEquiv('Content-Type', 'text/html, charset=utf-8');
            $o_View->headMeta()->appendHttpEquiv('Content-language', 'en-US');
            
            $o_View->headStyle()->setStyle('@import "/css/access.css";');
            
            $o_View->headLink()->appendStylesheet('/css/reset.css');
            $o_View->headLink()->appendStylesheet('/css/main.css');
            $o_View->headLink()->appendStylesheet('/css/form.css');
            
            $o_View->headTitle('Storefront - ');
        }
    }

}

