<?php
/**
 * Created by PhpStorm.
 * User: liz.cherukalethu
 * Date: 13/01/2017
 * Time: 15:45
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS `{$this->getTable('contact_table')}`;
CREATE TABLE `{$this->getTable('contact_table')}` (
  `contact_id` int(11) unsigned NOT NULL auto_increment,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(25) NULL default '',
  `email` varchar(255) NULL default '',
  `ciudad` varchar(50) NULL default '',
  `como` varchar(50) NULL default '',
  `empresa` varchar(50) NULL default '',
  `telephone` varchar(50) NULL default '',
  `comment` varchar(250) NULL default '',
  PRIMARY KEY (`contact_id`),
  INDEX (contact_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup();