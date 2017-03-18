<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */

/**
 * @author Amasty
 */   
class Amasty_Spercent_Block_Adminhtml_Method extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_method';
        $this->_blockGroup = 'amspercent';
        $this->_headerText = Mage::helper('amspercent')->__('Methods');
        $this->_addButtonLabel = Mage::helper('amspercent')->__('Add Method');
        parent::__construct();
    }
}