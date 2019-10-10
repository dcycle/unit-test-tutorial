<?php

/**
 * @file
 *
 * PHPUnit knows nothing about Drupal. Declare required classes here.
 */

namespace Drupal\Core\StringTranslation {
  trait StringTranslationTrait {}
}

namespace Drupal\Core\DependencyInjection {
  interface ContainerInjectionInterface {}
}

namespace Drupal\Core\Validation\Plugin\Validation\Constraint {
  class NotNullConstraintValidator {}
}

namespace Drupal\Core\Field {
  class FieldItemList {}
}
