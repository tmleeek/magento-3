<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */ 
class Amasty_Spercent_Block_Adminhtml_Method_Edit_Tab_Cats extends Amasty_Spercent_Block_Adminhtml_Widget_Edit_Tab_Dynamic
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('amspercent/dynamic.phtml');
        $this->_code = 'cats';
    } 
    
}