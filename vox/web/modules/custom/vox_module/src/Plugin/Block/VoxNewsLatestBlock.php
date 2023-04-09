<?php

namespace Drupal\vox_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * Provides a 'VoxNewsLatestBlock' block.
 *
 * @Block(
 *   id = "vox_news_latest_block",
 *   admin_label = @Translation("Vox News Latest Block")
 * )
 */
class VoxNewsLatestBlock extends BlockBase {

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
    $query->condition('type', 'news');
    $query->sort('created' , 'DESC');
    $query->range(0, 1);
    $entity_id = $query->execute();
    $nodes = Node::loadMultiple($entity_id);

    $renderable = [
      '#theme'  => 'vox_news_latest',
      '#data'  => $nodes,
    ];

    return $renderable;
  }

}
