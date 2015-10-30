<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\Annotation\Migration.
 */

namespace Drupal\migrate_mini\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * @Annotation
 */
class Migration extends Plugin {

  public $id;

  public $label;

  public $description;

  public $tags = [];

  public $requirements = [];

  public $optional_dependencies = [];

}
