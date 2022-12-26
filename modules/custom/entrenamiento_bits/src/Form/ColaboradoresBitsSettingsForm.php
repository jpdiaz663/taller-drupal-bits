<?php

namespace Drupal\entrenamiento_bits\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for an entrenamiento bits entity type.
 */
class ColaboradoresBitsSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'colabs.settings';
  }

  protected function getEditableConfigNames() {
    return ['colabs.settings'];
  }


  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['settings'] = [
      '#markup' => $this->t('Settings form for an entrenamiento bits entity type.'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['container'] = [
      '#type' => 'details',
      '#title' => $this->t('Configuración Llave'),
      '#open' => TRUE,
      '#group' => 'base',
      '#weight' => 10,
    ];

    $form['container']['api_key'] = [
      '#type' => 'textfield',
      '#title' => t('clave de api de bits'),
      '#default_value' =>  $this->config('colabs.settings')->get('apy_key') ?? t('X000X0X00XX0'),
      '#required' => TRUE,
      '#size' => 70,
      '#maxlength' => 30,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('colabs.settings')
      ->set('api_key', $form_state->getValue('api_key'))
      ->save();

    $this->messenger()->addStatus($this->t('The configuration has been updated.'));
  }

}
