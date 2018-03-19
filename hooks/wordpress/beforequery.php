<?php
function _mw_easyflexbridge_plugin_adjust_query( $query ){
    if ( is_post_type_archive('easyflex_vacatures') && !empty( $query->query['post_type']  == 'easyflex_vacatures' )) {
      if ( ! is_admin() && $query->is_main_query() && ! $query->get( 'cat' ) ) {

        $obj_filters = new easyflexbridge_filter_vacatures;
        $get_filters = $_GET;

        if($obj_filters->filters['fields'] && $get_filters){
          $filter_arrays = array('relation' => 'AND');
          foreach($get_filters as $filter_key => $filter_value){
            if($filter_value!=''){
              if($filter_key=='Naam'){
                $field_key    = 'wm_vacature_functie';
                $field_value  = urldecode($filter_value);
                $filter_array = array(
                    'key'     => $field_key,
                    'value'   => $field_value,
                    'compare' => 'LIKE'
                );
              } else {
                $filter_array = array(
                    'key'     => $obj_filters->filters['fields']["{$filter_key}"]['field'],
                    'value'   => array(urldecode($filter_value)),
                    'compare' => 'IN'
                );
              }
              array_push($filter_arrays,$filter_array);
            }
          }
          $query->set('meta_query' ,  $filter_arrays);
          remove_all_actions ( '__after_loop');
        }
      }
    }
    //print_r($filter_key);
}
add_action('pre_get_posts','_mw_easyflexbridge_plugin_adjust_query');
?>
