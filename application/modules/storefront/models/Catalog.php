<?php

class Storefront_Model_Catalog extends SF_Model_Abstract 
{
    public function getCategoriesByParentId($i_ParentId)
    {
        return $this->getResource('Category')
                ->getCategoriesByParentId($i_ParentId);
    }
    
    public function getCategoryByIdent($sz_Ident)
    {
        return $this->getResource('Category')
                ->getCategoryByIdent($sz_Ident);
    }
    
    public function getProductById($i_Id)
    {
        return $this->getResource('Product')
                ->getProductById($i_Id);
    }
    
    public function getProductByIdent($sz_Ident)
    {
        return $this->getResource('Product')
                ->getProductByIdent($sz_Ident);
    }
    
    public function getProductsByCategory($category, $paged=false, $order=null, $deep=true)
    {
        if (is_string($category)) {
            $cat = $this->getResource('Category')->getCategoryByIdent($category);
            $categoryId = null === $cat ? 0 : $cat->categoryId;
        } else {
            $categoryId = $category;
        }
        
        if (true === $deep) {
            $ids = $this->getCategoryChildrenIds($categoryId, true);
            $ids[] = $categoryId;
            $categoryId = null === $ids ? $categoryId : $ids;
        }
        
        return $this->getResource('Product')->getProductsByCategory($categoryId, $paged, $order);
    }
    
    /**
     * Get a categories children categoryId values
     *
     * @param int     $categoryId The category to get children from
     * @param boolean $recursive  Get the entire category branch?
     * @return array An array of ids
     */
    public function getCategoryChildrenIds($categoryId, $recursive = false)
    {
        $categories = $this->getCategoriesByParentId($categoryId);
        $cats = array();
               
        foreach ($categories as $category) {
            $cats[] = $category->categoryId;
            
            if (true === $recursive) {
                $cats = array_merge($cats, $this->getCategoryChildrenIds($category->categoryId, true));
            }
        }

        return $cats;
    }
    
    /**
     * Get a categories parents
     * 
     * @param Storefront_Resource_Category_Item $category
     * @param boolean Append the parent to the cats array?
     * @return array
     */
    public function getParentCategories($category, $appendParent = true)
    {
        $cats = $appendParent ? array($category) : array();
        
        if (0 == $category->parentId) {
            return $cats;
        }

        $parent = $category->getParentCategory();
        $cats[] = $parent;
        
        if (0 != $parent->parentId) {
            $cats =  array_merge($cats, $this->getParentCategories($parent, false));
        }
        
        return $cats;
    }
}