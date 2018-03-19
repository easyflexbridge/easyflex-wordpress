<?php
Class easyflexbridge_searchbar_vacatures {

  public $searchbar         = false;

  function __construct(){
    $this->searchbar         = self::get_searchbar_options();
  }

  private function get_searchbar_options(){
    $searchbar_selection     = get_field('_mw_easyflexbride_vacatures_searchbar_items','option');
    $searchbar_params        = false;
    if($searchbar_selection && is_array($searchbar_selection)){
      $searchbar_params  = array();
      foreach($searchbar_selection as $searchbar_key => $searchbar_values){
        $searchbar_mapping_url                   = urlencode($searchbar_values['label']);
        $searchbar_params[$searchbar_mapping_url]   = array('label'=>$searchbar_values['label'], 'field'=>$searchbar_values['value'], 'param'=>$searchbar_mapping_url);
      }
    }
    if($searchbar_params){
      // Get keys of all fields
      $searchbar_args     = array(
        'post_type'       => 'easyflex_vacatures',
        'post_status'     => array('publish'), // let's look in every corner but trash -- 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'
        'posts_per_page'	=> -1
      );
      $searchbar_posts = new WP_Query( $searchbar_args );
      if( $searchbar_posts->have_posts() ){
        $count = 0;
        while( $searchbar_posts->have_posts() ) :
          $count++;
          $searchbar_posts->the_post();
          $searchbar_post_id = get_the_ID();
          foreach($searchbar_params as $searchbar_params_url => $searchbar_params_array){
            if(get_field($searchbar_params_array['field'],$searchbar_post_id)!=''){
              $searchbar_option = get_field($searchbar_params_array['field'],$searchbar_post_id);
              $searchbar_key    = urlencode($searchbar_option);
              $searchbar_params[$searchbar_params_url]['options'][$searchbar_key]['label']  = $searchbar_option;
              $searchbar_params[$searchbar_params_url]['options'][$searchbar_key]['url']    = $searchbar_key;
              $searchbar_params[$searchbar_params_url]['options'][$searchbar_key]['count']  = (isset($searchbar_params[$searchbar_params_url]['options'][$searchbar_key])?$searchbar_params[$searchbar_params_url]['options'][$searchbar_key]['count']+1:1);
            }
          }
        endwhile;
      }
    }

    if($count){
      return array('count' => $count,'fields' => $searchbar_params );
    } else {
      return false;
    }

  }
}
?>
