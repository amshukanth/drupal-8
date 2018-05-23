<?php

namespace Drupal\agilecrm_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

/**
 * Configure agilecrm_module settings for this site.
 */
class WebstatsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'agilecrm_module_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['agilecrm_module.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
   $query = \Drupal::database()->select('agilecrm_module', 'u');
        $query->fields('u', ['agilecrm_module_id','setting_domain','setting_email','setting_password','setting_webrules','setting_webstats']);
        $results = $query->execute()->fetchAll();
        foreach ($results as $k => $v) {  
                   $domain =  $v->setting_domain;
                    $email =  $v->setting_email; 
                    $password =  $v->setting_password; 
                    $webrules = $v->setting_webrules;
                    $webstats = $v->setting_webstats;
           }
       if($webstats == '1'){
        $form['general']['webstats'] = array(
          '#type' => 'checkbox',
          '#default_value' =>TRUE,
        );
      }else{
        $form['general']['webstats'] = array(
          '#type' => 'checkbox',
          '#default_value' =>FALSE,
          );
      }

      if($webrules == '1'){
         $form['general']['webrules'] = array(
          '#type' => 'checkbox',
          '#default_value' =>TRUE,
        );
      }else{
        $form['general']['webrules'] = array(
          '#type' => 'checkbox',
          '#default_value' =>FALSE,
          );
      }
  
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  /*public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

  }*/

  /**
 * Implements security_settings_form_validate().
 */
 public function validateForm(array &$form, FormStateInterface $form_state) {  
     $webstats = $form_state->getValue('webstats');
     $webrules = $form_state->getValue('webrules');
      global $user; 
  // Here u can insert Your custom form values into your custom table.
      
        db_update('agilecrm_module')
         ->fields(array(
         'setting_webstats' => $webstats, 
         'setting_webrules' => $webrules,
        )) ->condition('agilecrm_module_id', '1')->execute();
 


  }

/**
 * Implements security_settings_form_submit().
 */
public function submitForm(array &$form, FormStateInterface $form_state)  { 
  $arr = $form_state->getValues();
  extract($arr);
  $webstats = $webstats;

}

}
  