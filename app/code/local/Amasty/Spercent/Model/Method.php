<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */

/**
 * @author Amasty
 */ 
class Amasty_Spercent_Model_Method extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('amspercent/method');
    }
    
    public function getHash($type='cats')
    {
        $map = $this->getData($type);
        if (!$map){
            return array();
        }
        
        $map = unserialize($map);
        if (!is_array($map)){
            return array();
        }
        
        $res = array();
        foreach ($map['id'] as $k => $v){
            if (!$v){
                continue;
            }
            $ids = explode(',', $v);
            $val  = isset($map['val'][$k])  ? floatval($map['val'][$k])  : 0;
            $flat = isset($map['flat'][$k]) ? floatval($map['flat'][$k]) : 0;
            foreach($ids as $id){
                $res[$id] = array('percent'=>$val, 'flat'=>$flat);
            }
        }
        return $res;
    }
}