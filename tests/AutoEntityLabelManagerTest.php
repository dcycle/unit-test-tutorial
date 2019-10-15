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
   * @param string $message
   *   The test message.
   * @param string $input
   *   Input string.
   * @param bool $expected
   *   Expected output.
   *
   * @cover ::auto_entitylabel_entity_label_visible
   * @dataProvider providerAuto_entitylabel_entity_label_visible
   */
  public function testAuto_entitylabel_entity_label_visible(string $message, string $input, bool $expected) {
    // This is a static pure method, so we don't have to instantiate
    // AutoEntityLabelManager to call it. Good thing it's a pure method though
    // because static methods don't allow us to use mocking.
    $output = AutoEntityLabelManager::auto_entitylabel_entity_label_visible($input);

    if ($output != $expected) {
      print_r([
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output === $expected, $message);
  }

  /**
   * Provider for testAuto_entitylabel_entity_label_visible().
   */
  public function providerAuto_entitylabel_entity_label_visible() {
    return [
      [
        'message' => 'Label "whatever" is visible',
        'input' => 'whatever',
        'expected' => TRUE,
      ],
      [
        'message' => 'Label "profile2" is invisible',
        'input' => 'profile2',
        'expected' => FALSE,
      ],
      [
        'message' => 'Empty label is visible',
        'input' => '',
        'expected' => TRUE,
      ],
    ];
  }

  /**
   * Test for getConfig().
   *
   * @cover ::getConfig
   */
  public function testGetConfig() {
    $object = $this->getMockBuilder(AutoEntityLabelManager::class)
      // NULL = no methods are mocked; otherwise list the methods here.
      ->setMethods(NULL)
      ->disableOriginalConstructor()
      ->getMock();

    $object->config = new class {
      public function get(string $x) {
        return 'hello';
      }
    };

    $expected = 'hello';
    $output = $object->getConfig('whatever');

    if ($output != $expected) {
      print_r([
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output == $expected, 'getConfig() works as expected if the config property is set.');
  }

}
