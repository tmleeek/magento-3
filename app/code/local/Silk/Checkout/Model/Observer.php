<?php
/**
 * Copyright (c) 2016, SILK Software
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the SILK Software.
 * 4. Neither the name of the SILK Software nor the
 *   names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY SILK Software ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL SILK Software BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * Created by PhpStorm.
 */

class Silk_Checkout_Model_Observer
{
    public function addAdditionalDataToComment($observer)
    {
        //Mage::log(Mage::registry('customerCommentAdded'),null,"ordersaveafter.log");
        //Mage::log(Mage::registry('customerComment'),null,"ordersaveafter.log");
        //$order->setCustomerNoteNotify(false);
        if (Mage::registry('customerCommentAdded')) {
            $orderComment = Mage::app()->getRequest()->getPost('ordercomment');
            if (is_array($orderComment) && isset($orderComment['comment'])) {
                $comment = trim($orderComment['comment']);
            } else {
                $comment = '';
            }

            $order                           = $observer->getEvent()->getOrder();
            //Mage::log($order->debug(),null,"ordersaveafter.log");
            //$quote = $order->getQuote();
            $commentData                     = array();
            $commentData['customer_comment'] = $comment;
            $commentData['customer_own_shipping'] = array();
            if ($customShippingInfo = $order->getData('emjainteractive_shippingoption')) {
                try {
                    $customShippingInfoObj = unserialize($customShippingInfo);
                    //Mage::log($customShippingInfoObj,null,"ordersaveafter.log");
                    if (isset($customShippingInfoObj['umosaco'])) {
                        $commentData['customer_own_shipping'] = $customShippingInfoObj['umosaco'];
                    }
                }
                catch (Exception $e) {
                    Mage::logException($e);
                }
            }
            $specialOrderIdentifier = $order->getData('special_order_identifier');
            if($specialOrderIdentifier ==1){
            $commentData['special_order'] = '1';
            } else {
            $commentData['special_order'] = '0';
            }
            $commentString                = json_encode($commentData, true);
            //Mage::log($commentString,null,"ordersaveafter.log");
            $order->setCustomerNote($commentString);
            Mage::unregister('customerComment');
            Mage::register('customerComment', $commentString);
            Mage::log(Mage::registry('customerComment'), null, "ordersaveafter.log");
        }
    }

    public function checkoutTypeOnepageSaveOrder($observer)
    {
      /** @var Mage_Sales_Model_Order $order */
      $param = Mage::app()->getRequest()->getParam('silk_checkout_specialorder', 'off');
      //Mage::log($param,null,"saveorder.log");
      if($param == 'on') {$param = 1;} else {$param = 0;}
      //Mage::log($param,null,"saveorder.log");
      //$observer->getOrder()->setSpecialOrderIdentifier($param);
      $order                           = $observer->getEvent()->getOrder();
      $order->setSpecialOrderIdentifier($param);
      //Mage::log($order->debug(),null,"saveorder.log");
    }
}
