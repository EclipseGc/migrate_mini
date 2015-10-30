<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Plugin\MigrationBase.
 */

namespace Drupal\migrate_mini\Plugin;

use Drupal\Component\Plugin\LazyPluginCollection;
use Drupal\Component\Plugin\PluginBase;
use Drupal\migrate_mini\Exception\SkipPropertyException;
use Drupal\migrate_mini\Row;

abstract class MigrationBase extends PluginBase implements MigrationInterface {

  /**
   * @var SourceInterface
   */
  protected $source;

  /**
   * @var LazyPluginCollection[]
   */
  protected $process = [];

  /**
   * @var DestinationInterface
   */
  protected $destination;

  /**
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $sourceManager;

  /**
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $destinationManager;

  /**
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  protected $log;

  /**
   * {@inheritdoc}
   */
  public function getSource() {
    if (empty($this->source)) {
      if (empty($this->configuration['source'])) {
        throw new \Exception('No source plugin is configured.');
      }
      $plugin_id = $this->configuration['source']['plugin'];
      unset($this->configuration['source']['plugin']);
      $this->source = $this->sourceManager()
        ->createInstance($plugin_id, $this->configuration['source']);
    }
    return $this->source;
  }

  /**
   * {@inheritdoc}
   */
  public function getProcessingPipeline($property = NULL) {
    if ($property) {
      if ($this->process[$property]) {
        return $this->process[$property];
      }
      else {
        throw new \InvalidArgumentException('No processing pipeline defined for ' . $property);
      }
    }
    else {
      return $this->process;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getDestination() {
    if (empty($this->destination)) {
      if (empty($this->configuration['destination'])) {
        throw new \Exception('No destination plugin is configured.');
      }
      $plugin_id = $this->configuration['destination']['plugin'];
      unset($this->configuration['destination']['plugin']);
      $this->destination = $this->destinationManager()
        ->createInstance($plugin_id, $this->configuration['destination']);
    }
    return $this->destination;
  }

  protected function processRow(Row $row) {
    foreach ($this->getProcessingPipeline() as $property => $plugins) {
      try {
        $row->destination()->set($property, $this->processProperty($row, $plugins));
      }
      catch (SkipPropertyException $e) {
        $this->log()->error($e->getMessage());
      }
    }
  }

  protected function processProperty(Row $row, LazyPluginCollection $plugins) {
    $value = NULL;
    $count = 0;
    /** @var ProcessorInterface $plugin */
    foreach ($plugins as $plugin) {
      if ($count++ == 0) {
        $value = $plugin->getInitialValue($row);
      }
      $value = $plugin->transform($value, $row, $this);
    }
    return $value;
  }

  protected function sourceManager() {
    return $this->sourceManager ?: \Drupal::service('plugin.manager.migrate.source');
  }

  protected function destinationManager() {
    return $this->destinationManager ?: \Drupal::service('plugin.manager.migrate.destination');
  }

  protected function database() {
    return $this->database ?: \Drupal::database();
  }

  protected function log() {
    return $this->log ?: \Drupal::logger('migration.' . $this->getPluginId());
  }

}
