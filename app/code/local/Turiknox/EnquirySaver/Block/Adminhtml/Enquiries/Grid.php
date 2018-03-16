<?php
/*
 * Turiknox_EnquirySaver

 * @category   Turiknox
 * @package    Turiknox_EnquirySaver
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento-enquiry-saver/blob/master/LICENSE.md
 * @version    1.0.0
 */
class Turiknox_EnquirySaver_Block_Adminhtml_Enquiries_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Turiknox_EnquirySaver_Block_Adminhtml_Enquiries_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultDir('asc');
        $this->setDefaultSort('enquiry_id');
        $this->setId('contactenquiry_grid');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare grid collection
     * @return mixed
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('turiknox_enquirysaver/enquiries')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     * @return mixed
     */
    protected function _prepareColumns()
    {
        $this->addColumn('enquiry_id',
            array(
                'header'=> $this->__('Enquiry ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'enquiry_id'
            )
        );

        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'name'
            )
        );

        $this->addColumn('email',
            array(
                'header'=> $this->__('Email Address'),
                'index' => 'email'
            )
        );

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => $this->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addColumn('created_at',
            array(
                'header'=> $this->__('Created At'),
                'index' => 'created_at'
            )
        );


        return parent::_prepareColumns();
    }

    /**
     * Prepare massaction section
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('enquiry_id');
        $this->getMassactionBlock()->setFormFieldName('enquiry_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('tax')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('tax')->__('Are you sure?')
        ));

        return $this;
    }

    /**
     * Get the row edit URL
     *
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Add grid store filter
     * @param $collection
     * @param $column
     */
    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }
}