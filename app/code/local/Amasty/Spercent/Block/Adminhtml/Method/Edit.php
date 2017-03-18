<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */
class Amasty_Spercent_Block_Adminhtml_Method_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id'; 
        $this->_blockGroup = 'amspercent';
        $this->_controller = 'adminhtml_method';
    }

    public function getHeaderText()
    {
        return Mage::helper('amspercent')->__('Method');
    }
}