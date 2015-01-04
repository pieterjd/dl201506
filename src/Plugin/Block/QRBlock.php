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
    $block['image'] = array(
      '#theme' => 'image',
      '#uri' => "http://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=$url",
    );
    return $block;
  }
 }
 