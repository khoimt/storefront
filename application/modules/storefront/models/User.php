<?php

class Storefront_Model_User extends SF_Model_Acl_Abstract {

    /**
     *
     * @return string
     */
    public function getResourceId()
    {
        return 'User';
    }

    /**
     *
     * @param Storefront_Model_Acl_Storefront $acl
     */
    public function setAcl(SF_Acl_Interface $acl)
    {
        if(!$acl->has($this->getResourceId())) {
            $acl->add($this);
            $acl->allow('Guest', $this, array('register'))
                ->allow('Customer', $this, array('saveUser'))
                ->allow('Admin', $this);
            $this->_acl = $acl;
        }
        return $this;
    }

    /**
     * @return Zend_Acl
     */
    public function getAcl()
    {
        if ($this->_acl === null) {
            $this->setAcl(new Storefront_Model_Acl_Storefront);
        }
        return $this->_acl;
    }

    public function getUserById($id) {
        $id = (int) $id;
        return $this->getResource('User')->getUserById($id);
    }

    public function getUserByEmail($email, $ignoreUser = null) {
        return $this->getResource('User')
                        ->getUserByEmail($email, $ignoreUser);
    }

    public function getUsers($paged = false, $order = null) {
        return $this->getResource('User')
                        ->getUsers($paged, $order);
    }

    public function registerUser($post) {
        $form = $this->getForm('userRegister');
        return $this->_save(
                        $form, $post, array('role' => 'Customer')
        );
    }

    public function saveUser($post) {
        $form = $this->getForm('userEdit');
        return $this->_save($form, $post);
    }

    protected function _save(Zend_Form $form, array $info, $defaults = array()) {
        if (!$form->isValid($info)) {
            return false;
        }
        // get filtered values
        $data = $form->getValues();
        // password hashing
        if (array_key_exists('passwd', $data) && '' != $data['passwd']
        ) {
            $data['salt'] = md5($this->createSalt());
            $data['passwd'] = sha1($data['passwd']
                    . $data['salt']);
        } else {
            unset($data['passwd']);
        }
        // apply any defaults
        foreach ($defaults as $col => $value) {
            $data[$col] = $value;
        }
        $user = array_key_exists('userId', $data) ?
                $this->getResource('User')
                        ->getUserById($data['userId']) : null;
        return $this->getResource('User')
                        ->saveRow($data, $user);
    }

    private function createSalt() {
        $salt = '';
        for ($i = 0; $i < 50; $i++) {
            $salt .= chr(rand(33, 126));
        }
        return $salt;
    }

   

}