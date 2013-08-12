<?php

class Storefront_Auth_Adapter_Http extends Zend_Auth_Adapter_Http 
{
	public function setResolver(array $options) 
	{
		$resolver = new Zend_Auth_Adapter_Http_Resolver_File($options['path']);
		$this->setBasicResolver($resolver);
	}
	
	public function logout()
	{
		return $this->_challengeClient();
	}
}