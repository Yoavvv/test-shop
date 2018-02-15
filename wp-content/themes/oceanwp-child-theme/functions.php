/*
Theme Name: OceanWP Child
Theme URI: https://oceanwp.org/
Description: OceanWP WordPress theme example child theme.
Author: Nick
Author URI: https://oceanwp.org/
Template: oceanwp
Version: 1.0
*/

/* Parent stylesheet should be loaded from functions.php not using @import */

<?php 

function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.min.css' );
    wp_enqueue_style( 'rtl-style', get_template_directory_uri().'/rtl.css' );

}

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
