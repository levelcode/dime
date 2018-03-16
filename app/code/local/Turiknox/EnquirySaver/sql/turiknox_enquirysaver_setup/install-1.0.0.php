<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
$installer = $this;
$installer->startSetup();

if (!$installer->tableExists('turiknox_enquirysaver/enquiries')) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('turiknox_enquirysaver/enquiries'))
        ->addColumn(
            'enquiry_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
            ),
            'Enquiry ID'
        )
        ->addColumn(
            'name',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            255,
            array(
                'nullable' => false,
            ),
            'Name'
        )
        ->addColumn(
            'email',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            255,
            array(
                'nullable' => false,
            ),
            'Email Address'
        )
        ->addColumn(
            'telephone',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            255,
            array(
                'nullable' => false,
            ),
            'Telephone'
        )
        ->addColumn(
            'comment',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            null,
            array(
                'nullable' => false,
            ),
            'Comment'
        )
        ->addColumn(
            'store_id',
            Varien_Db_Ddl_Table::TYPE_SMALLINT,
            null,
            array(
                'nullable' => false,
            ),
            'Store ID'
        )
        ->addColumn('created_at',
            Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
            null,
            array(
                'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT
            ), 'Date Added'
        );


    $installer->getConnection()->createTable($table);
}
$installer->endSetup();
