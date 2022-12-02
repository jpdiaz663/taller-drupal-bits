<?php

namespace Drupal\taller_1\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\taller_1\EmployeeInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the employee entity class.
 *
 * @ContentEntityType(
 *   id = "employee",
 *   label = @Translation("Employee"),
 *   label_collection = @Translation("Employees"),
 *   label_singular = @Translation("employee"),
 *   label_plural = @Translation("employees"),
 *   label_count = @PluralTranslation(
 *     singular = "@count employees",
 *     plural = "@count employees",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\taller_1\EmployeeListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\taller_1\Form\EmployeeForm",
 *       "edit" = "Drupal\taller_1\Form\EmployeeForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "employee",
 *   admin_permission = "administer employee",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "owner" = "uid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/employee",
 *     "add-form" = "/employee/add",
 *     "canonical" = "/employee/{employee}",
 *     "edit-form" = "/employee/{employee}/edit",
 *     "delete-form" = "/employee/{employee}/delete",
 *   },
 *   field_ui_base_route = "entity.employee.settings",
 * )
 */
class Employee extends ContentEntityBase implements EmployeeInterface {

  use EntityChangedTrait;
  use EntityOwnerTrait;

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);
    if (!$this->getOwnerId()) {
      // If no owner has been set explicitly, make the anonymous user the owner.
      $this->setOwnerId(0);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);
//
    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);
//
//
//    $fields['name'] = BaseFieldDefinition::create('string')
//      ->setLabel(t('Nombre'))
//      ->setRequired(TRUE)
//      ->setSetting('max_length', 255)
//      ->setDisplayOptions('form', [
//        'type' => 'string_textfield',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('view', [
//        'label' => 'hidden',
//        'type' => 'string',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
//    $fields['age'] = BaseFieldDefinition::create('integer')
//      ->setLabel(t('Edad'))
//      ->setRequired(TRUE)
//      ->setSetting('max_length', 255)
//      ->setDisplayOptions('form', [
//        'type' => 'string_textfield',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('view', [
//        'label' => 'hidden',
//        'type' => 'string',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
//    $fields['genre'] = BaseFieldDefinition::create('string')
//      ->setLabel(t('Genero'))
//      ->setRequired(TRUE)
//      ->setSetting('max_length', 255)
//      ->setDisplayOptions('form', [
//        'type' => 'string_textfield',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('view', [
//        'label' => 'hidden',
//        'type' => 'string',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
//    $fields['state'] = BaseFieldDefinition::create('string')
//      ->setLabel(t('Departamento'))
//      ->setRequired(TRUE)
//      ->setSetting('max_length', 255)
//      ->setDisplayOptions('form', [
//        'type' => 'string_textfield',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('view', [
//        'label' => 'hidden',
//        'type' => 'string',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
//    $fields['city'] = BaseFieldDefinition::create('string')
//      ->setLabel(t('Ciudad'))
//      ->setRequired(TRUE)
//      ->setSetting('max_length', 255)
//      ->setDisplayOptions('form', [
//        'type' => 'string_textfield',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('view', [
//        'label' => 'hidden',
//        'type' => 'string',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
//    //COMPANY EMPLOYEE DATA
//
//    $fields['company'] = BaseFieldDefinition::create('string')
//      ->setLabel(t('Compañia'))
//      ->setRequired(TRUE)
//      ->setSetting('max_length', 255)
//      ->setDisplayOptions('form', [
//        'type' => 'string_textfield',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('view', [
//        'label' => 'hidden',
//        'type' => 'string',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
//    $fields['date_worked'] = BaseFieldDefinition::create('datetime')
//      ->setLabel(t('Authored on'))
//      ->setDescription(t('The time that the employee was created.'))
//      ->setDisplayOptions('view', [
//        'label' => 'above',
//        'type' => 'timestamp',
//        'weight' => 20,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('form', [
//        'type' => 'datetime_timestamp',
//        'weight' => 20,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
//
//    $fields['salary'] = BaseFieldDefinition::create('integer')
//      ->setLabel(t('Salario'))
//      ->setRequired(TRUE)
//      ->setSetting('max_length', 255)
//      ->setDisplayOptions('form', [
//        'type' => 'string_textfield',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('form', TRUE)
//      ->setDisplayOptions('view', [
//        'label' => 'hidden',
//        'type' => 'string',
//        'weight' => -5,
//      ])
//      ->setDisplayConfigurable('view', TRUE);
//
//
    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Author'))
      ->setSetting('target_type', 'user')
      ->setDefaultValueCallback(static::class . '::getDefaultEntityOwner')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => 15,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => 15,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setDescription(t('The time that the employee was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the employee was last edited.'));

    return $fields;
  }


  public function setTimeWorked(int $months) {
    $this->set('field_time_worked', $months);
    return $this;
  }

}
