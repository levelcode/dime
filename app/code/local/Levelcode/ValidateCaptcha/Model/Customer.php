<?php
class Levelcode_ValidateCaptcha_Model_Customer extends Mage_Customer_Model_Customer {

    /**
     * Validate customer attribute values.
     *
     * @return bool
     */
    public function validate()
    {
        // This section is from the core file
        $errors = array();
        if (!Zend_Validate::is( trim($this->getFirstname()) , 'NotEmpty')) {
            $errors[] = Mage::helper('customer')->__('The first name cannot be empty.');
        }

        if (!Zend_Validate::is( trim($this->getLastname()) , 'NotEmpty')) {
            $errors[] = Mage::helper('customer')->__('The last name cannot be empty.');
        }

        if (!Zend_Validate::is($this->getEmail(), 'EmailAddress')) {
            $errors[] = Mage::helper('customer')->__('Invalid email address "%s".', $this->getEmail());
        }

        $password = $this->getPassword();
        if (!$this->getId() && !Zend_Validate::is($password , 'NotEmpty')) {
            $errors[] = Mage::helper('customer')->__('The password cannot be empty.');
        }
        if (strlen($password) && !Zend_Validate::is($password, 'StringLength', array(6))) {
            $errors[] = Mage::helper('customer')->__('The minimum password length is %s', 6);
        }
        $confirmation = $this->getPasswordConfirmation();
        if ($password != $confirmation) {
            $errors[] = Mage::helper('customer')->__('Please make sure your passwords match.');
        }

        $entityType = Mage::getSingleton('eav/config')->getEntityType('customer');
        $attribute = Mage::getModel('customer/attribute')->loadByCode($entityType, 'dob');
        if ($attribute->getIsRequired() && '' == trim($this->getDob())) {
            $errors[] = Mage::helper('customer')->__('The Date of Birth is required.');
        }
        $attribute = Mage::getModel('customer/attribute')->loadByCode($entityType, 'taxvat');
        if ($attribute->getIsRequired() && '' == trim($this->getTaxvat())) {
            $errors[] = Mage::helper('customer')->__('The TAX/VAT number is required.');
        }
        $attribute = Mage::getModel('customer/attribute')->loadByCode($entityType, 'gender');
        if ($attribute->getIsRequired() && '' == trim($this->getGender())) {
            $errors[] = Mage::helper('customer')->__('Gender is required.');
        }

        // additional reCAPTCHA validation
        // this should actually be in it's own function, but I've added 
        // it here for simplicity

        // Magento uses this method for a few different requests, so make
        // sure it's limited only to the 'createpost' action
        $action = Mage::app()->getRequest()->getActionName();
        if ( $action == 'createpost' ) { // restrict to the registration page only
            $captcha = Mage::app()->getRequest()->getPost('g-recaptcha-response', 1);
            if ( $captcha == '' ) {
                // if the field is empty, add an error which will be
                // displayed at the top of the page
                $errors[] = Mage::helper('customer')->__('Please check the reCAPTCHA field to continue.');
            } else {
                $secret = '6Lc64EwUAAAAABH3hsnW55x90Am8KpwIwplTzeS7';
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha . '&remoteip=' . $_SERVER["REMOTE_ADDR"];

                $ch = curl_init();
                // if you're testing this locally, you'll likely need to 
                // add your own CURLOPT_CAINFO parameter or you'll get
                // SSL errors
                curl_setopt( $ch, CURLOPT_URL, $url );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec( $ch );

                $result = json_decode( $response, true );
                if ( trim( $result['success'] ) != true ) {
                    // Add reCAPTCHA error
                    // This will be shown at the top of the registration page
                    $errors[] = Mage::helper('customer')->__('reCAPTCHA unable to verify.');
                }
            }
        }

        // now return the errors with your reCAPTCHA validation as well
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }


}