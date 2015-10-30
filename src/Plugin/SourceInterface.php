<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\SourceInterface.
 */

namespace Drupal\migrate_mini\Plugin;

interface SourceInterface extends \IteratorAggregate, \Countable {

  public function getKey();

}
