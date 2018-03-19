<?php
Class easyflexbridge_server {
  public $connect         = false;

  function __construct($fetched_ids=false,$found_ids=false){
    $this->connect = self::easyflexbridge_server_connect($fetched_ids,$found_ids);
  }

  private function easyflexbridge_server_connect($fetched_ids=false,$found_ids=false){
    $return   = false;
    $feedback = false;
    $url      = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $curl     = curl_init();

    // Set some options
    $curl_config = array(
        CURLOPT_URL => 'https://api.easyflexworpress.nl',
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_REFERER => "http://www.wowhead.com",
        CURLOPT_POSTFIELDS => array(
          "url"       => $url,
          "api"       => '2w6h5FQMb37x2SzGjj3wGa3q',
          "action"    => 'check_key', // check_key, check_updates, update_vacatures
          "easyflex"  => json_encode($fetched_ids, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT),
          "wordpress" => json_encode($found_ids, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)
        )
    );
    curl_setopt_array($curl, $curl_config);
    $resp = curl_exec($curl);
    curl_close($curl);

    if($resp){
      $feedback = json_decode( $resp , TRUE);
    }
    // do something
    if($feedback['success']){
      $return = array();
      $return['missing_vacatures']  = ($feedback['easyflexbridge_create']?$feedback['easyflexbridge_create']:false);
      $return['existing_vacatures'] = ($feedback['easyflexbridge_update']?$feedback['easyflexbridge_update']:false);
      $return['deleted_vacatures']  = ($feedback['easyflexbridge_delete']?$feedback['easyflexbridge_delete']:false);
      $return['debug']  = ($feedback['debug']?$feedback['debug']:false);
    }
    return $return;
  }

}
?>
