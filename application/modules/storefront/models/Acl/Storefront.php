<?php

/**
 * 
 */
class Storefront_Model_Acl_Storefront
extends Zend_Acl
implements SF_Acl_Interface
{
    public function __construct()
    {
        $this->addRole(new Storefront_Model_Acl_Role_Guest);
        $this->addRole(new Storefront_Model_Acl_Role_Customer, 'Guest');
        $this->addRole(new Storefront_Model_Acl_Role_Admin, 'Customer');
        $this->deny();
    }
}
