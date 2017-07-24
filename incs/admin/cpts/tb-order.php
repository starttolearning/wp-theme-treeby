<?php

/**
 * ================================
 *     Treeby Corp CPT - Orders
 * ================================
 */

/* ORDER CPT */
function tbc_cpt_order(){
    $labels = array(
        'name'                  => __('全部订单', 'awesome'),
        'singular'              => __('订单', 'awesome'),
        'menu_name'             => __('全部订单', 'awesome'),
        'name_admin_bar'        => __('订单', 'awesome'),
        'add_new'               => __('开单', 'awesome'),
        'add_new_item'          => __('新增订单', 'awesome'),
        'edit_item'             => __('编辑订单', 'awesome'),
        'new_item'              => __('新增订单', 'awesome'),
        'view_item'             => __('查看订单', 'awesome'),
        'view_items'            => __('查看所有订单', 'awesome'),
        'search_items'          => __('搜索订单', 'awesome'),
        'not_found'             => __('查无此订单', 'awesome'),
        'not_found_in_trash'    => __('无订单', 'awesome'),
        'parent_item_colon'     => __('订单', 'awesome'),
        'all_items'             => __('订单', 'awesome'),
        'archives'              => __('订单存档', 'awesome'),
        'insert_into_item'      => __('插入成品图', 'awesome'),
        'uploaded_to_this_item' => __('上传成品图','awesome'),
        'featured_image'        => __('订单成品图', 'awesome'),
        'set_featured_image'    => __('选择成品图', 'awesome'),
        'remove_featured_image' => __('删除成品图', 'awesome'),
        'use_featured_image'    => __('使用成品图', 'awesome'),
        'filter_items_list'     => __('筛选订单','awesome'),
        'items_list_navigation' => __('订单列表导航','awesome'),
        'items_list'            => __('订单列表', 'awesome'),
    );
    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => 'edit.php?post_type=resume',
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'supports'          => array('title','author', 'thumbnail'),
        'menu_icon'         =>'dashicons-email-alt',
        
    );
    register_post_type('tb-order', $args);
}
add_action('init', 'tbc_cpt_order');

// Custom columns adding and define
function tb_set_order_columns( $columns){
    $new_columns = array(
        'cb'            => '<input type="checkbox" />',
        'title'         => '订单号',
        'customer'      => '客户姓名',
        'qq'            => '联系QQ',
        'order_type'    => '订单类型',
        'order_status'  => '状态',
        'order_note'    => '备注',
        'date'          => '时间',
    );
    return $new_columns;
}
add_filter( 'manage_tb-order_posts_columns','tb_set_order_columns' );

// Gather information for custom columns
function tb_order_custom_column( $columns, $post_id ){
    $order_info_data = get_post_meta( $post_id, '_order_info_data', true );
    switch ($columns){
        case 'customer':
            echo $order_info_data['order_customer'];
            break;
        case 'qq':
            echo $order_info_data['order_qq'];
            break;
        case 'order_type':
            echo $order_info_data['order_type'];
            break;
        case 'order_status':
            $order_status = (int)$order_info_data['order_status'];
            $order_status_text = array( 
                    '-1' => '等待处理',
                    '0' => '订单已提交',
                    '1' => '安排设计师设计',
                    '2' => '初稿已完成',
                    '3' => '确定制作',
                    '4' => '制作完成',
                    '5' => '等待安装',
                    '6' => '已安装',
                    '7' => '等待评价',
                    '8' => '订单完成',
                );
            echo $order_status_text[$order_status];
            break;
        case 'order_note':
            echo $order_info_data['order_note'];
            break;
    }
}
add_action('manage_tb-order_posts_custom_column','tb_order_custom_column',10, 2);


/* order META BOX*/
function tb_order_add_meta_box(){
    add_meta_box('order_type_meta_box', '订单属性', 'tb_order_type_meta_callback', 'tb-order','normal', 'high');
    add_meta_box('order_comment_meta_box', '订单评价(<i>来自顾客不能修改</i>)', 'tb_order_comment_meta_callback', 'tb-order','normal', 'high');
}
add_action('add_meta_boxes','tb_order_add_meta_box');

// Callback function for order comment mata
function tb_order_comment_meta_callback( $post ){
    // 评价的项目有： 设计师评分、 设计水平、 质量服务、送货和安装服务、自定义评价内容（可以增加图文信息）
    wp_nonce_field('tb_order_save_comment_data', 'tb_order_comment_meta_box_nonce');
    $comment_data = get_post_meta($post->ID, '_order_comment_data',true);
    if( !is_array($comment_data) ){
        $comment_data = array(
            'designer_score' => 0, 
            'designing_score' => 0,
            'service_score' => 0,
            'delivery_install' => 0,
            'user_message' => ""
        );
    }
    ?>
    <table class="form-table">
        <!-- Column: tb_order_comment_designer_score -->
        <tr>
            <th scope="row">
                <label for="tb_order_comment_designer_score">设计师评分</label>
            </th>
            <td>
            <input name="tb_order_comment_designer_score" type="hidden" value="<?php echo $comment_data['designer_score']; ?>" >
            <?php for ($i=0; $i < $comment_data['designer_score']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-color.png'; ?>">
            <?php } ?>
            <?php for ($i=0; $i <10 - $comment_data['designer_score']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-grey.png'; ?>">
            <?php } ?>
            </td>
        </tr>
        
        <!-- Column: tb_order_comment_designing_score -->
        <tr>
            <th scope="row">
                <label for="tb_order_comment_designing_score">设计评分</label>
            </th>
            <td>
            <input name="tb_order_comment_designing_score" type="hidden" value="<?php echo $comment_data['designing_score']; ?>" >
            <?php for ($i=0; $i < $comment_data['designing_score']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-color.png'; ?>">
            <?php } ?>
            <?php for ($i=0; $i <10 - $comment_data['designing_score']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-grey.png'; ?>">
            <?php } ?>
            </td>
        </tr>

        <!-- Column: tb_order_comment_service_score -->
        <tr>
            <th scope="row">
                <label for="tb_order_comment_service_score">质量服务</label>
            </th>
            <td>
            <input name="tb_order_comment_service_score" type="hidden" value="<?php echo $comment_data['service_score']; ?>" >
            <?php for ($i=0; $i < $comment_data['service_score']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-color.png'; ?>">
            <?php } ?>
            <?php for ($i=0; $i <10 - $comment_data['service_score']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-grey.png'; ?>">
            <?php } ?>
            </td>
        </tr>

        <!-- Column: tb_order_comment_delivery_install_score -->
        <tr>
            <th scope="row">
                <label for="tb_order_comment_delivery_install_score">送货和安装服务</label>
            </th>
            <td>
            <input name="tb_order_comment_delivery_install_score" type="hidden" value="<?php echo $comment_data['delivery_install']; ?>" >
            <?php for ($i=0; $i < $comment_data['delivery_install']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-color.png'; ?>">
            <?php } ?>
            <?php for ($i=0; $i <10 - $comment_data['delivery_install']; $i++) { ?>
                <img src="<?php echo  get_template_directory_uri().'/assets/images/start-grey.png'; ?>">
            <?php } ?>
            </td>
        </tr>

        <!-- Column: tb_order_comment_message -->
        <tr>
            <th scope="row">用户评价</th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span>用户评价</span></legend>
                    <p>
                        <label for="tb_order_comment_message"><i>好的自我描述能够让更多的人认识你，也能够更好的为我们的用户提供优质的服务。</i></label>
                    </p>
                    <p>
                        <textarea name="tb_order_comment_message" rows="5" cols="30" id="tb_order_comment_message" class="large-text"><?php echo $comment_data['user_message']; ?></textarea>
                    </p>
                </fieldset>
            </td>
        </tr>

    </table>

    <?php

}

// Callback function for order type matabox
function tb_order_type_meta_callback( $post ){
    wp_nonce_field('tb_order_save_email_data', 'tb_order_email_meta_box_nonce');

    $order_info = get_post_meta($post->ID, '_order_info_data', true);

    if( !is_array( $order_info )){
        $order_info = array(
            'order_resume_id'   => '',
            'order_customer'    => '',
            'order_email'       => '',
            'order_qq'          => '',
            'order_type'        => '',
            'order_price'       => '',
            'order_status'      => -1,
            'order_note'        => ''
        );
    }

    ?>
    <table class="form-table">
        <!-- Column: tb_order_email_filed -->
        <tr>
            <th scope="row">
                <label for="tb_order_customer_filed">客户姓名</label>
            </th>
            <td>
                <input name="tb_order_customer_filed" type="text" id="tb_order_customer_filed" value="<?php echo $order_info['order_customer']; ?>" class="regular-text">
            </td>
        </tr>

        <!-- Column: tb_order_email_filed -->
        <tr>
            <th scope="row">
                <label for="tb_order_email_filed">用户邮箱</label>
            </th>
            <td>
                <input name="tb_order_email_filed" type="text" id="tb_order_email_filed" value="<?php echo $order_info['order_email']; ?>" class="regular-text">
            </td>
        </tr>

        <!-- Column: tb_order_qq_filed -->
        <tr>
            <th scope="row">
                <label for="tb_order_qq_filed">用户QQ</label>
            </th>
            <td>
                <input name="tb_order_qq_filed" type="text" id="tb_order_qq_filed" value="<?php echo $order_info['order_qq']; ?>" class="regular-text">
            </td>
        </tr>

        <!-- Column: tb_order_id_filed -->
        <tr>
            <th scope="row">
                <label for="tb_order_id_filed">模板ID</label>
            </th>
            <td>
                <input name="tb_order_id_filed" type="text" id="tb_order_id_filed" value="<?php echo $order_info['order_resume_id']; ?>" class="regular-text">
            </td>
        </tr>
        
        <!-- Column: tb_order_type_filed -->
        <tr>
            <th scope="row">
                <label for="tb_order_type_filed">产品类型</label>
            </th>
            <td>
                <input name="tb_order_type_filed" type="text" id="tb_order_type_filed" value="<?php echo $order_info['order_type']; ?>" class="regular-text">
            </td>
        </tr>

        <!-- Column: tb_order_price_filed -->
        <tr>
            <th scope="row">
                <label for="tb_order_price_filed">预计价格</label>
            </th>
            <td>
                <input name="tb_order_price_filed" type="text" id="tb_order_price_filed" value="<?php echo $order_info['order_price']; ?>" placeholder="0.00 元" class="regular-text">
            </td>
        </tr>

        <!-- Column: tb_order_status_filed -->
        <tr>
        <th scope="row"><label for="tb_order_status_filed">状态跟踪</label></th>
        <td>
            <select name="tb_order_status_filed" id="tb_order_status_filed">
                <?php $order_status = $order_info['order_status']; ?>
                <option value="-1" <?php selected( $order_status, -1 ); ?> >等待处理</option>
                <option value="0" <?php selected( $order_status, 0 ); ?> >订单已提交</option>
                <option value="1" <?php selected( $order_status, 1 ); ?>>安排设计师设计</option>
                <option value="2" <?php selected( $order_status, 2 ); ?>>初稿已完成</option>
                <option value="3" <?php selected( $order_status, 3 ); ?>>确定制作</option>
                <option value="4" <?php selected( $order_status, 4 ); ?>>制作完成</option>
                <option value="5" <?php selected( $order_status, 5 ); ?>>等待安装</option>
                <option value="6" <?php selected( $order_status, 6 ); ?>>已安装</option>
                <option value="7" <?php selected( $order_status, 7 ); ?>>等待评价</option>
                <option value="8" <?php selected( $order_status, 8 ); ?>>订单完成</option>
            </select></td>
        </tr>

        <!-- Column: tb_order_note_filed -->
        <tr>
            <th scope="row">订单备注</th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span>用户评价</span></legend>
                    <p>
                        <textarea name="tb_order_note_filed" rows="5" cols="30" id="tb_order_note_filed" class="large-text"><?php echo $order_info['order_note']; ?></textarea>
                    </p>
                </fieldset>
            </td>
        </tr>

    </table> <!-- form-table -->
    <?php
}

// Processing the order sava data
function tb_order_save_data( $post_id ){
    
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
    
    // order information
    $tb_order_email = isset($_POST['tb_order_email_filed']) ? sanitize_text_field($_POST['tb_order_email_filed']) : '';
    $tb_order_customer = isset($_POST['tb_order_customer_filed']) ? sanitize_text_field($_POST['tb_order_customer_filed']) : '';
    $tb_order_qq = isset($_POST['tb_order_qq_filed']) ? sanitize_text_field($_POST['tb_order_qq_filed']) : '';
    $tb_resume_id = isset($_POST['tb_order_id_filed']) ? sanitize_text_field($_POST['tb_order_id_filed']) : '';
    $tb_order_type = isset($_POST['tb_order_type_filed']) ? sanitize_text_field($_POST['tb_order_type_filed']) :'';
    $tb_order_price = isset($_POST['tb_order_price_filed']) ? sanitize_text_field($_POST['tb_order_price_filed']) : '';
    $tb_order_status = isset($_POST['tb_order_status_filed']) ? (double)sanitize_text_field($_POST['tb_order_status_filed']) : 0.00;
    $tb_order_note = isset($_POST['tb_order_note_filed']) ? sanitize_text_field($_POST['tb_order_note_filed']) : '';

    // comment data collection
    $designer_score = isset($_POST['tb_order_comment_designer_score']) ? (int)sanitize_text_field($_POST['tb_order_comment_designer_score']) : 0;
    $designing_score = isset($_POST['tb_order_comment_designing_score']) ? (int)sanitize_text_field($_POST['tb_order_comment_designing_score']) : 0;
    $service_score = isset($_POST['tb_order_comment_service_score']) ? (int)sanitize_text_field($_POST['tb_order_comment_service_score']) : 0;
    $delivery_install = isset($_POST['tb_order_comment_delivery_install_score']) ? (int)sanitize_text_field($_POST['tb_order_comment_delivery_install_score']) : 0;
    $user_message = isset($_POST['tb_order_comment_message']) ? sanitize_textarea_field($_POST['tb_order_comment_message']) : "";

    $order_info = array(
            'order_resume_id'   => $tb_resume_id,
            'order_customer'    => $tb_order_customer,
            'order_email'       => $tb_order_email,
            'order_qq'          => $tb_order_qq,
            'order_type'        => $tb_order_type,
            'order_price'       => $tb_order_price,
            'order_status'      => $tb_order_status,
            'order_note'        => $tb_order_note
        );

    $comment_data = array(
            'designer_score' => $designer_score, 
            'designing_score' => $designing_score,
            'service_score' => $service_score,
            'delivery_install' => $delivery_install,
            'user_message' => $user_message
        );

    update_post_meta($post_id, '_order_info_data', $order_info);

    update_post_meta($post_id, '_order_comment_data', $comment_data);
}
add_action('save_post','tb_order_save_data');

// The helper to change the text visually in the title column
add_filter('gettext', 'change_admin_cpt_order_text_filter', 20, 3);
/*
 * Change the text in the admin for my custom post type
 * 
**/
function change_admin_cpt_order_text_filter( $translated_text, $untranslated_text, $domain ) {

  global $typenow;

  // var_dump( $untranslated_text );
  if( is_admin() && 'tb-order' == $typenow )  {

    //make the changes to the text
    switch( $untranslated_text ) {

        case 'Featured Image':
          $translated_text = __( '设计样图','awesome' );
        break;

        case 'Enter title here':
          $translated_text = __( '请输入订单号','awesome' );
        break;

        case 'Author':
          $translated_text = __( '订单负责人','awesome' );
        break;
        //add more items
     }
   }
   return $translated_text;
}
