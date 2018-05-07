<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_EnquirySaver_Block_Adminhtml_Enquiries_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Turiknox_EnquirySaver_Block_Adminhtml_Enquiries_Edit_Form constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('contactenquiry_form');
        $this->setTitle($this->setFormTitle());
    }

    /**
     * Prepare the enquiry form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $enquiryModel = Mage::registry('enquiry');
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form'
        ));

        $fieldset = $form->addFieldset('enquiry_general', array(
            'legend'=> $this->__('Solicitud de Contacto'),
            'class' => 'fieldset-wide',
        ));

        if ($enquiryModel->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $field =$fieldset->addField('store_id', 'multiselect', array(
                'name'      => 'stores[]',
                'label'     => $this->__('Store View'),
                'title'     => $this->__('Store View'),
                'readonly'  => true,
                'disabled' => true,
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
            $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
            $field->setRenderer($renderer);
        }

        $fieldset->addField('name', 'text', array(
            'name' 		=> 'name',
            'label' 	=> $this->__('Name'),
            'title' 	=> $this->__('Name'),
            'readonly'	=> true,
        ));

        $fieldset->addField('email', 'text', array(
            'name' 		=> 'email',
            'label' 	=> $this->__('Email Address'),
            'title' 	=> $this->__('Email Address'),
            'readonly'	=> true,
        ));

        $fieldset->addField('telephone', 'text', array(
            'name' 		=> 'telephone',
            'label' 	=> $this->__('Telephone'),
            'title' 	=> $this->__('Telephone'),
            'readonly'	=> true,
        ));

        $fieldset->addField('ciudad', 'text', array(
            'name'      => 'telephone',
            'label'     => $this->__('Ciudad'),
            'title'     => $this->__('Ciudad'),
            'readonly'  => true,
        ));

        $fieldset->addField('como', 'text', array(
            'name'      => 'telephone',
            'label'     => $this->__('Cómo se Entero de DIME'),
            'title'     => $this->__('Cómo se Entero de DIME'),
            'readonly'  => true,
        ));


        $fieldset->addField('empresa', 'text', array(
            'name'      => 'empresa',
            'label'     => $this->__('Empresa'),
            'title'     => $this->__('Empresa'),
            'readonly'  => true,
        ));

        $fieldset->addField('comment', 'textarea', array(
            'name' 		=> 'comment',
            'label' 	=> $this->__('Comment'),
            'title' 	=> $this->__('Comment'),
            'readonly'	=> true,
        ));


        if ($enquiry = Mage::registry('enquiry')) {
            $form->setValues($enquiry->getData());
        }
        
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Set form page title
     * @return mixed
     */
    public function setFormTitle()
    {
        if ($enquiry = Mage::registry('enquiry')) {
            return $this->__('Enquiry: #%s', $enquiry->getid());
        }
        return $this->__('Contact Enquiry Information');
    }

}