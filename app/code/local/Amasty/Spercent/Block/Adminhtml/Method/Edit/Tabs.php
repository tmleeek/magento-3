<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */
class Amasty_Spercent_Block_Adminhtml_Method_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('methodTabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('amspercent')->__('Method Options'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('general', array(
            'label'     => Mage::helper('amspercent')->__('General'),
            'content'   => $this->getLayout()->createBlock('amspercent/adminhtml_method_edit_tab_general')->toHtml(),
        ));
        
        $name = Mage::helper('amspercent')->__('Categories');
        $this->addTab('cats', array(
            'label'     => $name,
            'content'   => $this->getLayout()->createBlock('amspercent/adminhtml_method_edit_tab_cats')->setTitle($name)->toHtml(),
        ));
        
        $name = Mage::helper('amspercent')->__('Products');
        $this->addTab('prods', array(
            'label'     => $name,
            'content'   => $this->getLayout()->createBlock('amspercent/adminhtml_method_edit_tab_prods')->setTitle($name)->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}