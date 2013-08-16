<?php

class Storefront_Form_User_Edit extends Storefront_Form_User_Base
{
	public function init()
	{
		parent::init();
		
		// specialize this form
		$this->getElement('passwd')->setRequired(false);
		$this->getElement('passwdVerify')->setRequired(false);
		$this->getElement('submit')->setLabel('Save User');
	}

}