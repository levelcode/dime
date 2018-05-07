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

        $this->setDefaultDir('desc');
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
                'header'=> $this->__('Id de Solicitud'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'enquiry_id'
            )
        );

        $this->addColumn('name',
            array(
                'header'=> $this->__('Nombre'),
                'index' => 'name'
            )
        );

        $this->addColumn('email',
            array(
                'header'=> $this->__('Correo Electrónico'),
                'index' => 'email'
            )
        );
        $this->addColumn('empresa',
            array(
                'header'=> $this->__('Empresa'),
                'index' => 'empresa'
            )
        );
        $this->addColumn('ciudad',
            array(
                'header'=> $this->__('Ciudad'),
                'index' => 'ciudad'
            )
        );
        $this->addColumn('como',
            array(
                'header'=> $this->__('Cómo se Entero de DIME'),
                'index' => 'como'
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
                'header'=> $this->__('Fecha de creación'),
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
            'label'=> Mage::helper('tax')->__('Borrar'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('tax')->__('Esta Seguro?')
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