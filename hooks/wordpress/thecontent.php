<?php
function _mw_easyflexbridge_plugin_after_content( $content ) {
    if( is_single() && is_singular('easyflex_vacatures') ) {
        $content .= do_shortcode('[easyflexbridge widget="vacatureapply"]');
    }
    return $content;
}
//add_filter( 'the_content', '_mw_easyflexbridge_plugin_after_content' );
?>
