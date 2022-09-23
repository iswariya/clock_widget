<?php

namespace Drupal\clock_widget\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure clock widget settings.
 */
class ClockWidgetSettingsForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'clock_widget.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'clock_wdget_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $timezones = [
      'America/Chicago' => $this->t('America/Chicago'),
      'America/New_York' => $this->t('America/New_York'),
      'Asia/Tokyo' => $this->t('Asia/Tokyo'),
      'Asia/Dubai' => $this->t('Asia/Dubai'),
      'Asia/Kolkata' => $this->t('Asia/Kolkata'),
      'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
      'Europe/Oslo' => $this->t('Europe/Oslo'),
      'Europe/London' => $this->t('Europe/London'),
    ];

    $form['clock_widget_country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#size' => 60,
      '#maxlength' => 128,
      '#default_value' => $config->get('clock_widget_country'),
    ];

    $form['clock_widget_city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#size' => 60,
      '#maxlength' => 128,
      '#default_value' => $config->get('clock_widget_city'),
    ];

    $form['clock_widget_timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#default_value' => $config->get('clock_widget_timezone'),
      '#options' => $timezones,
      '#empty_option' => $this->t('-- Select Timezone --'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('clock_widget_country', $form_state->getValue('clock_widget_country'))
      ->set('clock_widget_city', $form_state->getValue('clock_widget_city'))
      ->set('clock_widget_timezone', $form_state->getValue('clock_widget_timezone'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}