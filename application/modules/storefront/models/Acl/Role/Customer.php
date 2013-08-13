<?php

class Storefront_Model_Acl_Role_Customer extends Zend_Acl_Role
{
    public function getRoleId()
    {
        return 'Customer';
    }
}