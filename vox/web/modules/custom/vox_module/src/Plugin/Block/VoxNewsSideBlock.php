<?php

namespace Drupal\vox_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * Provides a 'VoxNewsSideBlock' block.
 *
 * @Block(
 *   id = "vox_news_side_block",
 *   admin_label = @Translation("Vox News Side Block")
 * )
 */
class VoxNewsSideBlock extends BlockBase {

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

    if($path[1] =='node') $query->condition('nid', $path[2], '<>');

    $query->condition('status', 1);
    $query->condition('type', 'news');
    $query->sort('created' , 'DESC');
    $query->range(0, 2);
    $entity_id = $query->execute();
    $nodes = Node::loadMultiple($entity_id);

    $renderable = [
      '#theme'  => 'vox_news_side',
      '#data'  => $nodes,
    ];

    return $renderable;
  }

}
