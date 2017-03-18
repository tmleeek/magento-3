<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */ 
class Amasty_Spercent_Block_Adminhtml_Method_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        
        /* @var $hlp Amasty_Spercent_Helper_Data */
        $hlp = Mage::helper('amspercent');
    
        $fldInfo = $form->addFieldset('general', array('legend'=> $hlp->__('General')));
        $fldInfo->addField('name', 'text', array(
            'label'     => $hlp->__('Name'),
            'required'  => true,
            'name'      => 'name',
        ));
         
        $fldInfo->addField('percent', 'text', array(
            'label'     => $hlp->__('Percent'),
            'required'  => true,
            'name'      => 'percent',
        ));  
               
        $fldInfo->addField('min', 'text', array(
            'label'     => $hlp->__('Min. Value'),
            'name'      => 'min',
        )); 
        
        $fldInfo->addField('max', 'text', array(
            'label'     => $hlp->__('Max. Value'),
            'name'      => 'max',
        )); 
        
        $fldOrder = $form->addFieldset('condition', array('legend'=> $hlp->__('Conditions')));
        $fldOrder->addField('order_amount', 'text', array(
            'label'     => $hlp->__('Order Total'),
            'name'      => 'order_amount',
        ));
         
        $fldOrder->addField('flat_rate', 'text', array(
            'label'     => $hlp->__('Flat Rate'),
            'name'      => 'flat_rate',
            'note'      => $hlp->__('Will be used when the order total is less than the value specified above'),
        ));        
        
        //set form values
        $form->setValues(Mage::registry('amspercent_method')->getData()); 
        
        return parent::_prepareForm();
    }
}