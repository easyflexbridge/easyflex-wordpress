<?php
if( $_POST['easyflexbridgenotice']=='dismiss' ){
  _mw_easyflexbridge_plugin_status('clear');
}
if( $_POST['easyflexbridgelogout']=='true' || $_GET['easyflexbridgelogout']=='true' ){
  easyflexbridge_session::delete();
}
if( isset($_POST['easyflexbridge_vacaturereactie']) && $_POST['easyflexbridge_vacaturereactie']!='' ){
  $use_key = get_field('_mw_easyflexbridge_key','option');
  if($use_key){
    $args = array(
      'fields'  => $_POST['easyflexbridge_vacaturereactie'],
      'files'   => $_FILES['easyflexbridge_vacaturereactie']
    );
    $action = new easyflexbridge_vacatures($use_key,'easyflexbridge_applyto_vacature',$args);
    $_POST['easyflexbridge_vacaturereactie']['feedback']  = $action->feedback;
  } else {
    $_POST['easyflexbridge_vacaturereactie']['feedback']['message']  = 'Reageren is niet mogelijk.';
  }
}
if( isset($_POST['easyflexbridge_flexwerkerinschrijven']) && $_POST['easyflexbridge_flexwerkerinschrijven']!='' ){
  $use_key = get_field('_mw_easyflexbridge_key','option');
  if($use_key){
    $args = array(
      'fields'  => $_POST['easyflexbridge_flexwerkerinschrijven'],
      'files'   => $_FILES['easyflexbridge_flexwerkerinschrijven']
    );
    $action = new easyflexbridge_flexwerker($use_key,'easyflexbridge_signup_flexwerker',$args);
    $_POST['easyflexbridge_flexwerkerinschrijven']['feedback']  = $action->feedback;
  } else {
    $_POST['easyflexbridge_flexwerkerinschrijven']['feedback']['message']  = 'Inschrijven is niet mogelijk.';
  }
}
if( isset($_POST['easyflexbridge_flexwerkerinloggen']) && $_POST['easyflexbridge_flexwerkerinloggen']!='' ){
  $use_key = get_field('_mw_easyflexbridge_key','option');
  if($use_key){
    $args = array(
      'fields'  => $_POST['easyflexbridge_flexwerkerinloggen'],
      'files'   => $_FILES['easyflexbridge_flexwerkerinloggen']
    );
    $action = new easyflexbridge_flexwerker($use_key,'easyflexbridge_login_flexwerker',$args);
    $_POST['easyflexbridge_flexwerkerinloggen']['feedback']  = $action->feedback;
  } else {
    $_POST['easyflexbridge_flexwerkerinloggen']['feedback']['login']['message']  = 'Inloggen is niet mogelijk.';
  }
}
if( isset($_POST['easyflexbridge_flexwerkerupdating']) && $_POST['easyflexbridge_flexwerkerupdating']!='' ){
  $use_key = get_field('_mw_easyflexbridge_key','option');
  if($use_key){
    $args = array(
      'fields'  => $_POST['easyflexbridge_flexwerkerupdating'],
      'files'   => $_FILES['easyflexbridge_flexwerkerupdating']
    );
    $action = new easyflexbridge_flexwerker($use_key,'easyflexbridge_update_flexwerker',$args);
    $_POST['easyflexbridge_flexwerkerupdating']['feedback']  = $action->feedback;
  } else {
    $_POST['easyflexbridge_flexwerkerupdating']['feedback']['login']['message']  = 'Inloggen is niet mogelijk.';
  }
}
?>
