<?php
// start session timer
if( !is_admin() && !_mw_easyflexbridge_plugin_is_login_page() ){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if(isset($_SESSION['easyflexbridge']['timestamp'])){
    if($_SESSION['easyflexbridge']['timestamp']!=''){
      $easyflex_wordpress_beg_time            = $_SESSION['easyflexbridge']['timestamp'];
      $easyflex_wordpress_now_time            = date('H:i');
      $easyflex_wordpress_end_time            = date('H:i',strtotime($easyflex_wordpress_beg_time."+10 minutes"));
      $easyflex_wordpress_check_start_time    = DateTime::createFromFormat('H:i', $easyflex_wordpress_beg_time);
      $easyflex_wordpress_check_current_time  = DateTime::createFromFormat('H:i', $easyflex_wordpress_now_time);
      $easyflex_wordpress_check_end_time      = DateTime::createFromFormat('H:i', $easyflex_wordpress_end_time);
      if($easyflex_wordpress_check_current_time >= $easyflex_wordpress_check_start_time && $easyflex_wordpress_check_current_time <= $easyflex_wordpress_check_end_time){
        // Do nothing, current hash is still valid
      } else {
        // Remove easyflex session, time has expired
        $_SESSION['easyflexbridge'] = '';
      }
    }
  } else {
    $_SESSION['easyflexbridge'] = '';
  }
}

function _mw_easyflexbridge_plugin_is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

Class easyflexbridge_session {
  public function read(){
    return $_SESSION['easyflexbridge'];
  }
  public function create($array){
    if(is_array($array)){
      $_SESSION["easyflexbridge"] = $array;
    }
  }
  public function delete(){
    if( isset($_SESSION['easyflexbridge']) ){
      $_SESSION['easyflexbridge'] = '';
    }
  }
}

?>
