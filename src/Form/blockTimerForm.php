<?php

namespace Drupal\block_timer\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Block Timer settings for this site.
 */
class blockTimerForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'block_timer_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['block_timer.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('block_timer.settings');

    $form['block_timer_enabled'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#default_value' => $config->get('block_timer_enabled'),
    );

    $form['block_timer_timing_good'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Good Process Time (msec)'),
      '#default_value' => $config->get('block_timer_timing_good'),
      '#size' => 3,
      '#weight' => 2,
    );

    $form['block_timer_timing_bad'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Bad Process Time (msec)'),
      '#default_value' => $config->get('block_timer_timing_bad'),
      '#size' => 3,
      '#weight' => 4,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('config.factory')->getEditable('block_timer.settings')
      ->set('block_timer_enabled', $form_state->getValue('block_timer_enabled'))
      ->set('block_timer_timing_good', $form_state->getValue('block_timer_timing_good'))
      ->set('block_timer_timing_bad', $form_state->getValue('block_timer_timing_bad'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
