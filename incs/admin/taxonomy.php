<?php

function tb_resume_tax_init() {
	register_taxonomy( 'tb_resume_tax', array( 'resume' ), array(
		'hierarchical'      => true,
                'sort'              => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
                'show_tagcloud'     => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'resume-tax'),
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( '分类目录', 'ts-child' ),
			'singular_name'              => _x( '分类目录', 'taxonomy general name', 'ts-child' ),
			'search_items'               => __( '搜索分类目录', 'ts-child' ),
			'popular_items'              => __( '最热分类目录', 'ts-child' ),
			'all_items'                  => __( '所有分类', 'ts-child' ),
			'parent_item'                => __( '父分类目录', 'ts-child' ),
			'parent_item_colon'          => __( '父分类目录:', 'ts-child' ),
			'edit_item'                  => __( '编辑分类目录', 'ts-child' ),
			'update_item'                => __( '更新分类目录', 'ts-child' ),
			'add_new_item'               => __( '新建分类目录', 'ts-child' ),
			'new_item_name'              => __( '新建分类目录', 'ts-child' ),
			'separate_items_with_commas' => __( '用逗号（,)隔开分类', 'ts-child' ),
			'add_or_remove_items'        => __( '添加或者移除', 'ts-child' ),
			'choose_from_most_used'      => __( '选择使用最多的目录', 'ts-child' ),
			'not_found'                  => __( '没有任何分类目录.', 'ts-child' ),
			'menu_name'                  => __( '分类目录', 'ts-child' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'tb-resume-tax',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'tb_resume_tax_init' );
