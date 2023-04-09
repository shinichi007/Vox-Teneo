<?php

namespace Drupal\vox_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'VoxBannerBlock' block.
 *
 * @Block(
 *   id = "vox_banner_block",
 *   admin_label = @Translation("Vox Banner Block")
 * )
 */
class VoxBannerBlock extends BlockBase {

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
    $config = \Drupal::config('vox_module.settings');
    $renderable = [
      '#theme' => 'vox_banner',
      '#title' => $config->get('title'),
      '#subtitle' => $config->get('subtitle'),
      '#banner' => $config->get('banner'),
      '#search' => $config->get('search'),
    ];

    return $renderable;
  }

}
