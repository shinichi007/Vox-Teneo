<?php

namespace Drupal\vox_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * Provides a 'VoxEventSideBlock' block.
 *
 * @Block(
 *   id = "vox_event_side_block",
 *   admin_label = @Translation("Vox Event Side Block")
 * )
 */
class VoxEventSideBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['label_display' => FALSE];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $path = explode('/',\Drupal::request()->getpathInfo());
    $query = \Drupal::entityQuery('node');

    if($path[1] =='node') {
      $current_node = Node::load($path[2]);
      $category_id = $current_node->get('field_category')->target_id;
      $query->condition('nid', $path[2], '<>');
      $query->condition('field_category.target_id', $category_id, '=');
    }

    $query->condition('status', 1);
    $query->condition('type', 'event');
    $query->sort('created' , 'DESC');
    $query->range(0, 2);
    $entity_id = $query->execute();
    $nodes = Node::loadMultiple($entity_id);

    $renderable = [
      '#theme'  => 'vox_event_side',
      '#data'  => $nodes,
    ];

    return $renderable;
  }

}
