<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_EnquirySaver_Block_Adminhtml_Enquiries_Edit  extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Turiknox_EnquirySaver_Block_Adminhtml_Enquiries_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_controller = 'adminhtml_enquiries';
        $this->_blockGroup = 'turiknox_enquirysaver';

        $this->_removeButton('reset');
        $this->_removeButton('save_and_edit_button');
        $this->_removeButton('save');

    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $enquiryId = '';
        if ($enquiry = Mage::registry('enquiry')) {
            $enquiryId = $enquiry->getId();
        }
        return $this->__('Solicitud de contacto: #%s', $enquiryId);
    }

}