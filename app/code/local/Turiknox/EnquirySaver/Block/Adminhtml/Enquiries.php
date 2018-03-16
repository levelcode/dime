<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_EnquirySaver_Block_Adminhtml_Enquiries extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Turiknox_EnquirySaver_Block_Adminhtml_Enquiries constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_controller = 'adminhtml_enquiries';
        $this->_blockGroup = 'turiknox_enquirysaver';
        $this->_headerText = $this->__('Contact Form Enquiries');

        $this->_removeButton('add');
    }
}