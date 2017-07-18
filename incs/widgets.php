<?php

/**
 * ================================
 *     TREEBY WIDGETS SETTINGS
 * ================================
 */

/*
	========================================
	Sidebar Function
	========================================
*/
function awesome_widget_setup(){
    register_sidebar( array(
        'name' 			=> __('Sidebar','awesome'),
        'id' 			=> 'sidebar-1',
        'class' 		=> 'custom',
        'description'	=> 'Standard Sidebar',
        'before_widget' => '<aside id="%1$s" class="panel panel-info widget %2$s">',
        'after_widget' 	=> "</aside>",
        'before_title' 	=> '<div class="panel-heading">',
        'after_title' 	=> "</div>",
    ) );
}
add_action( 'widgets_init', 'awesome_widget_setup' );
