<?php

namespace Drupal\auto_entitylabel;

use Drupal\auto_entitylabel\AutoEntityLabelManager;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Class for Auto Entity Label module-wide methods.
 */
class AutoEntityLabelSingleton {

  /**
   * @var self[]
   */
  private static $instance;

  /**
   * Returns instance, creating one if it does not exist.
   *
   * @return $this
   */
  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new AutoEntityLabelSingleton();
    }
    return self::$instance;
  }

  /**
   * Prepares the label replacement in the entity form.
   *
   * @param array $form
   *   Form array.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity
   *   The entity which title will be replaced.
   */
  function prepareEntityForm(&$form, ContentEntityInterface $entity) {
    if (empty($form['#auto_entitylabel_processed'])) {
      $decorator = \Drupal::service('auto_entitylabel.entity_decorator');
      /** @var \Drupal\auto_entitylabel\AutoEntityLabelManager $entity */
      $entity = $decorator->decorate($entity);
      $label = $entity->getLabelName();
      $widget = &$form[$label]['widget'][0];

      switch ($entity->getStatus()) {
        case AutoEntityLabelManager::ENABLED:
          // Hide the label field. It will be automatically generated in
          // hook_entity_presave().
          $widget['value']['#type'] = 'hidden';
          $widget['value']['#required'] = FALSE;
          $widget['value']['#default_value'] = $this->widgetDefaultValue($widget);
          break;

        case AutoEntityLabelManager::OPTIONAL:
          // Allow label field to be empty. It will be automatically generated
          // in hook_entity_presave().
          $widget['value']['#required'] = FALSE;
          break;

        case AutoEntityLabelManager::PREFILLED:
          if (empty($widget['value']['#default_value'])) {
            $widget['value']['#default_value'] = $entity->setLabel();
          }
          break;
      }

      $form['#auto_entitylabel_processed'] = TRUE;
    }
  }

  /**
   * Given a widget array, return its default value, or '%AutoEntityLabel%'.
   *
   * @param array $widget
   *   A widget array which must contain a 'value' key.
   *
   * @return string
   *   $widget['value']['#default_value'] if possible, otherwise
   *   '%AutoEntityLabel%'.
   */
  public function widgetDefaultValue(array $widget) {
    return empty($widget['value']['#default_value']) ? '%AutoEntityLabel%' : $widget['value']['#default_value'];
  }

}
