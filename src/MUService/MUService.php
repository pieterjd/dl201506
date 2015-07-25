<?php

namespace Drupal\dl201506\MUService;

use Drupal\dl201506\MUService\MUServiceInterface;
use Drupal\dl201506\meetup\Meetup;
class MUService implements MUServiceInterface{
  private $meetup;
  public function __construct(){
    $this->meetup = new Meetup(array(
      'key' =>'insert your API Key here!',
      )
    ); 
  }
  public function getEvents(){
  
  
    $response = $this->meetup->getEvents(array(
        'group_urlname' => 'DUG-BE',
      )      
    );
    $result = array();
   
    foreach ($response->results as $event) {
     
      $result[] = array(
        'name' => $event->name,
        'url' => $event->event_url,
      );
    }
    return $result;
  }



}