<?php

class Dc_CurrencySymbolPosition_Model_Observer extends Varien_Event_Observer
{
 
    public function applyPosition($observer)
    {
        $_options = $observer->getEvent()->getCurrencyOptions();
        $_base_code = $observer->getEvent()->getBaseCode();
 
        if($_base_code == 'USD') {
            $_options['position'] = Zend_Currency::RIGHT;
        }
 
        return $this;
    }
 
}