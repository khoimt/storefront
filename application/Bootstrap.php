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
    
    public function _initAutoload()
    {
        $this->_autoloaderResource = new Zend_Loader_Autoloader_Resource(
                                        array(
                                            'namespace' => 'Storefront',
                                            'basePath' => APPLICATION_PATH . '/modules/storefront'
                                        ));
        $this->_autoloaderResource->addResourceTypes(
           array(
               'model' => array(
                   'path' => '/models',
                   'namespace' => 'Model',
               ),
               'form' => array(
                   'path' => '/forms',
                   'namespace' => 'Form',
               ),
               'storefrontResource' => array(
                   'path' => '/models/resources',
                   'namespace' => 'Resource',
               ),
//               'storefrontValidate' => array(
//                   'path' => '/models/validate',
//                   'namespace' => 'Validate',
//               ),
           )
        );
    }
}

