<?php

namespace Drupal\vox_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * Provides a 'VoxEventLatestBlock' block.
 *
 * @Block(
 *   id = "vox_event_latest_block",
 *   admin_label = @Translation("Vox Event Latest Block")
 * )
 */
class VoxEventLatestBlock extends BlockBase {

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
      '#theme'  => 'vox_event_latest',
      '#data'  => $nodes,
    ];

    return $renderable;
  }

}
