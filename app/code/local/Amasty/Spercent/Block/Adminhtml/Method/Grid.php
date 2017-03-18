<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */ 
class Amasty_Spercent_Block_Adminhtml_Method_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('methodGrid');
      $this->setDefaultSort('method_id');
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('amspercent/method')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
    $hlp =  Mage::helper('amspercent'); 
    $this->addColumn('method_id', array(
      'header'    => $hlp->__('ID'),
      'align'     => 'right',
      'width'     => '50px',
      'index'     => 'method_id',
    ));
    
    $this->addColumn('name', array(
        'header'    => $hlp->__('Name'),
        'index'     => 'name',
    ));
    
    $this->addColumn('percent', array(
        'header'    => $hlp->__('Percent'),
        'index'     => 'percent',
    ));
    
    $this->addColumn('min', array(
        'header'    => $hlp->__('Min. Value'),
        'index'     => 'min',
    ));    
    
    $this->addColumn('max', array(
        'header'    => $hlp->__('Max. Value'),
        'index'     => 'max',
    ));    

    return parent::_prepareColumns();
  }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }
  
  protected function _prepareMassaction()
  {
    $this->setMassactionIdField('method_id');
    $this->getMassactionBlock()->setFormFieldName('methods');
    
    $this->getMassactionBlock()->addItem('delete', array(
         'label'    => Mage::helper('amspercent')->__('Delete'),
         'url'      => $this->getUrl('*/*/massDelete'),
         'confirm'  => Mage::helper('amspercent')->__('Are you sure?')
    ));
    
    return $this; 
  }

}