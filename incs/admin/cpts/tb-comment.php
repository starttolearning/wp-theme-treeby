<?php 
/**
 * ================================
 *     Treeby Corp CPT - comments
 * ================================
 */

/* COMMENT  CPT: Gather the users voices */
function tbc_cpt_comment(){
    $labels = array(
        'name'                  => '全部评价',
        'singular'              => '用户评价',
        'add_new'               => __('添加设计师', 'awesome'),
        'add_new_item'          => __('添加设计师', 'awesome'),
        'edit_item'             => __('编辑当前设计师', 'awesome'),
        'new_item'              => __('添加设计师', 'awesome'),
        'view_item'             => __('查看设计师', 'awesome'),
        'view_items'            => __('查看所有设计师', 'awesome'),
        'search_items'          => __('搜索设计师', 'awesome'),
        'not_found'             => __('没有任何评论', 'awesome'),
        'not_found_in_trash'    => __('无设计师', 'awesome'),
        'parent_item_colon'     => __('设计总监', 'awesome'),
        'all_items'             => __('评价管理', 'awesome'),
        'archives'              => __('设计师存档', 'awesome'),
        'insert_into_item'      => __('插入多媒体', 'awesome'),
        'uploaded_to_this_item' => __('上传多媒体','awesome'),
        'featured_image'        => __('设计师头像', 'awesome'),
        'set_featured_image'    => __('上传设计师头像', 'awesome'),
        'remove_featured_image' => __('删除设计师头像', 'awesome'),
        'use_featured_image'    => __('使用设计师头像', 'awesome'),
        'menu_name'             => __('设计师', 'awesome'),
        'filter_items_list'     => __('筛选设计师','awesome'),
        'items_list_navigation' => __('设计师列表导航','awesome'),
        'items_list'            => __('设计师列表', 'awesome'),
    );
    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => 'edit.php?post_type=resume',
        // 'capability_type'   => array('comment','comments'),
        // 'capabilities'      =>array('read'),
        'hierarchical'      => false,
        'supports'          => array('title','author'),
        'menu_icon'         =>'dashicons-testimonial',
        
    );
    register_post_type('tb-comment', $args);
}
add_action('init', 'tbc_cpt_comment');

// Set the custom columns show to the back-end user
function tb_set_comment_columns( $columns){
    $new_columns = array(
        'cb'	 			=> '<input type="checkbox" />',
        'title'     		=> '订单号',
        'person_in_charge'	=> '订单负责人',
        'designer_score' 	=> '设计师评分',
        'designing_score' 	=> '设计水平',
        'service_score' 	=> '质量服务',
        'delivery_install' 	=> '送货和安装服务',
        'message'   		=> '评价内容',
        'date'      		=> '评价时间',
    );
    return $new_columns;
}
add_filter( 'manage_tb-comment_posts_columns','tb_set_comment_columns' );

/**
 * Processing each column define int the [tb_set_comment_columns]
 * functions.
 * @param  Array 	$columns 	An array with the infomation about the whole columns
 * @param  int 		$post_id 	The request post_id generated ramdomly
 * @return [type]          [description]
 */
function tb_comment_custom_column( $columns, $post_id ){
    switch ($columns){
        case 'message':
            echo get_the_excerpt();
            break;
        case 'person_in_charge':
            $tb_person_in_charge = get_post_meta($post_id, '_order_qq_value_key',true);
            echo '<p>'.$qq.'</p>';
            break;
        case 'resume_id':
            $resume_id = get_post_meta($post_id, '_order_id_value_key',true);
            echo '<p>'.$resume_id.'</p>';
            break;
    }
}
add_action('manage_tb-comment_posts_custom_column','tb_comment_custom_column',10, 2);

