<?php

class Storefront_Resource_User_Item extends
SF_Model_Resource_Db_Table_Row_Abstract implements
Storefront_Resource_User_Item_Interface,
Zend_Acl_Role_Interface
{
    /**
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->getRow()->title .
                ' ' .
                $this->getRow()->firstname;
                ' ' .
                $this->getRow()->lastname;
    }

    /**
     *
     * @return string
     */
    public function getRoleId()
    {
        if (null == $this->getRow()->role)
            return 'Guest';
        return $this->getRow()->role;
    }

}