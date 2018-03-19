<?php
/*
Plugin Name: Easyflex bridge
Plugin URI: https://github.com/easyflexbridge/easyflexbridge-wordpress
Description: Importeer Easyflex vacatures in eigen website zodat u deze in uw eigen omgeving kunt tonen.
Version: 1.2
Author: easyflexwordpress.nl
Author URI: https://www.easyflexwordpress.nl
*/
?>
<?php
define('_EASYFLEXBRIDGE_NAME', 'Easyflex bridge' );
define('_EASYFLEXBRIDGE_STRING', 'easyflexbridge' );
define('_EASYFLEXBRIDGE_DIR', plugin_dir_path(__FILE__) );
define('_EASYFLEXBRIDGE_URL', plugin_dir_url( __FILE__ ) );
define('_EASYFLEXBRIDGE_VERSION', '1.0' );
define('_EASYFLEXBRIDGE_SERVER', 'https://api.easyflexwordpress.nl' );
?>
<?php
// Add settings link on plugin page
function _mw_easyflexbridge_plugin_details($links) {
  $settings_link = '<a href="mailto:support@easyflexwordpress.nl">Support email</a>';
  $settings_link .= ' | <a href="'.get_bloginfo('url').'/wp-admin/options-general.php?page='._EASYFLEXBRIDGE_STRING.'_options">Instellingen</a>';
  array_unshift($links, $settings_link);
  return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", '_mw_easyflexbridge_plugin_details' );
?>
<?php
include_once( _EASYFLEXBRIDGE_DIR . 'vendor/githubupdater/update.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/advancedcustomfieldspro/acf-config.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/advancedcustomfieldspro/acf-fields.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/advancedcustomfieldspro/acf-settings.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/posttypes.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/notices.php' );

include_once( _EASYFLEXBRIDGE_DIR . 'hooks/emails/send.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/server/connect.php' );

include_once( _EASYFLEXBRIDGE_DIR . 'hooks/easyflex/session.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/easyflex/vacatures.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/easyflex/flexwerker.php' );

include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/filters.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/searchbar.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/shortcodes.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/urlparams.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/beforequery.php' );
include_once( _EASYFLEXBRIDGE_DIR . 'hooks/wordpress/functions.php' );
?>
<?php
require _EASYFLEXBRIDGE_DIR.'vendor/githubupdates/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker( 'https://github.com/easyflexbridge/easyflexbridge-wordpress/', _EASYFLEXBRIDGE_DIR.'easyflexbridge-wordpress.php', 'easyflexbridge-wordpress');
//Optional: If you're using a private repository, specify the access token like this:
//$myUpdateChecker->setAuthentication('your-token-here');
//Optional: Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('stable-branch-name');
?>
