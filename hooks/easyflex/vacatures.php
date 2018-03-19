<?php
Class easyflexbridge_vacatures {

  public $vacatures        = false;
  public $feedback         = false;
  //public $debuggin         = false;

  function __construct($key,$function=false,$args=false){
    if($key!='' && !is_array($key)){
      if($function){
        if($function=='easyflexbridge_fetch_vacatures'){
          $this->feedback = self::easyflexbridge_fetch_vacatures($key);
        }
        if($function=='easyflexbridge_found_vacatures'){
          $this->feedback = self::easyflexbridge_found_vacatures();
        }
        if($function=='easyflexbridge_applyto_vacature'){
          $this->feedback = self::easyflexbridge_applyto_vacature($key,$args);
        }
      } else {
        self::easyflexbridge_process_vacatures($key);
      }
    }
  }
  private function easyflexbridge_process_vacatures($key){
    if($key!='' && !is_array($key)){
      $results    = self::easyflexbridge_fetch_vacatures($key);
      if($results['results']){
        $fetched_items  = $results['results'];
        $fetched_ids    = array_keys($fetched_items);
        $found_ids      = self::easyflexbridge_found_vacatures();
        $server         = new easyflexbridge_server($fetched_ids,$found_ids);
        $compare        = $server->connect;
        $this->vacatures['easyflexbridge_fetch_vacatures']    = $results;
        $this->vacatures['easyflexbridge_process_vacatures']  = $compare;
        if($compare){
          $existing   = $compare['existing_vacatures'];
          $missing    = $compare['missing_vacatures'];
          $deleted    = $compare['deleted_vacatures'];
          if(!empty($existing)){
            self::easyflexbridge_update_vacatures($existing,$results['results']);
          }
          if(!empty($missing)){
            self::easyflexbridge_create_vacatures($missing,$results['results']);
          }
          if(!empty($deleted)){
            self::easyflexbridge_delete_vacatures($deleted);
          }
          _mw_easyflexbridge_plugin_status('vacatures_success');
        } else {
          _mw_easyflexbridge_plugin_status('settings_wrong_api');
        }
      }
    }
  }
  private function easyflexbridge_fetch_vacatures($key){
    if($key!='' && !is_array($key)){
      $client   = new SoapClient("https://www.easyflex.net/webservice/tools/wsdl.tpsp");
      $options  = array('namespace' => 'urn:EF', 'trace' => 0);
      $params   = array(
          'license'     => $key,
          'parameters'  => '',
          'fields'      => array(
              'wm_vacature_idnr'                => '',
              'wm_vacature_postcode'            =>'',
              'wm_vacature_postcode_org'        =>'',
              'wm_vacature_plaats'              =>'',
              'wm_vacature_landcode'            =>'',
              'wm_vacature_periode'             =>'',
              'wm_vacature_functie_idnr'        =>'',
              'wm_vacature_functie'             =>'',
              'wm_vacature_functie_omsch'       =>'',
              'wm_vacature_soort'               =>'',
              'wm_vacature_bedrijfstak'         =>'',
              'wm_vacature_businessunits'       =>'',
              'wm_vacature_relatie_id'          =>'',
              'wm_vacature_relatie_bedrijfsnaam'=>'',
              'wm_vacature_wmnaam'              =>'',
              'wm_vacature_wmlocatie_id'        =>'',
              'wm_vacature_wmlocatie_adres'     =>'',
              'wm_vacature_wmlocatie_huisnr'    =>'',
              'wm_vacature_wmlocatie_huisnr_tv' =>'',
              'wm_vacature_wmlocatie_plaats'    =>'',
              'wm_vacature_contactpersoon_id'   =>'',
              'wm_vacature_contactpersoon'      =>'',
              'wm_vacature_urenperweek'         =>'',
              'wm_vacature_werktijden'          =>'',
              'wm_vacature_loonindicatie'       =>'',
              'wm_vacature_loonperiode'         =>'',
              'wm_vacature_eisen'               =>'',
              'wm_vacature_omschrijving'        =>'',
              'wm_vacature_rijbewijs'           =>'',
              'wm_businessunit_idnr'            =>'',
              'wm_businessunit_naam'            =>'',
              'wm_vacature_memo'                =>''
              )
          );
      try {
        $obj        = $client->__call('wm_vacature_all', array('wm_vacature_all' => $params ),$options );
        $array      = json_decode( json_encode($obj, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);

        $results    = false;
        $message    = 'Omzetten feedback mislukt.';
        if( array_filter($array) ){
          if(isset($array['fields']['item']) && $array['fields']['item']){
            $results  = array();
            if( isset($array['fields']['item'][0]) ){
              foreach($array['fields']['item'] as $item_key => $item_values){
                $results[$item_values['wm_vacature_idnr']] = $item_values;
              }
            } else {
              $results[$array['fields']['item']['wm_vacature_idnr']] = $array['fields']['item'];
            }
            $message = 'Er zijn vacatures gevonden.';
          }
          _mw_easyflexbridge_plugin_status('vacatures_updating');
        } else {
          _mw_easyflexbridge_plugin_status('vacatures_empty');
        }
        $feedback = array('access'=>true,'results'=>$results,'message'=>'Er zijn nog geen vacatures toegevoegd in Easyflex.');
        return $feedback;
      } catch (Exception $e) {
        $array      = json_decode( json_encode($e, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
        $feedback   = array('access'=>false,'results'=>false,'message'=>'Verbinding met easyflex mislukt.','debug'=>$array);
        _mw_easyflexbridge_plugin_status('settings_wrong_key');
        return $feedback;
      }
    }
  }
  private function easyflexbridge_found_vacatures(){
    // we know all vacature numbers
    $all_vacatures      = false;
    // fetch all vacature numbers in wordpress
    $all_args           = array(
      'post_type'       =>  'easyflex_vacatures',
      'post_status'     => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit','trash'), // let's look in every corner but trash -- 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'
      'posts_per_page'	=>   -1
    );
    $all_posts          = new WP_Query( $all_args );
    $all_vacatures      = array();
    if( $all_posts->have_posts() ){
      $all_vacatures = array();
      while( $all_posts->have_posts() ) : $all_posts->the_post();
      $post_id                            = get_the_ID();
      $vacature_id                        = get_field('wm_vacature_idnr',$post_id);
      if($vacature_id){
        $all_vacatures["{$post_id}"]      = $vacature_id;
      }
      endwhile;
    }
    return $all_vacatures;
  }
  private function easyflexbridge_create_vacatures($vacature_numbers,$easyflex_vacatures){
    $o_title          = get_field('easyflex_vacature_url','options');
    foreach($vacature_numbers as $vacature_key => $vacature_number){
      $cat_catcher    = false;
      $new_url        = ($o_title=='id'?$vacature_number:(isset($easyflex_vacatures[$vacature_number]['wm_vacature_functie'])&&$easyflex_vacatures[$vacature_number]['wm_vacature_functie']!=''?self::slugify($easyflex_vacatures[$vacature_number]['wm_vacature_functie']):$vacature_number));

      $new_post_args = array(
        'post_type'   => 'easyflex_vacatures',
        'post_name'   => $new_url,
        'post_title'	=> $easyflex_vacatures[$vacature_number]['wm_vacature_functie'],
        'post_status'	=> 'draft'
      );
      $new_post_id = wp_insert_post( $new_post_args );
      if($new_post_id){
        foreach($easyflex_vacatures[$vacature_number] as $vacature_field => $vacature_value){
          update_field( $vacature_field, $vacature_value, $new_post_id );
          if($vacature_field=='wm_vacature_soort' && $vacature_value!=''){
            $cat_catcher = false;
          }
        }
        if($cat_catcher){
          wp_set_post_terms( $new_post_id, $cat_catcher, 'easyflex_cat' );
        }
        $status = array( 'ID' => $new_post_id, 'post_status' => 'publish', 'post_content'=> $easyflex_vacatures[$vacature_number]['wm_vacature_omschrijving']);
        wp_update_post($status);
      }
    }
  }
  private function easyflexbridge_update_vacatures($vacature_numbers,$easyflex_vacatures){
    foreach($vacature_numbers as $post_id => $vacature_id){
      foreach($easyflex_vacatures[$vacature_id] as $vacature_field => $vacature_value){
        update_field( $vacature_field, $vacature_value, $post_id );
        if($vacature_field=='wm_vacature_soort' && $vacature_value!=''){
          $cat_catcher = false;
        }
      }
      if($cat_catcher){
        wp_set_post_terms( $post_id, $cat_catcher, 'easyflex_cat' );
      }
      $status = array( 'ID' => $post_id, 'post_status' => 'publish', 'post_content'=> $easyflex_vacatures[$vacature_id]['wm_vacature_omschrijving']);
      wp_update_post($status);
    }
  }
  private function easyflexbridge_delete_vacatures($vacature_numbers){
    foreach($vacature_numbers as $post_id => $vacature_id){
      wp_delete_post( $post_id, true );
    }
  }
  private function easyflexbridge_applyto_vacature($key,$args){
    $fields = $args['fields'];
    $files  = $args['files'];

    if($files!=''){
      // CV
      $cv_use_name                                    = $files['name']['wm_vacature_reactie_cv'];
      $cv_file                                        = $files['tmp_name']['wm_vacature_reactie_cv'];
      $cv_use_file                                    = fread(fopen($file, "r"), filesize($file));
      if($cv_use_name&&$cv_use_file){
        $args['wm_vacature_reactie_cv_bestandsnaam']  = $cv_use_name;
        $args['wm_vacature_reactie_cv']               = $cv_use_file;

      }
      // FOTO
      $foto_use_name                                  = $files['name']['wm_vacature_reactie_foto'];
      $foto_file                                      = $files['tmp_name']['wm_vacature_reactie_foto'];
      $foto_use_file                                  = fread(fopen($file, "r"), filesize($file));
      if($foto_use_name&&$foto_use_file){
        //$args['wm_vacature_reactie_cv_bestandsnaam']  = $foto_use_name;
        $args['wm_vacature_reactie_foto']             = $foto_use_file;

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
      $obj        = $client->__call('wm_vacature_reactie', array('wm_vacature_reactie' => $params ),$options );
      $request    = $client->__getLastRequest();
      $array      = json_decode( json_encode($obj, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      $emails     = new easyflexbridge_emails_send('easyflexbridge_apply_email',$fields);
      return array(
        "access"  => true,
        "success" => true,
        "message" => 'Uw reactie is verstuurd.',
        "results" => $array,
        "emails"  => $emails,
        "debug"   => $request
      );
    } catch (Exception $e) {
      $array      = json_decode( json_encode($e, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT) , TRUE);
      $feedback   = array('access'=>false,'success'=>false,'results'=>false,'message'=>'Reactie niet gelukt. Controleer de verplichte velden.','debug'=>$array);
      return $feedback;
    }


  }

  // Support scripts
  private function slugify($text,$strict = false) {
      $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);
      // trim
      $text = trim($text, '-');
      setlocale(LC_CTYPE, 'en_GB.utf8');
      // transliterate
      if (function_exists('iconv')) {
         $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      }
      // lowercase
      $text = strtolower($text);
      // remove unwanted characters
      $text = preg_replace('~[^-\w.]+~', '', $text);
      if (empty($text)) {
         return 'empty_$';
      }
      if ($strict) {
          $text = str_replace(".", "_", $text);
      }
      return $text;
  }
}
?>
