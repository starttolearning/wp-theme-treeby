jQuery(document).ready(function($) {
    
    /*User order submmision*/
    $('.help-block').hide();
    $('.alert').hide();

    $("#tbContactForm").on( 'submit',function( e ){
        e.preventDefault();

        $('.has-error').removeClass('has-error');
        var form = $(this);
        var formData = new FormData( this );

        form.find('.alert').slideUp('300');
        form.find('.alert').slideUp('300');
        form.find('.alert').slideUp('300');

        var name = form.find('#name').val(),
            email = form.find('#email').val(),
            message = form.find('#message').val(),
            ajaxurl = form.data('url');


        // 检查是表单各项是否为空
        if( name === ''){
          $("#name").parent().parent('.form-group').addClass('has-error');
          $("#name").siblings().slideDown();
          return;
        }

        if( email === ''){
          $("#email").parent().parent('.form-group').addClass('has-error');
            $("#email").siblings().slideDown();
          return;
        }

        if( message === ''){
          $("#message").parent().parent('.form-group').addClass('has-error');
            $("#message").siblings().slideDown();
          return;
        }

        form.find('input, button, textarea').attr('disabled','disabled');
        form.find('#submission').slideDown('300');

        formData.append('action','tb_save_order_form');

        $.ajax({
          url : ajaxurl,
          type : 'post',
          // data: {
          //   name : name,
          //   email : email,
          //   message : message,
          //   action : 'tb_save_order_form'
          // },
            data: formData ,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
          error : function ( response ) {
              form.find('#failure').slideDown('300');
              form.find('#submission').slideUp('300');
              form.find('input, button, textarea').removeAttr('disabled','disabled');
          },
          success : function ( response ) {
              if( response == 0 ){
                  form.find('#failure').slideUp('300');
                  form.find('#submission').slideUp('300');
                  form.find('#success').slideDown('300');
                  form.find('input, button, textarea').removeAttr('disabled');
              }else{
                  form.find('#failure').slideUp('300');
                  form.find('#submission').slideUp('300');
                  form.find('#success').slideDown('300');
                  form.find('input, button, textarea').removeAttr('disabled').val('');
              }
            }
        });
    });
    
    /* File uplaoder using built-in scripts */
    var mediaUploader;
    // $('#upload_button').on('click', function(e){
    //
    //     e.preventDefault();
    //     if( mediaUploader ){
    //         mediaUploader.open();
    //         return;
    //     }
    //
    //     mediaUploader = wp.media.frames.file_frame =wp.media({
    //         title: '选择上传的文件',
    //         button: {
    //             text: '上传'
    //         },
    //         multiple: false
    //     });
    //
    //     mediaUploader.on('select',function(){
    //        attatchment = mediaUploader.state().get('selection').first().toJSON();
    //        $('#profile-picture').val(attatchment.url);
    //
    //        $('#profile-picture-preview').css('background-image','url(' + attatchment.url + ')');
    //
    //     });
    //
    //     mediaUploader.open();
    //
    // });
    
});