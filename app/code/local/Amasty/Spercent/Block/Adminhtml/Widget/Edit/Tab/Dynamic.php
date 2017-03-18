<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */ 
class Amasty_Spercent_Block_Adminhtml_Widget_Edit_Tab_Dynamic extends Mage_Adminhtml_Block_Widget_Form
{
    protected $_fields  = array('id', 'val', 'flat');
    protected $_buttons = array();
    protected $_model   = 'amspercent_method';
    protected $_code    = '';
    
    public function __construct()
    {
        parent::__construct();
    } 
    
    public function getDynamicJs()
    {
        $code = $this->getCode();
        $js = '
            function addDynamic'.$code.'() {
                Element.insert($("'.$code.'_container"), {bottom: $("'.$code.'_template").innerHTML});
            }
            function removeDynamic'.$code.'(button){
                Element.remove(button.up(".field-row"));
            }        
        ';
        return $js;
    }
    
    public function getRemoveDynamicButtonHtml()
    {
        $code = $this->getCode();
        if (empty($this->_buttons['rm'.$code])) {
            $this->_buttons['rm'.$code] = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setClass('delete')->setLabel($this->__(''))
                ->setOnClick("removeDynamic$code(this)")->toHtml();
        }
        return $this->_buttons['rm'.$code];
    }    
    
    public function getAddDynamicButtonHtml()
    {
        $code = $this->getCode();
        if (empty($this->_buttons['add'.$code])) {
            $this->_buttons['add'.$code] = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setClass('add')->setLabel($this->__('Add '))
                ->setOnClick("addDynamic$code()")->toHtml();
        }
        return $this->_buttons['add'.$code];
    } 
    
    public function getDynamicValue()
    {
        $code = $this->getCode();
        $res = array();
        
        $map = Mage::registry($this->_model)->getData($code);
        $firstEl = current($this->_fields);
        if ($map){
            foreach ($map[$firstEl] as $k => $v){
                $line = array();
                foreach ($this->_fields as $field){
                    $line[$field] = isset($map[$field][$k]) ? $map[$field][$k] : '';
                }
                $res[] = $line;
            }
            $last = count($res)-1;
            if (isset($res[$last]) && !$res[$last][$firstEl])
                unset($res[$last]);
        }
        return $res;
    } 
    
    public function getValueHtml($key, $defVal='')
    {
        $val = Mage::registry($this->_model)->getData($key);
        if (!$val){
            $val = $defVal;
        }
        return $this->htmlEscape($val);
    }  

    public function getCode()
    {
        return $this->_code;
    }   
}