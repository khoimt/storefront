<?php

interface Storefront_Resource_User_Interface extends SF_Model_Resource_Db_Interface
{
    public function getUserById($id);

    public function getUserByEmail($email);

    public function getUsers($paged = false, $order = null);
}