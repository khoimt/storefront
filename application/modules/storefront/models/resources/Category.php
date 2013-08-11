<?php

class Storefront_Resource_Category extends SF_Model_Resource_Db_Table_Abstract
    implements Storefront_Resource_Category_Interface
{
    protected $_name = 'category';
    protected $_primary = 'categoryId';
    protected $_referenceMap = array(
        'SubCategory' => array(
            'columns' => 'parentId',
            'refTableClass' => 'Storefront_Resource_Category',
            'relColumns' => 'categoryId',
        ));
    
    protected $_rowClass = 'Storefront_Resource_Category_Item';

    public function getCategoriesByParentId($parentId) {
        $o_Select = $this->select()
                ->where('parentId = ?', $parentId, Zend_Db::INT_TYPE)
                ->order('name');
        return $this->fetchAll($o_Select);
    }

    public function getCategoryById($id) {
        $o_Select =$this->select()
                ->where('categoryId = ?', $id, Zend_Db::INT_TYPE);
        return $this->fetchRow($o_Select);
    }

    public function getCategoryByIdent($ident) {
        $o_Select = $this->select()
                ->where('ident = ?', $ident);
        return $this->fetchRow($o_Select);
    }

}