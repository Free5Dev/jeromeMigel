<?php 

namespace Drupal\demo\Form;

use Drupal\Core\Form\ConfigFormBase; 
use Drupal\Core\Form\FormStateInterface;

class DemoConfigForm extends ConfigFormBase{

    public function getFormId(){

        return 'config_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state){

        $config = $this->config('demo.config_form');

        $form['store_name'] = array (
            '#type' => 'textfield',
            '#title' => $this->t('Store name'),
            '#default_value' => $config->get('store_name')
        );
        $form['opening_time'] = array(
            '#type' => 'textarea', 
            '#title' => $this->t('Opening time'),
            '#default_value' => $config->get('opening_time'),
        );
        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state){

        parent::buildForm($form, $form_state);

        $config = $this->config('demo.config_form');
        $config->set('store_name', $form_state->getValue('store_name'))
                ->set('opening_time', $form_state->getValue('opening_time'));

        $config->save();
    }

    protected function getEditableConfigNames(){
        return array(
            'demo.config_form'
        );
    }
}