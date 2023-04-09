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
    $query = \Drupal::entityQuery('node');
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
