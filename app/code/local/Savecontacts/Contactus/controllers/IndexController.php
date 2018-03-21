<?php
require_once 'Mage/Contacts/controllers/IndexController.php';
class Savecontacts_Contactus_IndexController extends Mage_Contacts_IndexController
{
  public function postAction()
  {
     $post = $this->getRequest()->getPost();
     

     /* code to save query , you can write our insert query here*/
     if ($post) {

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

      if(isset($post['telephone'])){
        $tele = trim($post['telephone']);
      } else {
        $tele = '';
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


      $model = Mage::getModel('contacts/contacts');
      $model->setGuestName(trim($post['name']));
      $model->setGuestEmail(trim($post['email']));
      $model->setGuestTelephone($tele);
      $model->setGuestCiudad($ciudad);
      $model->setGuestComments(trim($post['comment']));

      $model->save();

    }
  }
}

?>