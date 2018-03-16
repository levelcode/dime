<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_EnquirySaver_Model_Observer
{
    const XML_PATH_SAVE_ENQUIRIES = 'contacts/contacts/enable';

    /**
     * Save contact form enquiry
     * @param $observer
     */
    public function saveEnquiry($observer)
    {
        if (!$this->isContactSavingEnabled()) {
            return;
        }

        $request = $observer->getControllerAction()->getRequest();
        $post = $request->getPost();

        if (isset($post['hideit']) && Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
            return;
        }

        if ($post) {
            Mage::getModel('turiknox_enquirysaver/enquiries')
                ->setData($post)
                ->setStoreId(Mage::app()->getStore()->getId())
                ->setCreatedAt(Varien_Date::now())
                ->save();
        }
    }

    /**
     * Check if the enquiry forms should be saved within the admin
     * @return bool
     */
    public function isContactSavingEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_SAVE_ENQUIRIES);
    }
}