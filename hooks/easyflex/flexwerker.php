<?php
Class easyflexbridge_flexwerker {

  public $feedback         = false;

  function __construct($key,$function=false,$args=false){
    if($key!='' && !is_array($key)){
      if($function){
        if($function=='easyflexbridge_signup_flexwerker'){
          $this->feedback = self::easyflexbridge_signup_flexwerker($key,$args);
        }
        if($function=='easyflexbridge_login_flexwerker'){
          $this->feedback = self::easyflexbridge_login_flexwerker($key,$args);
        }
        if($function=='easyflexbridge_update_flexwerker'){
          $this->feedback = self::easyflexbridge_update_flexwerker($key,$args);
        }
      } else {
        //self::easyflexbridge_process_vacatures($key);
      }
    }
  }

  private function easyflexbridge_signup_flexwerker($key,$args){
    $fields = $args['fields'];
    $files  = $args['files'];
    if($files!=''){
      // CV
      $cv_use_name                                    = $files['name']['wm_inschrijving_cv'];
      $cv_file                                        = $files['tmp_name']['wm_inschrijving_cv'];
      $cv_use_file                                    = fread(fopen($file, "r"), filesize($file));
      if($cv_use_name&&$cv_use_file){
        $fields['wm_inschrijving_cv_bestandsnaam']    = $cv_use_name;
        $fields['wm_inschrijving_cv']                 = $cv_use_file;

      }
      // FOTO
      $foto_use_name                                  = $files['name']['wm_inschrijving_foto'];
      $foto_file                                      = $files['tmp_name']['wm_inschrijving_foto'];
      $foto_use_file                                  = fread(fopen($file, "r"), filesize($file));
      if($foto_use_name&&$foto_use_file){
        //$args['wm_vacature_reactie_cv_bestandsnaam']  = $foto_use_name;
        $fields['wm_inschrijving_foto']               = $foto_use_file;

      }
    }

    $trace        = array('trace'=>1);
    $client       = new SoapClient("https://www.easyflex.net/webservice/tools/wsdl.tpsp",$trace);
    $options      = array('namespace' => 'urn:EF', 'trace' => 1);
    $params       = array(
                     'license'    => $key,
                     'parameters' => $fields,
                     'fields'     => ''
                   );
    try {
     $obj         = $client->__call('wm_inschrijven', array('wm_inschrijven' => $params ),$options );
     $request     = $client->__getLastRequest();
     $array       = json_decode( json_encode($obj, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
     $emails      = new easyflexbridge_emails_send('easyflexbridge_register_email',$fields);
     return array(
       "access"  => true,
       "success" => true,
       "message" => 'Uw registratie is gelukt.',
       "results" => $array,
       "emails"  => $emails,
       "debug"   => $request
     );

    } catch (Exception $e) {
      $array      = json_decode( json_encode($e, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      $feedback   = array('access'=>false,'success'=>false,'results'=>false,'message'=>'Registratie niet gelukt. Controleer de verplichte velden.','debug'=>$array);
      return $feedback;
    }

  }
  private function easyflexbridge_login_flexwerker($key,$args){

    $inlognaam  = $args['fields']['db_inlognaam'];
    $wachtwoord = $args['fields']['db_wachtwoord'];

    $trace    = array('trace'=>1);
    $client   = new SoapClient("https://www.easyflex.net/webservice/tools/wsdl.tpsp",$trace);
    $options  = array('namespace' => 'urn:EF', 'trace' => 1);
    $params   = array(
                'license'         => $key,
                'parameters'      => array(
                  'db_inlognaam'  => $inlognaam,
                  'db_wachtwoord' => $wachtwoord,
                  'accounttype'   => 'flexwerker'
                ),
                'fields'          => array(
                    'session'     => ''
                    )
                );
    try {
      $obj            = $client->__call('wm_inloggen_verify', array('wm_inloggen_verify' => $params ),$options );
      $request        = $client->__getLastRequest();
      $array          = json_decode( json_encode($obj, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      $session        = $array['fields']['session'];
      $flexwerker     = self::easyflexbridge_details_flexwerker($key,$args,$session);

      return array(
        "login"       => array(
          "access"      => true,
          "success"     => true,
          "message"     => 'Login is gelukt.',
          "results"     => $array,
          "debug"       => $request
        ),
        "flexwerker"  => $flexwerker
      );
    } catch (Exception $e) {
      $array      = json_decode( json_encode($e, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      return array(
        "login"       => array(
          "access"      => false,
          "success"     => false,
          "results"     => false,
          "message"     => 'Inloggen niet gelukt. Controleer de verplichte velden.',
          "debug"       => $array
        )
      );
    }
  }
  private function easyflexbridge_update_flexwerker($key,$args){

    $inlognaam  = $args['fields']['db_inlognaam'];
    $wachtwoord = $args['fields']['db_wachtwoord'];
    $session    = $args['fields']['db_session'];

    $trace    = array('trace'=>1);
    $client   = new SoapClient("https://www.easyflex.net/webservice/tools/wsdl.tpsp",$trace);
    $options  = array('namespace' => 'urn:EF', 'trace' => 1);
    $params   = array(
                'license'         => $key,
                'parameters'      => array(
                  'session'       => $session,
                  'db_inlognaam'  => $inlognaam,
                  'db_wachtwoord' => $wachtwoord
                ),
                'fields'          => array(
                  'session'       => ''
                  )
                );
    try {
      $obj            = $client->__call('wm_inloggen_update', array('wm_inloggen_update' => $params ),$options );
      $request        = $client->__getLastRequest();
      $array          = json_decode( json_encode($obj, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      $session        = $array['fields']['session'];
      $flexwerker     = self::easyflexbridge_details_flexwerker($key,$args,$session);

      return array(
        "login"       => array(
          "access"      => true,
          "success"     => true,
          "results"     => $array,
          "message"     => 'Updaten inlog is gelukt.',
          "debug"       => $request
        ),
        "flexwerker"  => $flexwerker
      );
    } catch (Exception $e) {
      $array      = json_decode( json_encode($e, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      return array(
        "login"       => array(
          "access"      => true,
          "success"     => true,
          "results"     => array('fields'=>array('session'=>$session)),
          "message"     => 'Inloggen is gelukt.'
        ),
        "flexwerker"    => array(
          "access"      => false,
          "success"     => false,
          "results"     => false,
          "message"     => 'Updaten inlog is niet gelukt.',
          "debug"       => $array
        )
      );
    }
  }
  private function easyflexbridge_details_flexwerker($key,$args,$session){

    $inlognaam    = $args['fields']['db_inlognaam'];
    $wachtwoord   = $args['fields']['db_wachtwoord'];


    $trace     = array('trace'=>1);
    $client    = new SoapClient("https://www.easyflex.net/webservice/tools/wsdl.tpsp",$trace);
    $options   = array('namespace' => 'urn:EF', 'trace' => 1);
    $params    = array(
                 'license'    => $key,
                 'session'    => $session,
                 'parameters' => array(
                   'db_inlognaam'   => $inlognaam,
                   'db_wachtwoord'  => $wachtwoord,
                   'accounttype'    => 'flexwerker'
                 ),
                 'fields'     => array(
                     'fw_flexwerker_idnr'                 => '',
                     'fw_geslacht'                        => '',
                     'fw_voorletters'                     => '',
                     'fw_voorvoegsels'                    => '',
                     'fw_achternaam'                      => '',
                     'fw_roepnaam'                        => '',
                     'fw_geboortedatum'                   => '',
                     'fw_woonadres_straat'                => '',
                     'fw_woonadres_huisnummer'            => '',
                     'fw_woonadres_huisnummer_toevoeging' => '',
                     'fw_woonadres_postcode'              => '',
                     'fw_woonadres_plaats'                => '',
                     'fw_woonadres_land_code'             => ''
                     )
                 );
    try {
      $obj          = $client->__call('fw_persoonsgegevens', array('fw_persoonsgegevens' => $params ),$options );
      $request      = $client->__getLastRequest();
      $array        = json_decode( json_encode($obj, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      $session      = $array['session'];
      $communicatie = '';
      easyflexbridge_session::create( array("timestamp" => date('H:i'), "session"=>$session, "flexwerker"=>$array['fields']) );
      return array(
        'access'        => true,
        'success'       => true,
        "results"       => $array,
        "message"       => 'Flexwerker details opvragen gelukt.',
        "debug"         => $request
      );

    } catch (Exception $e) {
      $array      = json_decode( json_encode($e, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      return array(
        'access'        => false,
        'success'       => false,
        "results"       => array('fields'=>array('session'=>$session)),
        "message"       => 'Flexwerker details opvragen niet gelukt.',
        "debug"         => $array
      );
    }

  }
}
?>
