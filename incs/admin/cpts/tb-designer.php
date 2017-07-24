<?php 

/**
 * ================================
 *     Treeby Corp CPT -- Designer
 * =============================*/

/**
 * function: tbc_cpt_resume
 * 新建CPT Resume
 * 初始化自定义文章类型的相关设置
 */
function tbc_cpt_designer() {
    register_post_type('designer', array(
        'labels' => array(
            'name'                  => __('设计师', 'awesome'),
            'singular_name'         => __('设计师', 'awesome'),
            'add_new'               => __('添加设计师', 'awesome'),
            'add_new_item'          => __('添加设计师', 'awesome'),
            'edit_item'             => __('编辑当前设计师', 'awesome'),
            'new_item'              => __('添加设计师', 'awesome'),
            'view_item'             => __('查看设计师', 'awesome'),
            'view_items'            => __('查看所有设计师', 'awesome'),
            'search_items'          => __('搜索设计师', 'awesome'),
            'not_found'             => __('查无此设计师', 'awesome'),
            'not_found_in_trash'    => __('无设计师', 'awesome'),
            'parent_item_colon'     => __('设计总监', 'awesome'),
            'all_items'             => __('设计师', 'awesome'),
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
        ),
        'description'               =>__('添加和管理公司设计人员的中心。','awesome'),
        'public'                    => true,
        'show_in_menu'              => 'edit.php?post_type=resume',
        'hierarchical'              => false,
        'publicly_queryable'        => false,
        'show_in_nav_menus'         => false,
        'show_in_admin_bar'         => false,
        'show_in_rest'              => true,
        'supports'                  => array('title', 'thumbnail'),
        'register_meta_box_cb'      => 'tb_mata_box_designer_settings'
    ));
}

add_action('init', 'tbc_cpt_designer');

/**
 * 添加简历模板属性
 */
function tb_mata_box_designer_settings() {
    add_meta_box('tb_designer_meta_box', __('个人基本信息', 'awesome'), 'tb_designer_properties', 'designer', 'normal');
}

add_action('add_meta_boxes', 'tb_mata_box_designer_settings');

/**
 * Markup for the designer's properties
 * @param  array $post 
 */
function tb_designer_properties($post) {
    wp_nonce_field(plugin_basename(__FILE__), 'tb_designer_meta_nonce');

    $designer_id = get_post_meta($post->ID, 'tb_designer_id', true);
    $designer_qq = get_post_meta($post->ID, 'tb_designer_qq', true);
    $designer_qqkey = get_post_meta($post->ID, 'tb_designer_qqkey', true);
    $designer_desc = get_post_meta($post->ID, 'tb_designer_desc', true);
    ?>
    <table class="form-table">
        <!-- Column: designer_id -->
        <tr>
            <th scope="row">
                <label for="tb_designer_id">员工ID</label>
            </th>
            <td>
                <input name="tb_designer_id" type="text" id="tb_designer_id" value="<?php echo $designer_id; ?>" class="regular-text">
            </td>
        </tr>
        
        <!-- Column: designer_qq -->
        <tr>
            <th scope="row">
                <label for="tb_designer_qq">员工服务 QQ</label>
            </th>
            <td>
                <input name="tb_designer_qq" type="text" id="tb_designer_qq" value="<?php echo $designer_qq; ?>" class="regular-text">
            </td>
        </tr>

        <!-- Column: designer_qqkey -->
        <tr>
            <th scope="row">
                <label for="tb_designer_qqkey">员工服务 QQ KEY</label>
            </th>
            <td>
                <input name="tb_designer_qqkey" type="text" id="tb_designer_qqkey" value="<?php echo $designer_qqkey; ?>" class="regular-text">
            </td>
        </tr>

        <!-- Column: designer_desc -->
        <tr>
            <th scope="row">自我介绍</th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text"><span>自我介绍</span></legend>
                    <p>
                        <label for="tb_designer_desc"><i>好的自我描述能够让更多的人认识你，也能够更好的为我们的用户提供优质的服务。</i></label>
                    </p>
                    <p>
                        <textarea name="tb_designer_desc" rows="10" cols="50" id="tb_designer_desc" class="large-text"><?php echo $designer_desc; ?></textarea>
                    </p>
                </fieldset>
            </td>
        </tr>
    </table> <!-- #end table -->
    <?php
}

function tb_designer_meta_box_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ( !isset($_POST['tb_designer_meta_nonce']) || !wp_verify_nonce($_POST['tb_designer_meta_nonce'], plugin_basename(__FILE__))) {
        return $post_id;
    }

    global $post;
    $post_type = get_post_type_object($post->post_type);
    if (!current_user_can($post_type->cap->edit_post, $post_id)) {
        return $post_id;
    }

    $meta_datas['tb_designer_id'] = (isset($_POST['tb_designer_id']) ? $_POST['tb_designer_id'] : '');
    $meta_datas['tb_designer_qq'] = (isset($_POST['tb_designer_qq']) ? $_POST['tb_designer_qq'] : '');
    $meta_datas['tb_designer_qqkey'] = (isset($_POST['tb_designer_qqkey']) ? $_POST['tb_designer_qqkey'] : '');
    $meta_datas['tb_designer_desc'] = (isset($_POST['tb_designer_desc']) ? $_POST['tb_designer_desc'] : '');

    foreach ($meta_datas as $key => $value) {
        $current_value = get_post_meta($post_id, $key, true);

        if ($value && '' == $current_value) {
            add_post_meta($post_id, $key, $value, true);
        } elseif ($value && $value != $current_value) {
            update_post_meta($post_id, $key, $value);
        } elseif ('' == $value && $current_value) {
            delete_post_meta($post_id, $key);
        }
    }
}


add_action('save_post','tb_designer_meta_box_save');

/**
 * Function 用于当文章发生变化或者更新时候的消息提示
 * @global type $post
 * @param type $messages
 * @return type
 */
function tb_designer_updated_messages($messages) {
    global $post;

    $permalink = get_permalink($post);

    $messages['designer'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf(__('设计师已更新. <a target="_blank" href="%s">查看这个设计师</a>', 'awesome'), esc_url($permalink)),
        2 => __('自定义数据已更新.', 'awesome'),
        3 => __('自定义数据已删除.', 'awesome'),
        4 => __('设计师已更新.', 'awesome'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf(__('更改设计师回复至 %s', 'awesome'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('设计师信息能被用户看到了. <a href="%s">浏览模板</a>', 'awesome'), esc_url($permalink)),
        7 => __('设计师信息已保存.', 'awesome'),
        8 => sprintf(__('设计师信息已提交. <a target="_blank" href="%s">预览设计师信息</a>', 'awesome'), esc_url(add_query_arg('preview', 'true', $permalink))),
        9 => sprintf(__('设计师信息计划在: <strong>%1$s</strong>. <a target="_blank" href="%2$s">预览设计师信息</a>', 'awesome'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url($permalink)),
        10 => sprintf(__('设计师信息草稿已更新. <a target="_blank" href="%s">预览设计师信息</a>', 'awesome'), esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
}

add_filter('post_updated_messages', 'tb_designer_updated_messages');

/**
 * 设置简历模板所有预览的窗口要显示的内容
 * @param type $cols
 * @return type
 */
function tb_designer_columns( $columns){
    $new_columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'     => '设计师',
        'id'        => '工号',
        'desc'      => '自我介绍',
        'qq'        => '工作QQ',
        'date'      => '最后修改',
    );
    return $new_columns;
}
add_filter( 'manage_designer_posts_columns','tb_designer_columns' );

function tb_designer_custom_column( $columns, $post_id ){
    switch ($columns){
        case 'id':
            echo get_post_meta($post_id, 'tb_designer_id',true);
            break;
        case 'qq':
            $qq = get_post_meta($post_id, 'tb_designer_qq',true);
            echo $qq;
            break;
        case 'desc':
            $desc = get_post_meta($post_id, 'tb_designer_desc',true);
            echo $desc;
            break;
    }
}
add_action('manage_designer_posts_custom_column','tb_designer_custom_column',10, 2);

