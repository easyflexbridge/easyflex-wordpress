<?php
if(function_exists(acf_add_options_page)){

  acf_add_options_page(array(
  'menu_title' 	=> _EASYFLEXBRIDGE_NAME,
	'page_title' 	=> _EASYFLEXBRIDGE_NAME.' instellingen',
	'menu_slug' 	=> _EASYFLEXBRIDGE_STRING.'_general_settings',
	'capability' 	=> 'edit_posts',
	'parent_slug'	=> 'options-general.php',
	'position'	  => false,
	'icon_url'    => 'dashicons-images-alt2',
	'redirect'	  => false
	));

  acf_add_options_page(array(
  'menu_title' 	=> 'Instellingen',
	'page_title' 	=> 'Easyflex vacatures instellingen',
	'menu_slug' 	=> _EASYFLEXBRIDGE_STRING.'_vacatures_settings',
	'capability' 	=> 'edit_posts',
	'parent_slug'	=> 'edit.php?post_type=easyflex_vacatures',
	'position'	  => false,
	'icon_url'    => 'dashicons-images-alt2',
	'redirect'	  => false
	));

}

function _mw_easyflexbridge_mapping_vacature_information( $field ) {
  // reset choices
  $field['choices'] = array();
  $field['choices']['wm_vacature_idnr']                 = 'Vacature nummer';
  $field['choices']['wm_vacature_postcode']             = 'Postcode';
  $field['choices']['wm_vacature_postcode_org']         = 'Originele postcode';
  $field['choices']['wm_vacature_plaats']               = 'Plaats';
  $field['choices']['wm_vacature_landcode']             = 'Landcode';
  $field['choices']['wm_vacature_periode']              = 'Periode';
  $field['choices']['wm_vacature_functie_idnr']         = 'Functie ID';
  $field['choices']['wm_vacature_functie']              = 'Functie';
  $field['choices']['wm_vacature_functie_omsch']        = 'Functie omschrijving';
  $field['choices']['wm_vacature_soort']                = 'Vacature soort';
  $field['choices']['wm_vacature_relatie_id']           = 'Relatie ID';
  $field['choices']['wm_vacature_relatie_bedrijfsnaam'] = 'Relatie bedrijfsnaam';
  $field['choices']['wm_vacature_bedrijfstak']          = 'Bedrijfstak';
  $field['choices']['wm_vacature_businessunits']        = 'Businessunits';
  $field['choices']['wm_vacature_wmnaam']               = 'Werkmaatschappij naam';
  $field['choices']['wm_vacature_wmlocatie_id']         = 'Werkmaatschappij ID';
  $field['choices']['wm_vacature_wmlocatie_adres']      = 'Werkmaatschappij adres';
  $field['choices']['wm_vacature_wmlocatie_huisnr']     = 'Werkmaatschappij huisnummer';
  $field['choices']['wm_vacature_wmlocatie_huisnr_tv']  = 'Werkmaatschappij huisnummer toevoeging';
  $field['choices']['wm_vacature_wmlocatie_plaats']     = 'Werkmaatschappij plaats';
  $field['choices']['wm_vacature_contactpersoon_id']    = 'Contactpersoon ID';
  $field['choices']['wm_vacature_contactpersoon']       = 'Contactpersoon naam';
  $field['choices']['wm_vacature_urenperweek']          = 'Uren per week';
  $field['choices']['wm_vacature_werktijden']           = 'Werktijden';
  $field['choices']['wm_vacature_loonindicatie']        = 'Loonindicatie';
  $field['choices']['wm_vacature_loonperiode']          = 'Loonperiode';
  $field['choices']['wm_vacature_eisen']                = 'Eisen';
  $field['choices']['wm_vacature_omschrijving']         = 'Omschrijving';
  $field['choices']['wm_vacature_rijbewijs']            = 'Rijbewijs';
  $field['choices']['wm_vacature_memo']                 = 'Memo';
  return $field;
}
add_filter('acf/load_field/name=_mw_easyflexbride_vacatures_searchbar_items', '_mw_easyflexbridge_mapping_vacature_information');
add_filter('acf/load_field/name=_mw_easyflexbride_vacatures_filter_items', '_mw_easyflexbridge_mapping_vacature_information');

function _mw_easyflexbridge_mapping_vacature_apply( $field ) {
  // reset choices
  $field['choices'] = array();
  $field['choices']['wm_vacature_reactie_geslacht']     = 'Geslacht';
  $field['choices']['wm_vacature_reactie_voorletters']  = 'Voorletters';
  $field['choices']['wm_vacature_reactie_voorvoegsel']  = 'Voorvoegsel';
  $field['choices']['wm_vacature_reactie_achternaam']   = 'Achternaam';
  $field['choices']['wm_vacature_reactie_voornaam']     = 'Voornaam';
  $field['choices']['wm_vacature_reactie_gebdatum']     = 'Geboortedatum';
  $field['choices']['wm_vacature_reactie_postcode']     = 'Postcode';
  $field['choices']['wm_vacature_reactie_plaats']       = 'Plaats';
  $field['choices']['wm_vacature_reactie_adres']        = 'Adres';
  $field['choices']['wm_vacature_reactie_huisnr']       = 'Huisnummer';
  $field['choices']['wm_vacature_reactie_tvg']          = 'Huisnummer toevoeging';
  $field['choices']['wm_vacature_reactie_land']         = 'Land';
  $field['choices']['wm_vacature_reactie_telefoon']     = 'Telefoon';
  $field['choices']['wm_vacature_reactie_mobiel']       = 'Mobiel';
  $field['choices']['wm_vacature_reactie_email']        = 'Email';
  $field['choices']['wm_vacature_reactie_cv']           = 'CV';
  $field['choices']['wm_vacature_reactie_foto']         = 'Foto';
  $field['choices']['wm_vacature_reactie_opmerking']    = 'Opmerking';
  return $field;
}
add_filter('acf/load_field/name=_mw_easyflexbride_vacatures_reply_items', '_mw_easyflexbridge_mapping_vacature_apply');

function _mw_easyflexbridge_mapping_account_information( $field ) {
  // reset choices
  $field['choices'] = array();
  $field['choices']['fw_flexwerker_idnr']                 = 'ID nummer';
  $field['choices']['fw_geslacht']                        = 'Geslacht';
  $field['choices']['fw_voorletters']                     = 'Voorletters';
  $field['choices']['fw_voorvoegsels']                    = 'Voorvoegsel';
  $field['choices']['fw_achternaam']                      = 'Achternaam';
  $field['choices']['fw_roepnaam']                        = 'Voornaam';
  $field['choices']['fw_geboortedatum']                   = 'Geboortedatum';
  $field['choices']['fw_woonadres_postcode']              = 'Postcode';
  $field['choices']['fw_woonadres_plaats']                = 'Plaats';
  $field['choices']['fw_woonadres_straat']                = 'Adres';
  $field['choices']['fw_woonadres_huisnummer']            = 'Huisnummer';
  $field['choices']['fw_woonadres_huisnummer_toevoeging'] = 'Huisnummer toevoeging';
  $field['choices']['fw_woonadres_land_code']             = 'Land';
  return $field;
}
add_filter('acf/load_field/name=_mw_easyflexbridge_account_shortcode_information', '_mw_easyflexbridge_mapping_account_information');

function _mw_easyflexbridge_mapping_account_apply( $field ) {
  // reset choices
  $field['choices'] = array();
  $field['choices']['wm_inschrijving_geslacht']         = 'Geslacht';
  $field['choices']['wm_inschrijving_burgerlijkestaat'] = 'Burgerlijke staat';
  $field['choices']['wm_inschrijving_voorletters']      = 'Voorletters';
  $field['choices']['wm_inschrijving_roepnaam']         = 'Roepnaam';
  $field['choices']['wm_inschrijving_voorvoegsels']     = 'Voorvoegsels';
  $field['choices']['wm_inschrijving_achternaam']       = 'Achternaam';
  $field['choices']['wm_inschrijving_adres']            = 'Adres';
  $field['choices']['wm_inschrijving_huisnummer']       = 'Huisnummer';
  $field['choices']['wm_inschrijving_huisnummer_tvg']   = 'Huisnummer toevoeging';
  $field['choices']['wm_inschrijving_postcode']         = 'Postcode';
  $field['choices']['wm_inschrijving_plaats']           = 'Plaats';
  $field['choices']['wm_inschrijving_landcode']         = 'Land';
  $field['choices']['wm_inschrijving_geboortedatum']    = 'Geboortedatum';
  $field['choices']['wm_inschrijving_email']            = 'Email';
  $field['choices']['wm_inschrijving_telefoon']         = 'Telefoon';
  $field['choices']['wm_inschrijving_mobiel']           = 'Mobiel';

  $field['choices']['wm_inschrijving_rijbewijs_a1']     = 'Bezit rijbewijs a1 (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_a2']     = 'Bezit rijbewijs a2 (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_b']      = 'Bezit rijbewijs b (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_c']      = 'Bezit rijbewijs c (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_d']      = 'Bezit rijbewijs d (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_eb']     = 'Bezit rijbewijs eb (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_ec']     = 'Bezit rijbewijs ec (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_ed']     = 'Bezit rijbewijs ed (ja/nee)';
  $field['choices']['wm_inschrijving_rijbewijs_am']     = 'Bezit rijbewijs am (ja/nee)';

  $field['choices']['wm_inschrijving_cv']               = 'CV';
  $field['choices']['wm_inschrijving_foto']             = 'Foto';
  $field['choices']['wm_inschrijving_opmerking']        = 'Opmerkingen';


  return $field;
}
add_filter('acf/load_field/name=_mw_easyflexbridge_account_shortcode_apply', '_mw_easyflexbridge_mapping_account_apply');


function _mw_easyflexbridge_trigger() {
    $screen = get_current_screen();
    $key    = get_field('_mw_easyflexbridge_key','options');
    if (strpos($screen->id, "easyflexbridge_general_settings") == true && $key!='') {
      exec('nohup wget -qO- '._EASYFLEXBRIDGE_URL.'hooks/cron/sync.php > /dev/null &');
    }
}
add_action('acf/save_post', '_mw_easyflexbridge_trigger', 20);
?>
