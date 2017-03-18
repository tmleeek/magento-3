<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */
$this->startSetup();
$this->run("

ALTER TABLE `{$this->getTable('amspercent/method')}` 
ADD `order_amount` DECIMAL( 9, 2 ) NOT NULL AFTER `max` ,
ADD `flat_rate` DECIMAL( 9, 2 ) NOT NULL AFTER `order_amount` ,
ADD `use_flat_rate` TINYINT( 1 ) NOT NULL AFTER `flat_rate` 

");
$this->endSetup();