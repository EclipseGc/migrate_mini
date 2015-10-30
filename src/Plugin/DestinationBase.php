<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\DestinationBase.
 */

namespace Drupal\migrate_mini\Plugin;

use Drupal\Component\Plugin\PluginBase;

abstract class DestinationBase extends PluginBase implements DestinationInterface {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return $this->pluginDefinition['key'];
  }

}
