<?php

/**
 * ================================
 *     Treeby Corp CPT - Orders
 * ================================
 */


/* ORDER CPT */
function tbc_cpt_order(){
    $labels = array(
        'name'          => '全部订单',
        'singular'      => '订单',
        'menu_name'     => '全部订单',
        'name_admin_bar'=> '订单',
    );
    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => 'edit.php?post_type=resume',
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'supports'          => array('title','editor','author'),
        'menu_icon'         =>'dashicons-email-alt',
        
    );
    register_post_type('tb-order', $args);
}
add_action('init', 'tbc_cpt_order');

function tb_set_order_columns( $columns){
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'title'     => '用户名',
        'message'   => '订单内容',
        'qq'        => '联系QQ',
//        'email'     => '邮件地址',
        'resume_id' => '简历ID',
        'date'      => '时间',
    );
    return $new_columns;
}
add_filter( 'manage_tb-order_posts_columns','tb_set_order_columns' );

function tb_order_custom_column( $columns, $post_id ){
    switch ($columns){
        case 'message':
            echo get_the_excerpt();
            break;
//        case 'email':
//            $email = get_post_meta($post_id, '_order_email_value_key',true);
//            echo '<a href="mailto:'.$email.'">'.$email.'</a>';
//            break;
        case 'qq':
            $qq = get_post_meta($post_id, '_order_qq_value_key',true);
            echo '<p>'.$qq.'</p>';
            break;
        case 'resume_id':
            $resume_id = get_post_meta($post_id, '_order_id_value_key',true);
            echo '<p>'.$resume_id.'</p>';
            break;
    }
}
add_action('manage_tb-order_posts_custom_column','tb_order_custom_column',10, 2);


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
