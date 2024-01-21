<?php

namespace Drupal\nm_salutation\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form to show a salutation to the end user.
 */
class SalutationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'salutation_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    // Salutation settings.
    $config = $this->config('nm_salutation.settings');

    // Morning salutation field.
    $form['morning_salutation'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Morning salutation:'),
      '#default_value' => $config->get('morning_salutation'),
      '#description' => $this->t('Provide a salutation text for the morning.'),
    ];

    // Afternoon salutation field.
    $form['afternoon_salutation'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Afternoon salutation:'),
      '#default_value' => $config->get('afternoon_salutation'),
      '#description' => $this->t('Provide a salutation text for the afternoon.'),
    ];

    // Evening salutation field.
    $form['evening_salutation'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Evening salutation:'),
      '#default_value' => $config->get('evening_salutation'),
      '#description' => $this->t('Provide a salutation text for the evening.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('nm_salutation.settings');
    $config->set('morning_salutation', $form_state->getValue('morning_salutation'));
    $config->set('afternoon_salutation', $form_state->getValue('afternoon_salutation'));
    $config->set('evening_salutation', $form_state->getValue('evening_salutation'));
    $config->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'nm_salutation.settings',
    ];
  }

}
