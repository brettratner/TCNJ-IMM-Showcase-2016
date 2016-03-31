<?php
function high_priority_egrid_style() {
    wp_register_style('egrid_css', plugins_url('/assets/css/elastic_grid.css', __FILE__));
    wp_enqueue_style('egrid_css');
}
add_action('wp_enqueue_scripts', 'high_priority_egrid_style', '999');
/*---------------------------------
* Shortcode
*---------------------------------*/
function wp_elastic_grid_shortcode($atts, $content=null)
{
    $pluginURL   = plugins_url('wp_elastic_grid');

    //register JS
    wp_register_script('modernizr_custom', $pluginURL.'/assets/js/modernizr.custom.js', array('jquery'), '2.0', true );
    // wp_localize_script('modernizr_custom', 'wpQuiz', array( 'pluginURL' => $pluginURL, 'ajaxURL' => admin_url( 'admin-ajax.php' )));
    wp_enqueue_script('modernizr_custom');

    wp_register_script('classie', $pluginURL.'/assets/js/classie.js', array('jquery'), '2.0', true );
    wp_enqueue_script('classie');

    wp_register_script('slimscroll', $pluginURL.'/assets/js/jquery.slimscroll.min.js', array('jquery'), '2.0', true );
    wp_enqueue_script('slimscroll');

    // wp_register_script('hoverdir', $pluginURL.'/assets/js/jquery.hoverdir.js', array('jquery'), '2.0', true );
    // wp_enqueue_script('hoverdir');

    // wp_register_script('elastislide', $pluginURL.'/assets/js/jquery.elastislide.js', array('jquery'), '2.0', true );
    // wp_enqueue_script('elastislide');

    // wp_register_script('elastic_grid', $pluginURL.'/assets/js/elastic_grid.js', array('jquery', 'hoverdir', 'elastislide'), '2.0', true );
    // wp_enqueue_script('elastic_grid');

    wp_register_script('elastic_grid', $pluginURL.'/assets/js/elastic_grid.min.js', array('jquery'), '2.0', true );
    wp_enqueue_script('elastic_grid');

    $egrid_id = $atts['id'];
    wp_enqueue_script('egrid_'.$egrid_id, admin_url( 'admin-ajax.php' )."?action=load_egrid_json&egrid_id=".$egrid_id, array('jquery'), '2.0', true);
    return '<div id="egrid-'.$egrid_id.'"></div>';
}
add_shortcode('wp_elastic_grid', 'wp_elastic_grid_shortcode');


?>