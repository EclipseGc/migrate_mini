<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Annotation\MigrateDestination.
 */

namespace Drupal\migrate_mini\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * @Annotation
 */
class MigrateDestination extends Plugin {

  public $id;

  public $key = [];

}
