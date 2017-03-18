<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */
class Amasty_Spercent_Model_Carrier_Percent extends Mage_Shipping_Model_Carrier_Abstract
{
    protected $_code  = 'amspercent';
    protected $_prods = null;

    /**
     * Collect rates for this shipping method based on information in $request
     *
     * @param Mage_Shipping_Model_Rate_Request $data
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request) 
    {
        // skip if not enabled
        if (!$this->getConfigData('active')) {
            return false;
        }

        // containing all the shipping rates of this method
        $result = Mage::getModel('shipping/rate_result');
        
        $collection = Mage::getModel('amspercent/method')->getCollection();
        foreach ($collection as $item){
            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));
            $method->setMethod($this->_code . $item->getId());
            $method->setMethodTitle($item->getName());

            $price = 0;
            if ($request->getFreeShipping() !== true){
                if ($request->getPackageValue() < $item->getOrderAmount()){
                    $price = $item->getFlatRate();
                }
                else {
                    $catsHash  = $item->getHash('cats');
                    $prodsHash = $item->getHash('prods');
                    if ($catsHash || $prodsHash){
                        foreach ($this->_getProducts($request) as $prod){
                            $percent = $item->getPercent();
                            $flat    = 0;
                            if (isset($prodsHash[$prod['id']])){
                                $percent = $prodsHash[$prod['id']]['percent'];
                                $flat    = $prodsHash[$prod['id']]['flat'];
                            }   
                            else {
                                $commonCats = array_intersect(array_keys($catsHash), $prod['cat']);
                                if ($commonCats){ // get value from the first available
                                    $currPos = current($commonCats);  // first available. may be we neeed to find the most expensive?
                                    $percent = $catsHash[$currPos]['percent'];
                                    $flat    = $catsHash[$currPos]['flat'];
                                }
                            }
                            $price = $price + $prod['price']*$percent/100 + $flat;
                        }                    
                    }
                    else {
                        $percent = $item->getPercent();
                        $price = $request->getPackageValue() * $percent / 100;
                    }
                }
                
                if ($item->getMin() > 0.00){
                    $price = max($item->getMin(), $price);
                }
                if ($item->getMax() > 0.00){
                    $price = min($item->getMax(), $price);
                } 
            }
            $method->setCost($price);
            $method->setPrice($price); 
            
            $result->append($method);           
        }

        return $result;
    } 

    public function getAllowedMethods()
    {
        return array($this->_code => $this->getConfigData('name'));
    }
    
    protected function _getProducts($request)
    {
        if (!is_null($this->_prods))
            return $this->_prods;
            
        // loop throug all items in the cart and collect applicapable items
        $this->_prods = array();
        foreach ($request->getAllItems() as $item) {
            if ($item->getParentItem() || $item->getProduct()->isVirtual()) {
                continue;
            }
            if ($item->getHasChildren() && $item->isShipSeparately()){
                foreach ($item->getChildren() as $child) {
                    if ($child->getFreeShipping() || $child->getProduct()->isVirtual()){
                        continue;
                    }
                    $this->_prods[] = array(
                        'qty'   => $child->getQty(), 
                        'price' => $child->getBaseRowTotal(),
                        'cat'   => $child->getProduct()->getCategoryIds(),  //@todo optimize
                        'id'    => $child->getProduct()->getId(),
                    );
                }
            }
            elseif (!$item->getFreeShipping()) {
                $this->_prods[] = array(
                    'qty'   => $item->getQty(), 
                    'price' => $item->getBaseRowTotal(),
                    'cat'   => $item->getProduct()->getCategoryIds(),
                    'id'    => $item->getProduct()->getId(),
                );    
            }
        }
        
        return $this->_prods;
    }     
        
    
}