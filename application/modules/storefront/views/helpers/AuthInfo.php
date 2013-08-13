<?php

class Storefront_View_Helper_AuthInfo extends Zend_View_Helper_Abstract
{   
    /**
     * @var Storefront_Service_Authentication
     */
    protected $_authService;
    
    /**
     * Get user info from the auth session
     *
     * @param string|null $info The data to fetch, null to chain
     * @return string|Zend_View_Helper_AuthInfo
     */
    public function authInfo ($info = null)
    {
        if (null === $this->_authService) {
            $this->_authService = Storefront_Service_Authentication::getInstance();
        }
         
        if (null === $info) {
            return $this;
        }
        
        if (false === $this->isLoggedIn()) {
            return null;
        }
        
        return $this->_authService->getIdentity()->$info;
    }
    
    /**
     * Check if we are logged in
     *
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $this->_authService->getAuth()->hasIdentity();
    }
}