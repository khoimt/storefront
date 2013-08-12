<?php

interface SF_Model_Acl_Interface
{
    public function setIdentify($identify);
    public function getIdentify();
    public function setAcl(SF_Acl_Interface $acl);

    /**
     * @return Zend_Acl
     */
    public function getAcl();
    public function checkAcl($sz_Action);
}