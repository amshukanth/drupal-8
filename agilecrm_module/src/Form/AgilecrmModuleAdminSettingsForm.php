<?php

namespace Drupal\agilecrm_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

/**
 * Configure agilecrm_module settings for this site.
 */
class AgilecrmModuleAdminSettingsForm extends FormBase {

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
    $config = $this->config('agilecrm_module.settings');
   $query = \Drupal::database()->select('agilecrm_module', 'u');
        $query->fields('u', ['agilecrm_module_id','setting_domain','setting_email','setting_password','setting_restapikey','setting_jsapikey']);
        $results = $query->execute()->fetchAll();
        foreach ($results as $k => $v) {  
                   $domain =  $v->setting_domain;
                    $email =  $v->setting_email; 
                    $password =  $v->setting_password; 
                    $restapi = $v->setting_restapikey;
                    $jsapikey = $v->setting_jsapikey;
           }

 $form['general']['test'] = [
      '#type' => 'details',
      '#title' => $this->t('<div id="agilewrapper" style="padding: 0px 15% 0px 40%;">
 <img src="../../modules/agilecrm_module/images/agile-crm.png"  title="Agile Crm logo"/> 
</div>'),
      '#open' => TRUE,
    ];
    $form['general']['general'] = [
      '#type' => 'details',
      '#title' => $this->t('Agile CRM settings'),
      '#open' => TRUE,
    ];
    $form['general']['domain_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Domain Name:'),
      '#required' => TRUE,
      '#default_value' => $domain,
    );
    $form['general']['mail'] = array(
      '#type' => 'email',
      '#title' => $this->t('User ID (Email Address):'),
      '#required' => TRUE,
      '#default_value' => $email,
    );
    $form['general']['password'] = array(
      '#type' => 'password',
      '#title' => $this->t('Password:'),
      '#required' => TRUE,
      '#default_value' => $password,
    );
     $form['general']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#attributes' => array(
      'class' => array(
      'your-custom-class' 
        ),
      ),
    );
      $form['general']['text'] = array(
      '#type' => 'markup',
      '#markup' => $this->t('<link href="../../modules/agilecrm_module/css/style.css" media="all" rel="stylesheet" type="text/css"><div class="">
  <div class="box-right" style="margin-left: 4px;text-align:left;">        
      <h3 class="m-t-none h4 m-b-sm">Benefits of Agile CRM Plugin</h3>
      <ul class="listitem" style="margin: .5em 0 .5em -2em;">
     <li>Simple to integrate web rule & web stats, no need of coding knowledge.</li>
 <li>  Show real-time web popups to get more info about your website visitors and also increase the number of subscriptions or sign ups.</li>
 <li>  Easily integrate customized web forms to your website or app to create or update contacts and log subsquent web activity. </li>
 <li>  Easily integrate attractive landing pages with your website using this plugin.</li>
 <li> Schedule bulk Email Campaigns for newsletters or other marketing activity, with simple drag-and-drop features.</li>
</ul>
  </div>
</div>'),
    );

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

    $domain = $form_state->getValue('domain_name');
    $email = $form_state->getValue('mail');
    $password = $form_state->getValue('password');
    define("AGILE_DOMAIN", $domain);  
    define("AGILE_USER_EMAIL", $email);
    define("AGILE_REST_API_KEY", $password);
    $result = $this->curl_wrap("api-key", null, "GET", "application/json");
    $arr = json_decode($result, TRUE);
    extract($arr);
    $rest_api = $api_key;
    $js_api = $js_api_key;
    if($rest_api == ''){
       $form_state->setErrorByName('video', $this->t("Invalid Domain Name, Email or Password"));
    }
 }

/**
 * Implements security_settings_form_submit().
 */
public function submitForm(array &$form, FormStateInterface $form_state)  { 
  $arr = $form_state->getValues();
  extract($arr);
  echo $domain = $domain_name;
  echo $email = $mail;
  echo $password = $password;
  define("AGILE_DOMAIN", $domain);  
  define("AGILE_USER_EMAIL", $email);
  define("AGILE_REST_API_KEY", $password);
  $result = $this->curl_wrap("api-key", null, "GET", "application/json");
  $arr1 = json_decode($result, TRUE);
  extract($arr1);
  $rest_api = $api_key;
  $js_api = $js_api_key;
  $query = \Drupal::database()->select('agilecrm_module', 'u');
        $query->fields('u', ['agilecrm_module_id','setting_domain','setting_email','setting_password','setting_restapikey','setting_jsapikey']);
        $results = $query->execute()->fetchAll();
        foreach ($results as $k => $v) {  
                   $domain_database =  $v->setting_domain;
                    $email =  $v->setting_email; 
                    $password =  $v->setting_password; 
                    $restapi = $v->setting_restapikey;
                    $jsapikey = $v->setting_jsapikey;
           }
  if($domain_database != "") {
      db_update('agilecrm_module')
    ->fields(array(
      'setting_domain' => $domain,
      'setting_email' => $email,
      'setting_password' => $password,
      'setting_restapikey' => $rest_api,
      'setting_jsapikey' => $js_api,
      'setting_webstats' => '1', 
      'setting_webrules' => '1',     
    ))->condition('agilecrm_module_id', '1')->execute();
    drupal_set_message("Your settings have been updated successfully");
  }else{
      db_insert('agilecrm_module')
    ->fields(array(
      'setting_domain' => $domain,
      'setting_email' => $email,
      'setting_password' => $password,
      'setting_restapikey' => $rest_api,
      'setting_jsapikey' => $js_api,
      'setting_webstats' => '1', 
      'setting_webrules' => '1',     
    ))->execute();
    drupal_set_message("successfully saved");  
    }    
  /*global $user; 
  // Here u can insert Your custom form values into your custom table.
 */
}


function curl_wrap($entity, $data, $method, $content_type) {
    if ($content_type == NULL) {
        $content_type = "application/json";
    }
    
    //$agile_url = "https://" . AGILE_DOMAIN . "-dot-sandbox-dot-agilecrmbeta.appspot.com/dev/api/" . $entity;
    $agile_url = "https://" . AGILE_DOMAIN . ".agilecrm.com/dev/api/" . $entity;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);
    switch ($method) {
        case "POST":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case "GET":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "PUT":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case "DELETE":
            $url = $agile_url;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
        default:
            break;
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-type : $content_type;", 'Accept : application/json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, AGILE_USER_EMAIL . ':' . AGILE_REST_API_KEY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

}
  