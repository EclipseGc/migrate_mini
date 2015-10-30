<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\SourceBase.
 */

namespace Drupal\migrate_mini\Plugin;

use Drupal\Component\Plugin\PluginBase;

abstract class SourceBase extends PluginBase implements SourceInterface {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return $this->pluginDefinition['key'];
  }

}
