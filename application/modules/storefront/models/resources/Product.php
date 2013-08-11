<?php

class Storefront_Resource_Product extends SF_Model_Resource_Db_Table_Abstract
    implements Storefront_Resource_Product_Interface
{
    protected $_name = 'product';
    protected $_primary = 'productId';
    
    protected $_rowClass = 'Storefront_Resource_Product_Item';
    protected $_pageRange = 10;
    
    public function getProductById($id) {
        return $this->find($id)->current();
    }

    public function getProductByIdent($ident) {
        return $this->fetchRow(
            $this->select()->where('ident = ?', $ident)
        );
    }

    public function getProductsByCategory($categoryId, $paged = null, $order = null) {
        $o_Select = $this->select()
                ->where('categoryId IN (?)', $categoryId, ZendDb::INT_TYPE);
        if (is_array($order) || is_string($order)) {
            $o_Select->order($order);
        }
        
        if ($paged === NULL) {
            return $this->fetchAll($o_Select);
        }
        
        $o_Adapter = new Zend_Paginator_Adapter_DbTableSelect($o_Select);
        $o_CounSelect = clone $o_Select;
        $o_CounSelect->reset(Zend_Db_Select::FROM)->reset(Zend_Db_Select::COLUMNS);
        $o_CounSelect->from($this->_name, new Zend_Db_Expr('COUNT(*) AS zend_paginator_row_count'));
        $o_Adapter->setRowCount($o_CounSelect);
        $o_Paginator = new Zend_Paginator($o_Adapter);
        $o_Paginator->setCurrentPageNumber((int)$paged)
                ->setDefaultPageRange($this->_pageRange);
        return $o_Paginator;
    }

    public function saveProduct($info) {
        
    }    
}