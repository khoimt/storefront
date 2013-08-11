<?php

class Storefront_Resource_Product_Item extends SF_Model_Resource_Db_Table_Row_Abstract
    implements Storefront_Resource_Product_Item_Interface
{
    public function getDefaultImage() {
        return $this->findDependentRowset(
            'Storefront_Resource_ProductImage',
            'Image',
            $this->select()->where('isDefault = ?', 'Yes')->limit(1)
        )->current();
    }

    public function getImages($includeDefault = false) {
        $o_Select = $includeDefault 
                ? NULL
                : $this->select()->where('isDefault <> ?', 'Yes');
        return $this->findDependentRowset(
                'Storefront_Resource_ProductImage',
                'Image',
                $o_Select
            );
    }

    public function getPrice($withDiscount = true, $withTax = true) {
        return $this->getRow()->price;
    }

    public function isDiscounted() {
        return $this->getRow()->discountPercent > 0;
    }

    public function isTaxable() {
        return $this->getRow()->taxable === 'Yes';
    }    
}
