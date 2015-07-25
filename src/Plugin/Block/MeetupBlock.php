<?php
/**
 * @file
 * This is the Meetup Block.
 * 
 */
 
 //define my block namespace
 namespace Drupal\dl201506\Plugin\Block;
 
 //import BlockBase superclass - don't forget the Core part!
 use Drupal\Core\Block\BlockBase;
 
 use Drupal\dl201506\MUService\MUServiceInterface;
 
 //don't forget to import ContainerInterface!!
 use  Drupal\Core\Plugin\ContainerFactoryPluginInterface;
 use Symfony\Component\DependencyInjection\ContainerInterface;
 
 //import annotation stuff
 use Drupal\block\Annotation\Block;
 use Drupal\Core\Annotation\Translation;


 
 //tell Drupal there is a new block on the ... block :) using annotations
 //id is the machinename of the block
 //admin_label the human readable name used in the interface
 /**
 * @Block(
 * id = "meetup_block",
 * admin_label = @Translation("Meetup Block"),
 *)
 */
 class MeetUpBlock extends BlockBase implements ContainerFactoryPluginInterface{
 
  /**
  * The meetup service.
  *
  * @var Drupal\dl201506\MUService\MUService
  */
  private $meetup;

 
  public function __construct(array $configuration,$plugin_id,$plugin_definition,MUServiceInterface $meetup){
    parent::__construct($configuration,$plugin_id,$plugin_definition);
    $this->meetup = $meetup;
  }
    
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration,$plugin_id,$plugin_definition,$container->get('dl201506_muservice'));
  }
 
 
  //only implement build function returning render array
  public function build(){
    $render = array();
    if($this->meetup == NULL){
      $this->meetup = \Drupal::service('dl201506_muservice');
    }
    else{
      $render[] = array(
        '#type' => 'markup',
        '#markup' => 'meetup service not null, yeaaah',
      );
    }
    $results = $this->meetup->getEvents();
    $links = array();
    $events = array();
    foreach($results as $result){
      $events[] = $result['name'];
      $links [] = array(
        '#title' => $result['name'],
        '#url' => $result['url'],
      );
    }
    
    
    $render[] = array(
      '#theme' => 'item_list',
      '#items' => $events,
    );
    /*
    $render[] = array(
      '#theme' => 'links',
      '#links' => $links,
    );
    */
    /* debug stuff
    $render = array(
      '#type' => 'markup',
      '#markup' => print_r(\Drupal::service('dl201506_muservice')->getEvents(),TRUE),
    
    );
    */
    return $render;
  }
  
}
 
 