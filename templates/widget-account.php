<?php
$checkflexwerker = isset($_SESSION["easyflexbridge"]["flexwerker"])?$_SESSION["easyflexbridge"]["flexwerker"]:false;
if($checkflexwerker){
  $account_field_info      = _mw_easyflexbridge_mapping_account_information(array());
  $account_field_options   = get_field('_mw_easyflexbridge_account_shortcode_information','options');
  //print_r($account_field_options);
  if($account_field_options){
    echo '<h3>Uw account</h3>';
    echo '<ul>';
    foreach($account_field_options as $account_field_option_key => $account_field_option){
      $field_name = $account_field_option['label'];
      $field_key  = $account_field_option['value'];
      echo '<li>';
      echo '<strong>'.$field_name.'</strong><br/>';
      if(isset($checkflexwerker[$field_key]) && $checkflexwerker[$field_key]!=''){
        echo $checkflexwerker[$field_key];
      } else {
        echo '-';
      }
      echo '</li>';
    }
    echo '</ul>';
  }
} else {
  echo '<h3>Account</h3>';
  echo '<p>U moet ingelogd zijn als u uw gegevens wilt inzien.</p>';
}
?>
