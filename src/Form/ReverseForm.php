<?php
/**
 * @file
 * This is the basic reversal form.
 * Contains \Drupal\gs\Form\ReverseForm.
 */
 
 //define namespace, similar to java packages
 namespace Drupal\gs\Form;
 
 //use other namespaces, similar to import statements in Java
 //FormBase as the superclass for basic forms
use Drupal\Core\Form\FormBase;
//FormStateInterface seems not really necessary as it is implemented by FormBase.
// But it is necessary because FormBase is abstract as it hasn't implemented getFormId yet > delegated to subclass
use Drupal\Core\Form\FormStateInterface;

class ReverseForm extends FormBase{
 public function getFormID() {
    return 'gs_revform';
 }
 //override buildForm method
 //same as in Drupal 7
 public function buildForm(array $form, FormStateInterface $form_state) { 
  $form['inputtext'] = array(
    '#type' => 'textfield',
    '#title' => t('Input Text'),
    '#description' => t('Write here the text you want reversed. Go nuts!'),
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Reverse'),
  );
  //return the form
  return $form;
 }
 public function validateForm(array &$form, FormStateInterface $form_state){
   //returns noting
   $text = $form_state->getValue('inputtext');
   if(strlen($text)<6){
    //it is to short
    $form_state->setErrorByName('inputtext',t('too short'));
   }
 }
 public function submitForm(array &$form, FormStateInterface $form_state){
  $inputtext = $form_state->getValue('inputtext');
  $reverse = strrev($inputtext);
  drupal_set_message(t('The reverse of %inputtext is: %reverse',
    array('%reverse'=>$reverse,'%inputtext'=>$inputtext)));
 }
}

