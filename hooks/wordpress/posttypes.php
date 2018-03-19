<?php
function _mw_easyflexbridge_register_vacatures() {
  $standard_menu_name           = 'Vacatures';
  $standard_menu_name_single    = 'Vacature';
  $standard_menu_name_multiple  = 'Vacatures';
  $standard_posttype_base       = 'vacatures';
  $standard_post_editable       = 'nee';

  $options_menu_name            = get_field('_mw_easyflexbridge_vacatures_menu_name','option');
  $options_menu_name_single     = get_field('_mw_easyflexbridge_vacatures_menu_name_single','option');
  $options_menu_name_multiple   = get_field('_mw_easyflexbridge_vacatures_menu_name_multiple','option');
  $options_posttype_base        = get_field('_mw_easyflexbridge_vacatures_posttype_base','option');
  $options_post_editable        = get_field('_mw_easyflexbridge_vacatures_post_editable','option');


  $menu_name                    = $options_menu_name?$options_menu_name:$standard_menu_name;
  $menu_name_single             = $options_menu_name_single?$options_menu_name_single:$standard_menu_name_single;
  $menu_name_single_lc          = strtolower($menu_name_single);
  $menu_name_multiple           = $options_menu_name_multiple?$options_menu_name_multiple:$standard_menu_name_multiple;
  $menu_name_multiple_lc        = strtolower($menu_name_multiple);
  $posttype_base                = $options_posttype_base?strtolower($options_posttype_base):$standard_posttype_base;
  $post_editable                = $options_post_editable?$options_post_editable:$standard_post_editable;

  $aLabels = array(
    'menu_name'             => $menu_name,
    'name'                  => $menu_name_multiple.' overzicht',
    'singular_name'         => $menu_name_single,
    'add_new'               => 'Nieuwe '.$menu_name_single_lc,
    'add_new_item'          => 'Voeg '.$menu_name_single_lc.' toe',
    'edit_item'             => 'Bewerk '.$menu_name_single_lc,
    'new_item'              => 'Nieuwe '.$menu_name_single_lc,
    'view_item'             => 'Bekijk '.$menu_name_single_lc,
    'all_items'             => 'Alle '.$menu_name_multiple_lc,
    'search_items'          => 'Zoek '.$menu_name_multiple_lc,
    'not_found'             => 'Geen '.$menu_name_multiple_lc.' gevonden',
    'not_found_in_trash'    => 'Geen '.$menu_name_multiple_lc.' gevonden in prullenbak'
  );
  $aArgs = array(
      'labels'              => $aLabels,
      'hierarchical'        => true,
      'description'         => $menu_name_multiple.' overzicht',
      'supports'            => array( 'title','editor','excerpt' ),
      'public'              => true,
      'show_ui'             => true,
      'menu_position'       => 2,
      'menu_icon'           => 'dashicons-cloud',
      'show_in_nav_menus'   => true,
      'publicly_queryable'  => true,
      'exclude_from_search' => false,
      'has_archive'         => true,
      'query_var'           => true,
      'can_export'          => true,
      'capability_type'     => 'post',
      'map_meta_cap'        => true,
      'rewrite' => array('slug' => $posttype_base)
  );
  if($post_editable == 'nee'){
    $aArgs['capabilities']['create_posts'] = 'do_not_allow';
  }
  register_post_type( 'easyflex_vacatures', $aArgs );
  flush_rewrite_rules();
}
add_action( 'init', '_mw_easyflexbridge_register_vacatures' );
?>
