<?php

class Storefront_Service_Authentication
{

	/**
	 * @var Zend_Auth_Adapter_DbTable
	 */
	protected $_authAdapter;

	/**
	 * @var Storefront_Model_User
	 */
	protected $_userModel;

	/**
	 * @var Zend_Auth
	 */
	protected $_auth;

    protected static $_instance;

	/**
	 * Construct 
	 * 
	 * @param null|Storefront_Model_User $userModel 
	 */
    protected function __construct(Storefront_Model_User $userModel = null)
	{
		$this->_userModel = null === $userModel ? new Storefront_Model_User() : $userModel;
	}

    public static function getInstance(Storefront_Model_User $userModel = null)
    {
        if (null === self::$_instance) {
            self::$_instance = new self($userModel);
        }
        return self::$_instance;
    }

	/**
	 * Authenticate a user
	 *
	 * @param  array $credentials Matched pair array containing email/passwd
	 * @return boolean
	 */
	public function authenticate($credentials)
	{
		$adapter = $this->getAuthAdapter($credentials);
		$auth = $this->getAuth();
		$result = $auth->authenticate($adapter);

		if (!$result->isValid())
		{
			return false;
		}

		$user = $this->_userModel->getUserByEmail($credentials['email']);

		$auth->getStorage()->write($user);

		return true;
	}

	public function getAuth()
	{
		if (null === $this->_auth)
		{
			$this->_auth = Zend_Auth::getInstance();
		}
		return $this->_auth;
	}

    /**
     *
     * @return mixed|null|false
     */
	public function getIdentity()
	{
		$auth = $this->getAuth();
		if ($auth->hasIdentity())
		{
			return $auth->getIdentity();
		}
		return false;
	}

	/**
	 * Clear any authentication data
	 */
	public function clear()
	{
		$this->getAuth()->clearIdentity();
	}

	/**
	 * Set the auth adpater.
	 *
	 * @param Zend_Auth_Adapter_Interface $adapter
	 */
	public function setAuthAdapter(Zend_Auth_Adapter_Interface $adapter)
	{
		$this->_authAdapter = $adapter;
	}

	/**
	 * Get and configure the auth adapter
	 * 
	 * @param  array $value Array of user credentials
	 * @return Zend_Auth_Adapter_DbTable
	 */
	public function getAuthAdapter($values)
	{
		if (null === $this->_authAdapter)
		{
			$authAdapter = new Zend_Auth_Adapter_DbTable(
							Zend_Db_Table_Abstract::getDefaultAdapter(),
							'user',
							'email',
							'passwd',
							'SHA1(CONCAT(?,salt))'
			);
			$this->setAuthAdapter($authAdapter);
			$this->_authAdapter->setIdentity($values['email']);
			$this->_authAdapter->setCredential($values['passwd']);
		}
		return $this->_authAdapter;
	}

}