<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\ProcessorInterface.
 */

namespace Drupal\migrate_mini\Plugin;

use Drupal\migrate_mini\Row;

interface ProcessorInterface {

  public function getInitialValue(Row $row);

  public function transform($value, Row $row, MigrationInterface $migration);

}
