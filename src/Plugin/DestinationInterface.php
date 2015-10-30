<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\DestinationInterface.
 */

namespace Drupal\migrate_mini\Plugin;

use Drupal\migrate_mini\Row;

interface DestinationInterface {

  public function getKey();

  public function import(Row $row);

  public function rollback(Row $row);

}
