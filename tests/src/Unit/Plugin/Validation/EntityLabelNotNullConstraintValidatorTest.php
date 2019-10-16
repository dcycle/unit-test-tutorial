<?php

namespace Drupal\Tests\auto_entitylabel\Unit\Plugin\Validation;

use Drupal\auto_entitylabel\Plugin\Validation\EntityLabelNotNullConstraintValidator;
use Drupal\Core\Field\FieldItemList;
use PHPUnit\Framework\TestCase;

/**
 * Test EntityLabelNotNullConstraintValidator.
 *
 * @group unit_test_tutorial
 */
class EntityLabelNotNullConstraintValidatorTest extends TestCase {

  /**
   * Test for manageTypedData().
   *
   * @param string $message
   *   The test message.
   * @param mixed $input
   *   The input, we will simulate that getTypedData() returns this.
   * @param bool $expected
   *   The expected result.
   *
   * @cover ::manageTypedData
   * @dataProvider providerManageTypedData
   */
  public function testManageTypedData(string $message, $input, bool $expected) {
    // Get a mock copy of EntityLabelNotNullConstraintValidator where
    // getTypedData() and manageValidTypedData() are mocked.
    $object = $this->getMockBuilder(EntityLabelNotNullConstraintValidator::class)
      ->setMethods([
        'getTypedData',
        'manageValidTypedData',
      ])
      ->disableOriginalConstructor()
      ->getMock();

    // We don't care how getTypedData() figures out what to return to
    // manageTypedData, but we do want to see how our function will react
    // to a variety of possibilities.
    $object->method('getTypedData')
      ->willReturn($input);
    // We will assume manageValidTypedData() is doing its job; that's not
    // what were are testing here. For our test, it will always return TRUE.
    $object->method('manageValidTypedData')
      ->willReturn(TRUE);

    $output = $object->manageTypedData($input);

    if ($output != $expected) {
      print_r([
        'output' => $output,
        'expected' => $expected,
      ]);
    }

    $this->assertTrue($output == $expected, $message);
  }

  /**
   * Provider for testManageTypedData().
   */
  public function providerManageTypedData() {
    return [
      [
        'message' => 'Typed data is not a FieldItemList',
        'input' => new \stdClass(),
        'expected' => FALSE,
      ],
    ];

    $field_item_list = $this->getMockBuilder(FieldItemList::class)
      ->setMethods([
        'isEmpty'
      ])
      ->disableOriginalConstructor()
      ->getMock();

    $field_item_list->method('isEmpty')
      ->willReturn(TRUE);

    return $return;

    $field_item_list->method('isEmpty')
      ->willReturn(FALSE);

    return $return + [
      [
        'message' => 'Typed data is an non-empty FieldItemList',
        'input' => $field_item_list,
        'expected' => FALSE,
      ],
    ];
  }

}
