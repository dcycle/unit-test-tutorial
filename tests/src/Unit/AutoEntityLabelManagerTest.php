<?php

namespace Drupal\Tests\auto_entitylabel\Unit;

use Drupal\auto_entitylabel\AutoEntityLabelManager;
use PHPUnit\Framework\TestCase;

/**
 * Test AutoEntityLabelManager.
 *
 * @group unit_test_tutorial
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
   * Get a public version of a protected method.
   *
   * See https://stackoverflow.com/a/2798203/1207752.
   */
  protected static function getMethodAsPublic($name) {
    $class = new \ReflectionClass(AutoEntityLabelManager::class);
    $method = $class->getMethod($name);
    $method->setAccessible(true);
    return $method;
  }

  /**
   * Get a public version of a protected method.
   */
  protected static function getPropertyAsPublic($name) {
    $class = new \ReflectionClass(AutoEntityLabelManager::class);
    $property = $class->getProperty($name);
    $property->setAccessible(true);
    return $property;
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

    $public_config_property = self::getPropertyAsPublic('config');
    $public_config_property->setValue($object, new class {
      public function get(string $x) {
        return 'hello';
      }
    });

    $public_getconfig_method = self::getMethodAsPublic('getConfig');

    $expected = 'hello';
    $output = $public_getconfig_method->invokeArgs($object, ['whatever']);

    if ($output != $expected) {
      print_r([
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output == $expected, 'getConfig() works as expected if the config property is set.');
  }

}
