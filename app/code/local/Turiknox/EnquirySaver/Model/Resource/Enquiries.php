<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_EnquirySaver_Model_Resource_Enquiries extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('turiknox_enquirysaver/enquiries', 'enquiry_id');
    }
}