<?php

class Storefront_IndexController extends Zend_Controller_Action 
{
    public function init()
    {    
    }
    
    public function indexAction()
    {
        $o_Catalog = new Storefront_Model_Catalog();
        $arr = $o_Catalog->getCategoriesByParentId(0);
        print_r($arr->toArray());
    }
	
	public function localeAction() 
	{
		$this->_helper->ViewRenderer->setNorender(true);
		$usLocale = new Zend_Locale('auto');
		$date = new Zend_Date('2006', Zend_Date::YEAR, $usLocale);
		// $temp = new Zend_Measure_Temperature('100,10',
										 // Zend_Measure::TEMPERATURE,
										 // $usLocale);
										 
		echo $usLocale;
		echo PHP_EOL;
		echo '<br />';
		echo $date;
		echo PHP_EOL;
		echo '<br />';
		echo $temp;
	}

    public function listLocaleAction()
    {
		echo '<pre>';
		var_dump(setlocale(LC_ALL, 0));
		echo '<hr />';
		var_dump(localeconv());
		echo '</pre>';
		echo '<hr />';
		$this->_helper->ViewRenderer->setNorender(true);
		
        print_r(array_keys(Zend_Locale::getLocaleList()));
    }
}