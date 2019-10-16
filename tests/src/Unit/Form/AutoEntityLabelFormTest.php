<?php

namespace Drupal\Tests\auto_entitylabel\Unit\Form;

use Drupal\auto_entitylabel\Form\AutoEntityLabelForm;
use PHPUnit\Framework\TestCase;

/**
 * Test AutoEntityLabelForm.
 *
 * @group unit_test_tutorial
 */
class AutoEntityLabelFormTest extends TestCase {

  /**
   * Test for escapeCheckbox().
   *
   * @cover ::escapeCheckbox
   */
  public function testEscapeCheckbox() {
    $object = $this->getMockBuilder(AutoEntityLabelForm::class)
      // NULL = no methods are mocked; otherwise list the methods here.
      ->setMethods([
        't',
      ])
      ->disableOriginalConstructor()
      ->getMock();

    $object->method('t')
      ->will($this->returnCallback(function($string) {
        return $string . ' (translated)';
      }));

    $output = $object->escapeCheckbox(new class {
      public function get($string) {
        return 'whatever';
      }
    }, 'whatever');

    $expected = [
      '#type' => 'checkbox',
      '#title' => 'Remove special characters. (translated)',
      '#description' => 'Check this to remove all special characters. (translated)',
      '#default_value' => 'whatever',
      '#states' => 'whatever',
    ];

    if ($output != $expected) {
      print_r([
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output == $expected, 'escapeCheckbox() works as expected.');
  }

}
