<?php

class SF_Form_Abstract extends Zend_Form
{

    /**
     * @var SF_Model_Interface
     */
    protected $_model;

    /**
     * Model setter
     *
     * @param SF_Model_Interface $model
     */
    public function setModel(SF_Model_Interface $model)
    {
        $this->_model = $model;
    }

    /**
     * Model Getter
     *
     * @return SF_Model_Interface
     */
    public function getModel()
    {
        return $this->_model;
    }

}