<?php
/**
 * @file
 * Contains \Drupal\hello_world\Controller\HelloController.
 */

namespace Drupal\agilecrm_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class AgilecrmModuleController extends ControllerBase{
  public function home() {
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
  if($domain) {      
 $myform = \Drupal::formBuilder()->getForm('Drupal\agilecrm_module\Form\WebstatsForm');
 $webrulesform = \Drupal::formBuilder()->getForm('Drupal\agilecrm_module\Form\WebrulesForm');
     return array(
      '#theme' => 'home-page',
      '#webstats' => $myform,
      '#domain' => $domain,
      '#email' => $email,
      '#password' => $password,
      '#restapi' => $restapi,
      '#webrules' => $webrulesform,
    );
   }else{ ?>
    <script>
    window.location.href = "agilecrm/settings";
    </script>
   <?php }
  }
  public function webrules()
{
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
    if($domain)  { 
    define("AGILE_DOMAIN", $domain);  
    define("AGILE_USER_EMAIL", $email);
    define("AGILE_REST_API_KEY", $restapi);
    $result = $this->curl_wrap("webrule", null, "GET", "application/json");
    $arr = json_decode($result, TRUE);
    return array(
      '#theme' => 'webrules-page',
      '#test_var' => $arr,
      '#domain' => $domain,
      '#email' => $email,
      '#password' => $password,
      '#restapi' => $restapi,
    );
    }else{ ?>
    <script>
    window.location.href = "settings";
    </script>
   <?php }

}
 
public function formbuilder() {
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
    if($domain)  {
    define("AGILE_DOMAIN", $domain);  
    define("AGILE_USER_EMAIL", $email);
    define("AGILE_REST_API_KEY", $restapi);
    $result = $this->curl_wrap("forms", null, "GET", "application/json");
    $arr = json_decode($result, TRUE);
    return array(
      '#theme' => 'formbuilder-page',
      '#test_var' => $arr,
      '#domain' => $domain,
      '#email' => $email,
      '#password' => $password,
      '#restapi' => $restapi,
    );
     }else{ ?>
    <script>
    window.location.href = "settings";
    </script>
   <?php }

  } 
public function landingpages() {
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
    if($domain)  {     
    define("AGILE_DOMAIN", $domain);  
    define("AGILE_USER_EMAIL", $email);
    define("AGILE_REST_API_KEY", $restapi);
    $result = $this->curl_wrap("landingpages", null, "GET", "application/json");
    $arr = json_decode($result, TRUE);
    return array(
      '#theme' => 'landing-page',
      '#test_var' => $arr,
      '#domain' => $domain,
      '#email' => $email,
      '#password' => $password,
      '#restapi' => $restapi,
    );
     }else{ ?>
    <script>
    window.location.href = "settings";
    </script>
   <?php }
  }
 public function emailcampaigns() {
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
    if($domain)  {
    define("AGILE_DOMAIN", $domain);  
    define("AGILE_USER_EMAIL", $email);
    define("AGILE_REST_API_KEY", $restapi);
    $result = $this->curl_wrap("workflows", null, "GET", "application/json");
    $arr = json_decode($result, TRUE);
    return array(
      '#theme' => 'email-page',
      '#test_var' => $arr,
      '#domain' => $domain,
      '#email' => $email,
      '#password' => $password,
      '#restapi' => $restapi,
    );
     }else{ ?>
    <script>
    window.location.href = "settings";
    </script>
   <?php }
  }  

 public function webstats() {
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
       if($domain)  {  
      $myform = \Drupal::formBuilder()->getForm('Drupal\agilecrm_module\Form\WebstatsForm');
      // If you want modify the form:
      $myform['field']['#webstats'];   
     return array(
      '#theme' => 'webstats-page',
      '#test_var' => $myform,
      '#domain' => $domain,
      '#email' => $email,
      '#password' => $password,
      '#restapi' => $restapi,
    );
     }else{ ?>
    <script>
    window.location.href = "settings";
    </script>
   <?php }

  }
/*public function referafriend()
{
       /* $db = \Drupal::database();
        $query = $db->select('agilecrm_module', 'a');
        $query->fields('a', array('agilecrm_module_id','setting_domain', 'setting_email', 'setting_password'));
        $users = $query->execute()->fetchAll();*/

        /*$query = \Drupal::database()->select('agilecrm_module', 'u');
        $query->fields('u', ['agilecrm_module_id','setting_domain','setting_email','setting_password','setting_restapikey','setting_jsapikey']);
        $results = $query->execute()->fetchAll();
        foreach ($results as $k => $v) {  
                    $domain =  $v->setting_domain;
                    $email =  $v->setting_email; 
                    $password =  $v->setting_password; 
                    $restapi = $v->setting_restapikey;
                    $jsapikey = $v->setting_jsapikey;
           }*/
   /* $build = array(
      '#type' => 'markup',
      '#markup' => t('<iframe width="100%" height="4500px" src="http://crazywebservices.com/drupal/webrules.php?domain='.$domain.'&email='.$email.'&restapi='.$restapi.'&jsapikey='.$jsapikey.'&password='.$password.'" frameborder="0" allowfullscreen="" class="wp-campaigns-video"></iframe>'),
    );
    return $build;

}*/


public function referafriend() {
    $build = array(
      '#type' => 'markup',
      '#markup' => t('<link href="../../modules/agilecrm_module/css/style.css" media="all" rel="stylesheet" type="text/css"><div id="features">
<form action="" method="post"><input type="hidden" name="featuresform" value="featuresform">
<div class="mainLeftbox">
 <div class="box" style="width: 90%;margin-left: -2px;">
  <div class="right stripline">
    <div class="header"> <img src="../../modules/agilecrm_module/images/refer a friend.svg" width="60px" height="60px" title="Web Rules" alt="webstatus" /> </div>
    <div class="left">
    </div>
    <h2 class="heading">Refer a Friend</h2>
   <h5 style="font-weight:normal">Our customers are our biggest ambassadors. Your love for the product is what makes you refer other awesome clients to us time and again. Not surprisingly, "word of mouth" has been our most successful source of new customers.
     We’d like to show our gratitude to all of you who take the time to recommend us to your colleagues and partners.</h5>
     </div> 
 </div>
 
 </div>
<div class="mainrightbox">

  <div class="box-right">        
      <h3 class="m-t-none h4 m-b-sm">Refer a Friend</h3>
      <div style="text-align:center;">
                  <div class="refer-friend-desc"> 
                    <p><span>Follow us on Twitter:<br/></span> Follow @agilecrm on Twitter and share about Agile CRM to claim <span>500 extra</span> emails.</p>
                    <p><span>Tweet about us:<br/></span> Mention and retweet about Agile CRM on your Twitter timeline to claim <span>500 extra</span> emails.</p>
                    <p><span>Share on Facebook:<br/></span> Share Agile updates with your Facebook contacts to claim <span>500 extra</span> emails.</p>
                   <p><span>Refer friends:<br/></span> Invite friends to sign up and try Agile CRM to claim <span>500 extra</span> emails per signup.</p>
                   <p><span>Write a blog about us:<br/></span> Blog about Agile CRM and spread the word for <span>2500 extra</span> emails.</p>
                  <a href="https://www.agilecrm.com/blog/agiles-crm-referral-program/" target="_blank" class="fb-read">Read more</a>
                  </div>
                 </div>
     </div>
  </div>
</div>'),
    );
    return $build;
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