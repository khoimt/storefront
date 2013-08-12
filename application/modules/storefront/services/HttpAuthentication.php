<?php

class Storefront_Service_HttpAuthentication 
extends Storefront_Service_Authentication
{

	public function __construct(Storefront_Model_User $userModel = null, $options)
	{
		parent::__construct($userModel);
		$this->getAuthAdapter($options);
	}

	public function authenticate($credentials)
	{
		$adapter = $this->getAuthAdapter($credentials);
		$auth = $this->getAuth();
		$result = $auth->authenticate($adapter);
		
		if (!$result->isValid())
		{
			return false;
		}
		
		$arr = $result->getIdentity();
		$user = $this->_userModel->getUserByEmail($arr['username']);

		$auth->getStorage()->write($user);

		return true;
	}
	
	public function logout() 
	{
		$this->clear();
		$this->getAuthAdapter()->logout();
	}
	
	public function getAuthAdapter($values = null)
	{
		if ($values === null) {
			return $this->_authAdapter;
		}
		
		if (null === $this->_authAdapter)
		{
			$authAdapter = new Storefront_Auth_Adapter_Http(
				array(
					'accept_schemes' => 'basic',
					'realm'          => 'sample',
//					'digest_domains' => '',
					'nonce_timeout'  => 3600,
				)
			);
			$this->setAuthAdapter($authAdapter);
			$this->_authAdapter->setRequest($values['request']);
			$this->_authAdapter->setResponse($values['response']);
			$this->_authAdapter->setResolver($values['resolver']);
		}
		return $this->_authAdapter;
	}
}