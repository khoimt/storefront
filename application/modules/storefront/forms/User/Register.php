<?php

class Storefront_Form_User_Register extends Storefront_Form_User_Base
{

	public function init()
	{
		parent::init();
		
		// specialize this form
		$this->removeElement('userId');
		$this->getElement('submit')->setLabel('Register');
	}

}