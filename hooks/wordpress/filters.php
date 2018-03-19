<?php
Class easyflexbridge_filter_vacatures {

  public $filters         = false;

  function __construct(){
    $this->filters        = self::get_filter_options();
  }

  private function get_filter_options(){
    $filter_selection     = get_field('_mw_easyflexbride_vacatures_filter_items','option');
    $filter_params        = false;
    if($filter_selection && is_array($filter_selection)){
      $filter_params  = array();
      foreach($filter_selection as $filter_key => $filter_values){
        $filter_mapping_url                   = urlencode($filter_values['label']);
        $filter_params[$filter_mapping_url]   = array('label'=>$filter_values['label'], 'field'=>$filter_values['value'], 'param'=>$filter_mapping_url);
      }
    }
    if($filter_params){
      // Get keys of all fields
      $filter_args     = array(
        'post_type'       => 'easyflex_vacatures',
        'post_status'     => array('publish'), // let's look in every corner but trash -- 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'
        'posts_per_page'	=> -1
      );
      $filter_posts = new WP_Query( $filter_args );
      if( $filter_posts->have_posts() ){
        $count = 0;
        while( $filter_posts->have_posts() ) :
          $count++;
          $filter_posts->the_post();
          $filter_post_id = get_the_ID();
          foreach($filter_params as $filter_params_url => $filter_params_array){
            if(get_field($filter_params_array['field'],$filter_post_id)!=''){
              $filter_option = get_field($filter_params_array['field'],$filter_post_id);
              $filter_key    = urlencode($filter_option);
              $filter_params[$filter_params_url]['options'][$filter_key]['label']  = $filter_option;
              $filter_params[$filter_params_url]['options'][$filter_key]['url']    = $filter_key;
              $filter_params[$filter_params_url]['options'][$filter_key]['count']  = (isset($filter_params[$filter_params_url]['options'][$filter_key])?$filter_params[$filter_params_url]['options'][$filter_key]['count']+1:1);
            }
          }
        endwhile;
      }
    }

    if($count){
      return array('count' => $count,'fields' => $filter_params );
    } else {
      return false;
    }

  }
}
?>
