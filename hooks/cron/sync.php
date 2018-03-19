<?php
require_once $_SERVER['DOCUMENT_ROOT']."/wp-load.php";
$key = get_field('_mw_easyflexbridge_key','options');
if($key){
  _mw_easyflexbridge_plugin_status('vacatures_updating');
  new easyflexbridge_vacatures($key);
} else {
  _mw_easyflexbridge_plugin_status('settings_warning');
}
?>
