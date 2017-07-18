<?php
/**
 * ================================
 *     TREEBY AJAX REQUESTS
 * ================================
 */

/*
	========================================
	Acitivate menus
	========================================
*/
function awesome_theme_setup(){
    register_nav_menu( 'primary', '导航' );
    register_nav_menu( 'secondary', '副导航' );
}

add_action( 'init', 'awesome_theme_setup');

/*
	========================================
	Theme support functions
	========================================
*/
add_theme_support( 'menus' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array('aside','gallery') );
add_theme_support( 'custom-logo', array(
    'width'       => 100,
    'height'      => 120,
    'flex-width'  => true,
    'flex-height' => true,
) );


add_image_size( 'gallery-img', 720, 1280, true );

function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = 'd63164726316d6';
  $phpmailer->Password = '830cd3ed9056ac';
}

add_action('phpmailer_init', 'mailtrap');