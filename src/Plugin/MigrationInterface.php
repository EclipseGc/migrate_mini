<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\MigrationInterface.
 */

namespace Drupal\migrate_mini\Plugin;

interface MigrationInterface {

  /**
   * Returns the fully configured source plugin.
   *
   * @return SourceInterface
   */
  public function getSource();

  public function getSourceId(array $destination_id);

  public function getProcessingPipeline($property = NULL);

  /**
   * Returns the fully configured destination plugin.
   *
   * @return DestinationInterface
   */
  public function getDestination();

  public function getDestinationId(array $source_id);

  public function import();

  public function rollback();

}
