<?php

namespace Drupal\auto_entitylabel\Tests;

use Drupal\auto_entitylabel\AutoEntityLabelSingleton;
use PHPUnit\Framework\TestCase;

/**
 * Test AutoEntityLabelSingleton.
 *
 * @group myproject
 */
class AutoEntityLabelSingletonTest extends TestCase {

  /**
   * Test for widgetDefaultValue().
   *
   * @param string $message
   *   The test message.
   * @param array $input
   *   The input.
   * @param string $expected
   *   The expected result.
   *
   * @cover ::widgetDefaultValue
   * @dataProvider providerWidgetDefaultValue
   */
  public function testWidgetDefaultValue(string $message, array $input, string $expected) {
    $output = AutoEntityLabelSingleton::getInstance()->widgetDefaultValue($input);

    if ($output != $expected) {
      print_r([
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output == $expected, $message);
  }

  /**
   * Provider for testWidgetDefaultValue().
   */
  public function providerWidgetDefaultValue() {
    return [
      [
        'message' => 'No default value',
        'input' => [
          'value' => [
            'no default value',
          ],
        ],
        'expected' => '%AutoEntityLabel%',
      ],
      [
        'message' => 'Default value exists',
        'input' => [
          'value' => [
            '#default_value' => 'Default value exists',
          ],
        ],
        'expected' => 'Default value exists',
      ],
    ];
  }

}
