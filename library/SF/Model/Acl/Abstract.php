<?php

abstract class SF_Model_Acl_Abstract
extends SF_Model_Abstract
implements SF_Model_Acl_Interface, Zend_Acl_Resource_Interface
{
    protected $_identify;
    protected $_acl;

    public function setIdentify($identify = null)
    {
        if (is_array($identify) && isset($identify['role'])) {
            $identify = $identify['role'];
        } elseif (!is_string($identify)) {
            $this->_identify = new Zend_Acl_Role('Guest');
        }
        $this->_identify = new Zend_Acl_Role($identify);
    }

    /**
     *
     * @return Zend_Acl_Role
     */
    public function getIdentify() 
    {
        if (null === $this->_identity) {
            $this->setIdentify();
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