<?php

namespace Drupal\taller_1\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taller_1\Employee\EmployeeCreator;
use Drupal\taller_1\Employee\FailCreationException;
use Drupal\taller_1\Form\Validators\Validator;
use Drupal\taller_1\Provider\CityProvider;

/**
 * Form controller for the employee entity edit forms.
 */
class EmployeeForm extends FormBase
{

  public function getFormId()
  {
    return 'pruebita';
  }


  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $trigger = $form_state->getTriggeringElement();

    $isAjax ??= $trigger;

    $form['field_name'] = [
      '#type' => 'textfield',
      '#title' => t('Nombre de la persona'),
      '#maxlength' => 145,
      '#required' => TRUE,
      '#suffix' => '</div>',
    ];

    $form['field_age'] = [
      '#type' => 'number',
      '#title' => 'My age',
      '#required' => true,
      '#maxlength' => 145,
      '#maxlength' => 3,
      '#minlength' => [5],
    ];

    $form['field_genre'] = [
      '#type' => 'select',
      '#title' => t('Genero'),
      '#empty_option' => t('Seleccione opción'),
      '#empty_value' => '',
      '#options' => [
        'male' => 'Femenino',
        'masculine' => 'Masculino',
        'other' => 'Otro',
      ],
      '#required' => TRUE,
    ];

    $states = [
      '1' => $this->t('Cundinamarca'),
      '2' => $this->t('Boyaca'),
    ];

    $form['field_state'] = [
      '#type' => 'select',
      '#id' => 'fieldState',
      '#title' => t('Estado'),
      '#empty_value' => '',
      '#options' => array_combine($states, $states),
      '#maxlength' => 145,
      '#required' => TRUE,
      '#ajax' => [
        'callback' => [$this, 'ajaxGetCities'],
        'wrapper' => 'content',
        'event' => 'change',
      ],
    ];

    $form['field_city'] = [
      '#validated' => true,
      '#type' => 'select',
      '#title' => t('Ciudad'),
      '#id' => 'city',
//      '#disabled' => !$isAjax,
      '#prefix' => '<div class="content" id="content">',
      '#suffix' => '</div>',
    ];

    $form['enterprise'] = [
      '#type' => 'details',
      '#title' => $this->t('Informacion de la compañia'),
      '#open' => TRUE,
    ];

    $enterprise = [
      $this->t('Google'),
      $this->t('Bits'),
      $this->t('Microsoft'),
    ];

    $form['enterprise']['field_company'] = [
      '#type' => 'select',
      '#title' => $this->t('Seleccione una compañia'),
      '#empty_value' => '',
      '#empty_option' => 'Please select an option.',
      '#options' => array_combine($enterprise, $enterprise),
    ];

    $form['enterprise']['field_time_worked'] = [
      '#type' => 'number',
      '#title' => $this->t('Tiempo laborado'),
      '#minlength' => [5],
    ];

    $form['enterprise']['field_salary'] = [
      '#type' => 'number',
      '#title' => $this->t('Salario'),
      '#maxlength' => 64,
      '#placeholder' => $this->t('$00000'),
      '#minlength' => [5],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;

  }

  public function ajaxGetCities(array &$form, FormStateInterface $form_state): AjaxResponse
  {

    $response = new AjaxResponse();

    if ($state = $form_state->getValue('field_state')) {
      $selectedText = $form['field_state']['#options'][$state];
      $form['field_city']['#options'] = self::getCities($selectedText);
      $form['field_city']['#disabled'] = false;
    }

    $response->addCommand(new ReplaceCommand('#content',
      $form['field_city']));

    return $response;

  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {
      /** @var Validator $validator */
    $validator = \Drupal::service('taller_1.validator');

    if ($validator->isInvalidNumber($form_state->getValue('field_age'))) {
      $form_state->setErrorByName('field_age', 'El campo edad no puede tener numeros negativos.');
    }

    parent::validateForm($form, $form_state);

  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {

    /** @var EmployeeCreator $creator */
    $creator = \Drupal::service('taller_1.creator');

    $fields = $form_state->getValues();

    try {

       $creator->fromArray($fields);
      \Drupal::messenger()->addMessage('El empleado se ha guardado con exito!');

    } catch (FailCreationException|EntityStorageException $ex) {
      \Drupal::messenger()->addError('Ah ocurrido un error por favor verfique los datos. '. $ex->getMessage());
    }

  }


  private static function getCities(string $findState): array
  {
    /** @var CityProvider $city_provider */
    $city_provider = \Drupal::service('taller_1.city_provider');
    return $city_provider->getByState($findState);

  }


}
