<?php

class Storefront_Resource_ProductImage extends SF_Model_Resource_Db_Table_Abstract
{
    protected $_name = 'productImage';
    protected $_primary = 'imageId';
    protected $_referenceMap = array(
        'Image' => array(
            'columns' => 'productId',
            'refTableClass' => 'Storefront_Resource_Product',
            'relColumns' => 'productId',
        )
    );
}