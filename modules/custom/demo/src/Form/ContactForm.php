<?php

namespace Drupal\demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an example form.
 */
class ContactForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = array();
        $form['contact_title']  = array(
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#maxlength' => 255,
            '#default_value' => '',
            '#required' => FALSE
        );
        $form['contact_email'] = array(
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#default_value' => '',
            '#required' => TRUE
        );
        $form['contact_message' ] = array (
            '#type' => 'textarea',
            '#title' => $this->t('Your message'),
            '#description' => $this->t('Please add "Drupal" in this message'),
            '#default_value' => '',
            '#required' => TRUE
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Submit')
        );
        return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $msg_value = $form_state->getValue('contact_message');
    if(!strpos($msg_value, 'Drupal')){
        $form_state->setErrorByName('contact_message', $this->t('Please add "Drupal" in this message '));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $email_value = $form_state->getValue('contact_email');
    $msg = "L'email a bien été envoyé à : ".$email_value;
    drupal_set_message($msg);
  }

}