<?php
function _mw_easyflexbridge_plugin_notices() {
  $content          = file_get_contents(_EASYFLEXBRIDGE_DIR."/json/status.json");
  $content_array    = json_decode($content, true);
  if(!empty($content_array)){
    if($content_array['status']){
      $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
      $url = $base_url . $_SERVER["REQUEST_URI"];
      ?>
      <div class="notice <?php echo $content_array['status']['class']; ?>" style="position:relative;">
          <p><?php echo $content_array['status']['message']; ?></p>
          <form action="" method="post">
          <input type="hidden" name="easyflexbridgenotice" value="dismiss" />
          <button class="notice-dismiss" style="text-decoration:none;"><span class="screen-reader-text">Dismiss this notice.</span></button>
        </form>
      </div>
      <?php
    }
  }
}
add_action( 'admin_notices', '_mw_easyflexbridge_plugin_notices' );

function _mw_easyflexbridge_plugin_status($status){

  if($status=='vacatures_updating'){
    $class    = "notice-info";
    $message  = "Vacatures bijwerken...";
  }
  if($status=='vacatures_empty'){
    $class    = "notice-warning";
    $message  = "Er zijn nog geen vacatures in Easyflex.";
  }
  if($status=='vacatures_success'){
    $class    = "notice-success";
    $message  = "Vacatures zijn bijgewerkt.";
  }
  if($status=='vacatures_error'){
    $class    = "notice-error";
    $message  = "Vacatures zijn niet bijgewerkt.";
  }
  if($status=='settings_checked'){
    $class    = "notice-success";
    $message  = "Easyflex sleutel en Easyflexwordpress api zijn geverifieerd.";
  }
  if($status=='settings_warning'){
    $class    = "notice-warning";
    $message  = "Easyflex bridge mist instellingen, contoleer Easyflex sleutel en Easyflexwordpress api.";
  }
  if($status=='settings_wrong'){
    $class    = "notice-error";
    $message  = "Easyflex sleutel en Easyflexwordpress api niet geldig.";
  }
  if($status=='settings_wrong_api'){
    $class    = "notice-error";
    $message  = "Easyflexwordpress api niet geldig.";
  }
  if($status=='settings_wrong_key'){
    $class    = "notice-error";
    $message  = "Easyflex sleutel niet geldig.";
  }

  $json     = $status=='clear'?'':json_encode(array("status"=>array("class"=>$class,"message"=>$message)));

  $fp = fopen(_EASYFLEXBRIDGE_DIR."/json/status.json", "w");
  fwrite($fp, $json);
  fclose($fp);
}
?>
