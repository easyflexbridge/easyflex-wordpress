<?php
function is_easyflex_logged_in(){
  $check_session   = isset($_SESSION["easyflexbridge"]["flexwerker"])?$_SESSION["easyflexbridge"]["flexwerker"]:false;
  if($form_login_session){
    return $check_session;
  }
  return false;
}
?>
