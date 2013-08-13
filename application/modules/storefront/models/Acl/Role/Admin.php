<?php

class Storefront_Model_Acl_Role_Admin extends Zend_Acl_Role
{
    public function getRoleId()
    {
        return 'Admin';
    }
}