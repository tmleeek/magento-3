<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2016 Amasty (https://www.amasty.com)
 * @package Amasty_Table
 */
$installer = $this;

$installer->startSetup();

$installer->run("
  ALTER TABLE  `{$this->getTable('amtable/rate')}`  DROP COLUMN  `time_delivery`;
  ALTER TABLE  `{$this->getTable('amtable/rate')}`  ADD  `time_delivery` INT( 10 ) NOT NULL DEFAULT '0' AFTER  `cost_weight`;
");