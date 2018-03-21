<?php
 
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
-- DROP TABLE IF EXISTS {$this->getTable('contactus')};
CREATE TABLE {$this->getTable('contactus')} (
  `contactus_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `empresa` varchar(255) NOT NULL default '',
  `ciudad` varchar(255) NOT NULL default '',
  `como` varchar(255) NOT NULL default '',
  `telephone` varchar(255) NOT NULL default '',
  `comment` text NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`contactus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ");
 
$installer->endSetup(); 
 
?>