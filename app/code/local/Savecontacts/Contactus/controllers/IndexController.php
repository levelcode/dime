<?php
require_once 'Mage/Contacts/controllers/IndexController.php';
class Savecontacts_Contactus_IndexController extends Mage_Contacts_IndexController
{
  public function postAction()
  {
     $post = $this->getRequest()->getPost();
     

     /* code to save query , you can write our insert query here*/
     if ( $post ) {
        
        $model = Mage::getModel('contactus/contactus');	
  			$model->setData($post);
  			$model->save();
    }
  }
}

?>