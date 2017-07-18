<?php
/*
	========================================
	Include the styles and scripts
	========================================
*/
function awesome_scripts_enqueue(){

    wp_enqueue_style( 'awesomestyle', get_template_directory_uri().'/assets/css/style.css', array(), '1.0.0', 'all' );

    wp_enqueue_media();

    // wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'bootstrapjs', get_template_directory_uri().'/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
    wp_enqueue_script( 'awesomejs', get_template_directory_uri().'/assets/js/awesome.js', array( 'jquery' ), '1.0.0', true );
}

//  HOOKS: wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'awesome_scripts_enqueue', 10, 1 );