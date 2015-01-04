<?php
/**
 * @file
 * This is the QR Block.
 * 
 */
 
 //define my block namespace
 namespace Drupal\gs\Plugin\Block;
 
 //import BlockBase superclass - don't forget the Core part!
 use Drupal\Core\Block\BlockBase;
 
 //import user account
 use Drupal\Core\Session\AccountInterface;
 
 //import annotation stuff
 use Drupal\block\Annotation\Block;
 use Drupal\Core\Annotation\Translation;

 //for the configuration form
 use Drupal\Core\Form\FormStateInterface;
 //request informartion
// use Symfony\Component\HttpFoundation\Request;
 
 //tell Drupal there is a new block on the ... block :) using annotations
 //id is the machinename of the block
 //admin_label the human readable name used in the interface
 /**
 * @Block(
 * id = "qr_block",
 * admin_label = @Translation("QR Block"),
 *)
 */
 class QRBlock extends BlockBase{
  //only implement build function returning render array
  public function build(){
    $url = \Drupal::request()->getUri();
    $size = $this->configuration['size'];
    $block['image'] = array(
      '#theme' => 'image',
      '#uri' => "http://chart.googleapis.com/chart?chs=$size&cht=qr&chl=$url",
    );
    return $block;
  }
  //options for the block
  public function blockForm($form, FormStateInterface $form_state) {
   $form['size'] = array(
    '#type' => 'select',
    '#title' => t('Size'),
    '#options' => array(
      '100x100' => t('Small'),
      '150x150' => t('Medium'),
      '200x200' => t('Large'),
     ),
     '#default_value' => $this->configuration['size'],
     '#description' => t('The size of the QR code'),
   );
   return $form;
  }
  //process configuration form
  public function blockSubmit($form, FormStateInterface $form_state) {
    //store size in the configuration info of this block
    $this->configuration['size'] = $form_state->getValue('size'); 
  }
}
 
 