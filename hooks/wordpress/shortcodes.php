<?php
function _mw_easyflexbridge_widgets($atts, $content=null){
      // detect variable parts

      $website_url        = get_bloginfo('url');
      $posttype_base      = get_field('_mw_easyflexbridge_vacatures_posttype_base','option');
      $posttype_base      = ($posttype_base?$posttype_base:'vacatures');

      $onderdeel          = $atts['widget'];
      $post_id            = $atts['postid'];
      $post_id            = $post_id?$post_id:get_the_ID();
      $post_id            = $post_id?$post_id:false;

      // begin options here
	    ob_start();
      if($onderdeel == "vacaturefilter"){
        include_once( _EASYFLEXBRIDGE_DIR . 'templates/widget-vacaturefilter.php' );
      }
      if($onderdeel == "vacaturesearch"){
        include_once( _EASYFLEXBRIDGE_DIR . 'templates/widget-vacaturesearch.php' );
      }
      if($onderdeel == "vacatureapply"){
        include_once( _EASYFLEXBRIDGE_DIR . 'templates/widget-vacatureapply.php' );
      }
      if($onderdeel == "register"){
        include_once( _EASYFLEXBRIDGE_DIR . 'templates/widget-signup.php' );
      }
      if($onderdeel == "login"){
        include_once( _EASYFLEXBRIDGE_DIR . 'templates/widget-login.php' );
      }
      if($onderdeel == "account"){
        include_once( _EASYFLEXBRIDGE_DIR . 'templates/widget-account.php' );
      }
      // end content here
	    $ret = ob_get_contents();
	    ob_get_clean();
	    return $ret;
}
add_shortcode('easyflexbridge', '_mw_easyflexbridge_widgets');
add_filter('widget_text', 'do_shortcode');
?>
