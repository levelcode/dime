<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_EnquirySaver_Adminhtml_EnquirysaverController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title($this->getEnquiryTitle());
        $this->renderLayout();
    }

    /**
     * Edit action
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $enquiryModel = Mage::getModel('turiknox_enquirysaver/enquiries');

        if ($id) {
            $enquiryModel->load($id);
            if (!$enquiryModel->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This enquiry no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        Mage::register('enquiry', $enquiryModel);

        $this->loadLayout();
        $this->_title($this->getEnquiryTitle());
        $this->renderLayout();
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0 ) {
            try {
                $enquiryModel = Mage::getModel('turiknox_enquirysaver/enquiries');
                $enquiryModel->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Enquiry was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Mass delete contact enquiries
     */
    public function massDeleteAction()
    {
        $enquiryIds = $this->getRequest()->getParam('enquiry_id');

        if(!is_array($enquiryIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select enquiries.'));
        } else {
            try {
                $enquiryModel = Mage::getModel('turiknox_enquirysaver/enquiries');
                foreach ($enquiryIds as $enquiryId) {
                    $enquiryModel->load($enquiryId)->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->__(
                        'A total of %d record(s) were deleted.', count($enquiryIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * Get page title
     * @return string
     */
    public function getEnquiryTitle()
    {
        return $this->__('Contact Form Enquiries');
    }
}