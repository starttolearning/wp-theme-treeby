<?php
/**
 * ================================
 *     TREEBY AJAX REQUESTS
 * ================================
 */
add_action( 'wp_ajax_nopriv_tb_save_order_form', 'tb_save_order_form' );
add_action( 'wp_ajax_tb_save_order_form', 'tb_save_order_form' );

function tb_save_order_form(){

    if ( isset( $_POST['user_file_upload_nonce'], $_POST['post_id'] )
        && wp_verify_nonce( $_POST['user_file_upload_nonce'], 'user_file_upload' )
    ) {

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

        var_dump($_FILES) ;
        var_dump($_POST);
        // allow us save information from front-end to the back-end
        $postarr = array(
            'post_title'	=> $name,
            'post_content'	=> $message,
            'post_author'	=> 1,
            'post_type'		=> 'tb-order',
            'meta_input'	=> array(
                '_order_email_value_key' => $email,
                '_order_id_value_key'  => $resume_id,
                '_order_qq_value_key'  => $qq,
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