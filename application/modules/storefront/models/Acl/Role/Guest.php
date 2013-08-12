<?php

class Storefront_Model_Acl_Role_Guest extends Zend_Acl_Role
{
    public function getRoleId()
    {
        return 'Guest';
    }
}