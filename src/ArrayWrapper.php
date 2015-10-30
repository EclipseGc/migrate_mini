<?php

/**
 * @file
 * Contains \Drupal\migrate_mini\ArrayWrapper.
 */

namespace Drupal\migrate_mini;

use Drupal\Component\Utility\NestedArray;

class ArrayWrapper {

  protected $data = [];

  public function __construct(array $data = []) {
    $this->data = $data;
  }

  protected function toKey($property) {
    return is_array($property) ? $property : explode('.', $property);
  }

  public function has($property) {
    return NestedArray::keyExists($this->data, $this->toKey($property));
  }

  public function get($property) {
    return NestedArray::getValue($this->data, $this->toKey($property));
  }

  public function set($property, $value) {
    NestedArray::setValue($this->data, $this->toKey($property), $value);
    return $this;
  }

  public function clear($property) {
    NestedArray::unsetValue($this->data, $this->toKey($property));
    return $this;
  }

}
