<?php
// Adds ACF
if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( !is_plugin_active('advanced-custom-fields-pro/acf.php') )  {
  add_filter('acf/settings/path', 'madework_calculator_acf_settings_path');
  function madework_calculator_acf_settings_path( $path ) {
      $path = _EASYFLEXBRIDGE_DIR . 'vendor/advancedcustomfieldspro/';
      return $path;
  }
  add_filter('acf/settings/dir', 'madework_calculator_acf_settings_dir');
  function madework_calculator_acf_settings_dir( $dir ) {
      $dir = _EASYFLEXBRIDGE_URL.'vendor/advancedcustomfieldspro/';
      return $dir;
  }
  // 3. Hide ACF field group menu item when done!
  //add_filter('acf/settings/show_admin', '__return_false');
  include_once( _EASYFLEXBRIDGE_DIR . 'vendor/advancedcustomfieldspro/acf.php' );
}

?>
