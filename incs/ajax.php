<?php
/**
 * ================================
 *     TREEBY AJAX REQUESTS
 * ================================
 */
add_action( 'wp_ajax_nopriv_tb_save_order_form', 'tb_save_order_form' );
add_action( 'wp_ajax_tb_save_order_form', 'tb_save_order_form' );

add_action( 'wp_ajax_nopriv_tb_search_order_id', 'tb_search_order_id' );
add_action( 'wp_ajax_tb_search_order_id', 'tb_search_order_id' );

add_action( 'wp_ajax_nopriv_tb_customer_feedback_now', 'tb_customer_feedback_now_callback' );
add_action( 'wp_ajax_tb_customer_feedback_now', 'tb_customer_feedback_now_callback' );

function tb_customer_feedback_now_callback()
{
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'customer_feedback' ) ) 
    {
        $current_post_id = ( $_POST['current_post_id'] );
        $designer_score = ( $_POST['designer_score'] );
        $designing_score = ( $_POST['designing_score'] );
        $service_score = ( $_POST['service_score'] );
        $delivery_install_score = ( $_POST['delivery_install_score'] );
        $comment_message = ( $_POST['comment_message'] );

        $comment_data = array(
            'designer_score' => $designer_score, 
            'designing_score' => $designing_score,
            'service_score' => $service_score,
            'delivery_install' => $delivery_install_score,
            'user_message' => $comment_message
        );
        $order_info_data = get_post_meta( $current_post_id, '_order_info_data', true );
        $order_info_data['order_status'] = 8;
        
        // echo $current_post_id;
        $post_id = update_post_meta( $current_post_id, '_order_comment_data', $comment_data );
        $post_id = update_post_meta( $current_post_id, '_order_info_data', $order_info_data );
        if( $post_id ){
            echo 'success';
        }else{
            echo -1;
        }
    }
    die;
}

function tb_search_order_id(){
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'user_feedback_comment' ) ) 
    {
        $order_id = ( $_POST['order_id'] );
        $search_result = get_posts( [
          'post_type' => 'tb-order',
          's' => $order_id,
          'exact' => true,
          'sentence' => true,
          'post_status' => 'publish',
        ] );

        $default_post_meta = array(

            );

        $current_post = $search_result[0];
        if( !empty( $search_result[0]->post_title ) &&  $order_id === $search_result[0]->post_title ){
            $post_meta = get_post_meta( $search_result[0]->ID);
            $order_info_data = unserialize( $post_meta['_order_info_data'][0] );
            $order_comment_data = unserialize( $post_meta['_order_comment_data'][0] );
            $order_info = array( 'post_id' =>$search_result[0]->ID ,'order_info_data' => $order_info_data, 'order_comment_data' => $order_comment_data );
            echo json_encode($order_info);
        }else{
            echo -1;
        }
    }
    die;
}

/**
 * Using Ajax to save the request content from the user in the front end
 * @return [type] [description]
 */
function tb_save_order_form(){

    if ( isset( $_POST['user_file_upload_nonce'], $_POST['post_id'] )
        && wp_verify_nonce( $_POST['user_file_upload_nonce'], 'user_file_upload' )
    ) {

        $order_id = 'tb'.build_order_no();
        $name = wp_strip_all_tags( $_POST['name'] );
        $qq = wp_strip_all_tags( $_POST['qq'] );
        $email = wp_strip_all_tags( $_POST['email'] );
        $message = wp_strip_all_tags( $_POST['message'] );

        // These files need to be included as dependencies when on the front end.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $post_id = $_POST['post_id'];
        $attachment_id = media_handle_upload( 'user_upload_file_id', $post_id );

        $resume_id = get_post_meta($post_id, 'tb_resume_id',true );

        if ( is_wp_error( $attachment_id ) ) {
            echo "upload failed";
        } else {
            // The image was uploaded successfully!
            echo "upload success" . $attachment_id;
        }

        // some test
        // var_dump($_FILES) ;
        // var_dump($_POST);
        // allow us save information from front-end to the back-end
        $postarr = array(
            'post_title'	=> $order_id,
            'post_author'	=> 1,
            'post_type'		=> 'tb-order',
            'meta_input'	=> array(
                '_order_email_value_key' => $email,
                '_order_id_value_key'  => $resume_id,
                '_order_qq_value_key'  => $qq,
                '_order_note_value_key' => $message,
                '_order_customer_value_key' => $name,
            ),
            'post_status'	=> 'publish',

        );
        $post_id = wp_insert_post( $postarr );

        if( $post_id !== 0 ){

            // Send email to the admin for notification
//		$to = get_bloginfo('admin_email');
//		$subject = 'Resume Set - '.$name;
//		$headers[] = 'From: '.get_bloginfo('name').' <'.$to.'>'; // From Wilton Lee <wilton_lee@163.com>
//		$headers[] = 'Reply-To: '.$name.' <'.$email.'>';
//		$headers[] = 'Content-Type: text/html: charset=UTF-8';
//
//		wp_mail( $to, $subject, $message, $headers );
            echo $post_id;
        }else{
            echo 0;
        }
    }
    
	die();

}