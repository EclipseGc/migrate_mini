<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Row.
 */

namespace Drupal\migrate_mini;

use Drupal\migrate_mini\Plugin\MigrationInterface;

class Row {

  /**
   * @var MigrationInterface
   */
  protected $migration;

  /**
   * @var ArrayWrapper
   */
  protected $source;

  /**
   * @var ArrayWrapper
   */
  protected $destination;

  public function __construct(MigrationInterface $migration, array $source = [], array $destination = []) {
    $this->migration = $migration;
    $this->source = new ArrayWrapper($source);
    $this->destination = new ArrayWrapper($destination);
  }

  public function source() {
    return $this->source;
  }

  public function getSourceId() {
    $id = [];
    foreach (array_keys($this->migration->getSource()->getKey()) as $key) {
      $id[$key] = $this->source()->get($key);
    }
    return $id;
  }

  public function destination() {
    return $this->destination;
  }

  public function getDestinationId() {
    $id = [];
    foreach (array_keys($this->migration->getDestination()->getKey()) as $key) {
      $id[$key] = $this->destination()->get($key);
    }
    return $id;
  }

}
