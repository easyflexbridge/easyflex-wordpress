<?php
function register_easyflex_taxonomy() {

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
      'name' => $menu_name.' categorie', 'taxonomy general name',
      'singular_name' => $menu_name_single.' categorie', 'taxonomy singular name',
      'search_items' =>  'Search '.$menu_name_single_lc.' categorie',
      'all_items' => 'All '.$menu_name_multiple_lc.' categorie',
      'parent_item' => 'Parent '.$menu_name_single_lc.' categorie',
      'parent_item_colon' => 'Parent '.$menu_name_single_lc.' categorie:',
      'edit_item' => 'Edit '.$menu_name_single_lc.' categorie',
      'update_item' => 'Update '.$menu_name_single_lc.' categorie',
      'add_new_item' => 'Add New '.$menu_name_single_lc.' categorie',
      'new_item_name' => 'New '.$menu_name_single_lc.' categorie name',
      'menu_name' => $menu_name_single.' categorie',
  );
  $aArgs = array(
      'hierarchical' => true,
      'labels' => $aLabels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => $menu_name_single_lc.'categorie' ),
  );
  register_taxonomy('easyflex_cat', 'easyflex_vacatures', $aArgs);
}
//add_action( 'init', 'register_easyflex_taxonomy' );
?>
