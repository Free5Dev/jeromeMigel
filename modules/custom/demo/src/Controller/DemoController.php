<?php 

namespace Drupal\demo\Controller;

use \Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class DemoController extends \Drupal\Core\Controller\ControllerBase{

    public function description(){

        return $build = array(
            '#type' => 'markup',
            '#markup' => t('Hello world')
        );
    }
    
    public function requests(){
        // recuperation des informations de la bdd pour les noeuds
        $query = \Drupal::entityQuery('node');
        $nids = $query->execute();
        // recuperation des informations de la bdd pour les users
        $query = \Drupal::entityQuery('user');
        $uids = $query->execute();
        // recuperation des informations de la bdd pour les comment
        $query = \Drupal::entityQuery('comment');
        $cids = $query->execute();
        // les filtered sur les noeuds 
        $query = \Drupal::entityQuery('node')
                ->condition('type', 'horloge');
        $filtered_nids = $query->execute();
        // 
        $markup = 'Node ids: '.implode(',', $nids);
        $markup .= '<br/> User ids: '.implode(',', $uids);
        $markup .= '<br/> Comment ids '.implode(',', $cids);
        $markup .= '<br/> Comment ids '.implode(',', $filtered_nids);
        // recuperation des informations de noeuds
        $node = Node::load(reset($filtered_nids));
        $markup .= '<br/></br/>';
        $markup .= 'Corps Filtered node ids:'. $node->body->value;
        // enresistrer les informations dans la bdd
        $node->set('title', $node->title->value. '*');
        $node->save();
        $markup .= '<br/>';
        $markup .= 'Titre du premier noeud : '.$node->title->value;
        // pour les noeuds multiples
        // $nodes = Node::loadMultiple($filtered_nids);
        // $markup .= '<br/>';
        // foreach($nodes as $node){
        //     $markup .= '<br/>';
        //     $markup .= 'Date de fabrication (nid:'.  $node->nid->value.'): '.$node->field_date_de_fabrication->value;
        // }
        // $result = db_query('SELECT field_image_alt'
        // .'FROM {node__field_image} '
        // .'WHERE entity_id = :nid', array(':nid' => 5));
        // foreach($result as $record){
        //     $markup .= '<br/><br/>Texte alternatif: '.$record->field_image_alt;
        // }
        dsm($nids);

        $build = array(
            '#type' => 'markup',
            '#markup' => $markup,
        );
        return $build;
    }
}