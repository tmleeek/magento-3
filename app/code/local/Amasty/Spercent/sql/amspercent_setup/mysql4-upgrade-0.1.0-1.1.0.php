<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Spercent
 */
$this->startSetup();
$this->run("
CREATE TABLE `{$this->getTable('amspercent/method')}` (
  `method_id`   mediumint(8) unsigned NOT NULL auto_increment,
  `name`        varchar(255) default '', 
  `percent`     decimal(9,2), 
  `min`         decimal(9,2), 
  `max`         decimal(9,2), 
  `cats`        text, 
  `prods`       text, 
  PRIMARY KEY  (`method_id`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$this->endSetup();