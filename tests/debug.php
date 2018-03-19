<?php
// wp-content/plugins/easyflex-bridge/tests/debug.php
header("Content-Type: application/json");
require_once $_SERVER['DOCUMENT_ROOT']."/wp-load.php";
$key      = get_field('_mw_easyflexbridge_key','option');

//$server   = new easyflexbridge_server;
//print_r($server);

//$easyflex = new easyflexbridge_vacatures($key,'easyflexbridge_fetch_vacatures');
//print_r($easyflex->debuggin);


//easyflexbridge_session::create( array("timestamp" => date('H:i')) );
//print_r($_SESSION);
//echo _EASYFLEXBRIDGE_DIR.'hooks/cron/sync.php';
//_mw_easyflexbridge_plugin_status('vacatures_success');
//exec('wget '._EASYFLEXBRIDGE_URL.'hooks/cron/sync.php');
//$test     = new easyflexbridge_sync_vacatures($key);
//echo json_encode($test->vacatures['easyflexbridge_process_vacatures'], JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
//echo json_encode($_SESSION,JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
//echo do_shortcode('[easyflexbridge widget="login"]');
//echo do_shortcode('[easyflexbridge widget="account"]');
//echo do_shortcode('[easyflexbridge widget="register"]');

//echo do_shortcode('[easyflexbridge widget="vacatureapply" postid="1120"]');
//echo do_shortcode('[easyflexbridge widget="vacaturesearch"]');
//echo do_shortcode('[easyflexbridge widget="vacaturefilter"]');

//$filters      = new easyflexbridge_filter_vacatures;
//echo json_encode($filters,JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

//$content          = file_get_contents(_EASYFLEXBRIDGE_DIR."/hooks/demo/content.json");
//$content_array    = json_decode($content, true);
//$fetched_items    = $content_array['easyflexbridge_fetch_vacatures']['results'];
//$fetched_ids      = array_keys($fetched_items);
//echo json_encode($fetched_ids, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

//$found_obj        = new easyflexbridge_sync_vacatures($key,'easyflexbridge_found_vacatures');
//$found_ids        = $found_obj->vacatures['easyflexbridge_found_vacatures'];
//echo json_encode($found_ids, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

//print_r($fetched_ids[0]);


//print_r($content_results);

//$server = new easyflexbridge_server($fetched_ids,$found_ids);
//echo json_encode($server->connect, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
?>
