<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Annotation\MigrateSource.
 */

namespace Drupal\migrate_mini\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * @Annotation
 */
class MigrateSource extends Plugin {

  public $id;

  public $requirements;

  public $key = [];

}
