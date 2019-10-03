<?php

namespace Drupal\auto_entitylabel\Tests;

use Drupal\auto_entitylabel\AutoEntityLabelManager;
use PHPUnit\Framework\TestCase;

/**
 * Test AutoEntityLabelManager.
 *
 * @group myproject
 */
class AutoEntityLabelManagerTest extends TestCase {

  /**
   * Test for auto_entitylabel_entity_label_visible().
   *
   * @cover ::auto_entitylabel_entity_label_visible
   */
  public function testAuto_entitylabel_entity_label_visible() {
    $this->assertTrue(AutoEntityLabelManager::auto_entitylabel_entity_label_visible('whatever') === TRUE, 'Label "whatever" is visible.');
  }

}
