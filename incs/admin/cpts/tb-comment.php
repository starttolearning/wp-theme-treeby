<?php 
/**
 * ================================
 *     Treeby Corp CPT - comments
 * ================================
 */


/* COMMENT  CPT: Gather the users voices */
function tbc_cpt_comment(){
    $labels = array(
        'name'          => '全部评价',
        'singular'      => '用户评价',
        'menu_name'     => '评价',
        'name_admin_bar'=> '用户评价',
    );
    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => 'edit.php?post_type=user_comment',
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'supports'          => array('title','editor','author'),
        'menu_icon'         =>'dashicons-testimonial',
        
    );
    register_post_type('tb-comment', $args);
}
add_action('init', 'tbc_cpt_comment');

// Set the custom columns show to the back-end user
function tb_set_comment_columns( $columns){
    $new_columns = array(
        'cb'	 			=> '<input type="checkbox" />',
        'title'     		=> '订单号码',
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


/* order META BOX*/
function tb_order_type_add_meta_box(){
    add_meta_box('order_type_meta_box', '用户订单属性', 'tb_order_type_meta_email_callback', 'tb-order','side');
}

function tb_order_type_meta_email_callback( $post ){
    wp_nonce_field('tb_order_save_email_data', 'tb_order_email_meta_box_nonce');
    
    $order_email_value = get_post_meta($post->ID, '_order_email_value_key',true);
    $order_qq_value = get_post_meta($post->ID, '_order_qq_value_key',true);
    $order_resume_id = get_post_meta($post->ID, '_order_id_value_key',true);

    // 用户邮箱
    echo '<label for="tb_order_email_filed">用户邮箱地址</label>';
    echo '<input type="email" id="tb_order_email_filed" name="tb_order_email_filed" value="'. esc_attr( $order_email_value).'" class="all-options" > ';

    // 用户QQ
    echo '<label for="tb_order_qq_filed">用户QQ</label>';
    echo '<input type="text" id="tb_order_qq_filed" name="tb_order_qq_filed" value="'. esc_attr( $order_qq_value).'" class="all-options" > ';

    //用户想要的模板ID
    echo '<label for="tb_order_id_filed">用户想要的模板ID</label>';
    echo '<input disabled type="text" id="tb_order_id_filed" name="tb_order_id_filed" value="'. esc_attr( $order_resume_id).'" class="all-options" > ';
}
add_action('add_meta_boxes','tb_order_type_add_meta_box');


function tb_order_save_email_data( $post_id ){
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
        if ( !isset($_POST['tb_order_email_meta_box_nonce']) || !wp_verify_nonce($_POST['tb_order_email_meta_box_nonce'], 'tb_order_save_email_data')) {
        return $post_id;
    }
    
    if( !current_user_can('edit_post', $post_id)){
        return;
    }
    
    if( !isset( $_POST['tb_order_email_filed'])){
        return;
    }

    if( !isset( $_POST['tb_order_qq_filed'])){
        return;
    }

    if( !isset( $_POST['tb_order_id_filed'])){
        return;
    }
    
    $my_data = sanitize_text_field($_POST['tb_order_email_filed']);
    $tb_order_qq = sanitize_text_field($_POST['tb_order_qq_filed']);
    $tb_resume_id = sanitize_text_field($_POST['tb_order_id_filed']);
    
    update_post_meta($post_id, '_order_email_value_key', $my_data);
    update_post_meta($post_id, '_order_qq_value_key', $tb_order_qq);
    update_post_meta($post_id, '_order_id_value_key', $tb_resume_id);

}
add_action('save_post','tb_order_save_email_data');
