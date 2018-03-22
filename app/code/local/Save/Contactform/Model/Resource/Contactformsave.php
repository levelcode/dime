<?php
/**
 * Created by PhpStorm.
 * User: liz.cherukalethu
 * Date: 09/02/2017
 * Time: 15:57
 */

class Save_Contactform_Model_Resource_Contactformsave extends Mage_Core_Model_Resource_Db_Abstract
{
    /***
     * Initialize resource model
     */
    public function _construct()
    {
        $this->_init('contactform/contactformsave','contact_id');
    }

}