<?php
require_once 'Mage/Contacts/controllers/IndexController.php';
class Savecontacts_Contactus_IndexController extends Mage_Contacts_IndexController
{
 

  public function postAction()
    {
        $post = $this->getRequest()->getPost();
        if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                }

                if (Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    throw new Exception();
                }

                if(isset($post['empresa'])){
                  $empresa = trim($post['empresa']);
                } else {
                  $empresa = '';
                }

                if(isset($post['ciudad'])){
                  $ciudad = trim($post['ciudad']);
                } else {
                  $ciudad = '';
                }

                if(isset($post['como'])){
                  $como = trim($post['como']);
                } else {
                  $como = '';
                }
        
        if(isset($post['telephone'])){
          $tele = trim($post['telephone']);
        }else{
          $tele = '';
        }
        
        
        $model = Mage::getModel('contacts/contacts');
        $model->setGuestName(trim($post['name']));
        $model->setGuestEmail(trim($post['email']));
        $model->setGuestTelephone($tele);
        $model->setGuestComments(trim($post['comment']));
        
        $model->save();   
          
    

        $translate->setTranslateInline(true); 
        Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
        $this->_redirect('*/*/');

        return;
      
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }

        } else {
            $this->_redirect('*/*/');
        }
    }
}

?>