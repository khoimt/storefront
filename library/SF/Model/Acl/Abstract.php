<?php

abstract class SF_Model_Acl_Abstract
extends SF_Model_Abstract
implements SF_Model_Acl_Interface, Zend_Acl_Resource_Interface
{
    /**
     *
     * @var string|Zend_Acl_Role
     */
    protected $_identify;

    /**
     *
     * @var Zend_Acl
     */
    protected $_acl;
    protected $_authService;

    public function setIdentify($identify = null)
    {
        if (is_array($identify) && isset($identify['role'])) {
            $this->_identify = new Zend_Acl_Role( $identify['role']);
        } elseif (is_string($identify)) {
            $this->_identify = new Zend_Acl_Role($identify);
        } elseif ($identify instanceof Zend_Acl_Role) {
            $this->_identify = $identify;
        } else {
            $this->_identify = new Zend_Acl_Role('Guest');
        }
    }

    public function setAuthService(Storefront_Service_Authentication $o_Service = null)
    {
        if (null === $o_Service) {
            $this->getAuthService();
        } else {
            $this->_authService = $o_Service;
        }
    }

    /**
     *
     * @return Storefront_Service_Authentication
     */
    public function getAuthService()
    {
        if (null === $this->_authService) {
            $this->_authService = Storefront_Service_Authentication::getInstance();
        }
        return $this->_authService;
    }

    /**
     *
     * @return Zend_Acl_Role
     */
    public function getIdentify() 
    {
        if (null === $this->_identity) {
            $this->_identify = $this->getAuthService()->getIdentity();
            if (empty($this->_identify)) {
                $this->_identify = new Storefront_Model_Acl_Role_Guest();
            } 
        }
        return $this->_identify;
    }

    /**
     *
     * @param string $sz_Action
     * @return bool
     */
    public function checkAcl($sz_Action) {
        return $this->getAcl()->isAllowed(
            $this->getIdentify(),
            $this,
            $sz_Action
        );
    }
}