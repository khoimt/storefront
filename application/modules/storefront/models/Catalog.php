<?php

class Storefront_Model_Catalog extends SF_Model_Abstract 
{
    public function getCategoriesByParentId($i_ParentId)
    {
        
    }
    
    public function getCategoryByIdent($sz_Ident)
    {
        
    }
    
    public function getProductById($i_Id)
    {
        
    }
    
    public function getProductByIdent($sz_Ident)
    {
        
    }
    
    public function getProductByCategory($o_Category, $paged= false, 
            $order=null, $deep=true)
    {}
    
    public function getCategoryChildrenIds($i_CategoryId, $b_Recursive=false)
    {}
    
    public function getParentCategories($o_Category)
    {}
}