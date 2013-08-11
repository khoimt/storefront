<?php

class Storefront_Resource_ProductImage_Item extends SF_Model_Resource_Db_Table_Row_Abstract
    implements Storefront_Resource_ProductImage_Item_Interface
{
    public function full() {
        return $this->getRow()->full;
    }

    public function isDefault() {
        return $this->getRow()->isDefault === 'Yes';
    }

    public function thumbnail() {
        return $this->getRow()->thumbnail;
    }    
}
