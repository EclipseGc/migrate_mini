<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\ProcessorBase.
 */

namespace Drupal\migrate_mini\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\migrate_mini\Row;

abstract class ProcessorBase extends PluginBase implements ProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function getInitialValue(Row $row) {
    $value = [];
    foreach ((array) $this->configuration['source'] as $key) {
      $value[] = $row->source()->get($key);
    }
    return $value;
  }

}
