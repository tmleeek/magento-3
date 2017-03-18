<?php
/**
 * EmJa Interactive, LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.emjainteractive.com/LICENSE.txt
 *
 * @category   EmJaInteractive
 * @package    EmJaInteractive_ShippingOption
 * @copyright  Copyright (c) 2010 EmJa Interactive, LLC. (http://www.emjainteractive.com)
 * @license    http://www.emjainteractive.com/LICENSE.txt
 */

class Emjainteractive_ShippingOption_Block_Renderer_Checkbox extends Emjainteractive_ShippingOption_Block_Renderer_Abstract
{
    protected function _renderLabel()
    {
        $req = $this->_getIsRequired() ? true : false;
        if ($req) {
            $html = '<label class="required" for="'. $this->_getElementId() .'"><em>*</em>' . $this->getOption()->getLabel() . '</label>&nbsp;';
        } else {
            $html = '<label for="'. $this->_getElementId() .'">' . $this->getOption()->getLabel() . '</label>&nbsp;';
        }
        
        return $html;
    }
    
    protected function _renderElement()
    {
        $value = $this->getValue();
        $val = is_array($value) ? $value[$this->getCarrier()][$this->getOption()->getCode()] : $this->getOption()->getDefaultValue();
        if( $val == '1' ) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }
        
        $req = $this->_getIsRequired() ? 'class="required-entry"' : '';
        $html = '<input '.$req.' type="checkbox" name="' . $this->_getElementName() . '" id="' . $this->_getElementId() . '" value="1" ' . $checked . ' />';
        return $html;
    }
}
