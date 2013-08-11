<?php

class Storefront_Resource_Category extends SF_Model_Resource_Db_Table_Abstract
{
    protected $_name = 'category';
    protected $_primary = 'categoryId';
    protected $_referenceMap = array(
        'SubCategory' => array(
            'columns' => 'parentId',
            'refTableClass' => 'Storefront_Resource_Category',
            'relColumns' => 'categoryId',
        )
    );
}