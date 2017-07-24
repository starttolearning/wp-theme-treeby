jQuery(document).ready(function($) {
    /*User order submmision*/
    $('.help-block').hide();
    $('.alert').hide();
    $('#customerFeedbackNow').hide();

    $("#customerFeedback").on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var searchTerm = form.find('#tb_comment_search_order_id').val(),
            user_feedback_nonce = form.find("#user_feedback_comment_nonce").val(),
            ajaxurl = form.data('url');
        // alert(searchTerm);
        // 检查是表单各项是否为空
        if ( searchTerm === '') {
            $('#hbSearchBox').remove();
            $('#tb_comment_search_order_id').parent('.form-group').addClass('has-error');
            $('#tb_comment_search_order_id').parent('.form-group').append('<span id="hbSearchBox" class="help-block">订单号不能为空！</span>').slideDown(300);
            return;
        }

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                order_id: searchTerm,
                nonce: user_feedback_nonce,
                action: 'tb_search_order_id'
            },
            error: function(response) {
                console.log("some error happand");
            },
            success: function(response) {
                if ( response === "-1" ) {
                    $('#hbSearchBox').remove();
                    $('#tb_comment_search_order_id').parent('.form-group').addClass('has-error');
                    $('#tb_comment_search_order_id').parent('.form-group').append('<span id="hbSearchBox" class="help-block">没有找到该订单！请确认你输入的第订单号是有效的。</span>').slideDown(300);
                } else {
                    form.remove();
                    console.log("find orders");
                    var obj = JSON.parse(response);
                    $('#order-info').append('<h3>关于订单：<i>'+searchTerm+'</i>  的详细信息</h3>')
                    $('#order-info').append('<input id="tb_current_wait_for_comment" type="hidden" value="'+obj.post_id+'" />')
                    $('#order-info').append('<table class="table table-striped text-left">'+
                      '<tbody>'+
                        '<tr>'+
                          '<th scope="row">客户姓名: </th>'+
                          '<td>'+obj.order_info_data.order_customer+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<th scope="row">客户邮箱: </th>'+
                          '<td>'+obj.order_info_data.order_email+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<th scope="row">订购的简历ID: </th>'+
                          '<td>'+obj.order_info_data.order_resume_id+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<th scope="row">客户QQ: </th>'+
                          '<td>'+obj.order_info_data.order_qq+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<th scope="row">价格: </th>'+
                          '<td>'+obj.order_info_data.order_price+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<th scope="row">产品类型: </th>'+
                          '<td>'+obj.order_info_data.order_type+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<th scope="row">产品状态: </th>'+
                          '<td  id="orderShouldComment" ></td>'+
                        '</tr>'+
                        '<tr>'+
                          '<th scope="row">客户留言: </th>'+
                          '<td>'+obj.order_info_data.order_note+'</td>'+
                        '</tr>'+
                      '<tbody></table>');
                    
                      statusCode = obj.order_info_data.order_status;
                      statusText ='';
                      switch(statusCode){
                        case -1:
                          statusText = '等待处理';
                          break;
                        case 0:
                          statusText = '订单已提交';
                          break;
                        case 1:
                          statusText = '安排设计师设计';
                          break;
                        case 2:
                          statusText = '初稿已完成';
                          break;
                        case 3:
                          statusText = '确定制作';
                          break;
                        case 4:
                          statusText = '制作完成';
                          break;
                        case 5:
                          statusText = '等待安装';
                          break;
                        case 6:
                          statusText = '已安装';
                          break;
                        case 7:
                          statusText = '等待评价';
                          break;
                        case 8:
                          statusText = '订单完成';
                          break;
                      }
                    
                    if( statusCode >= -1 && statusCode < 6 ){
                      $('#orderShouldComment').append(statusText + '&nbsp;&nbsp;<button id="click_to_comment_now" class="btn btn-primary disabled">立即评价</button>');
                    }else if(statusCode === 8){
                      $('#orderShouldComment').append(statusText);
                    }
                    else{
                      $('#orderShouldComment').append( statusText + '&nbsp;&nbsp;<button id="click_to_comment_now" class="btn btn-primary">立即评价</button>');
                      $('button#click_to_comment_now').on('click', function(e){
                        $('#customerFeedbackNow').slideDown(400);
                      });
                    }
                    // console.log( obj);
                }
            }
        });
    });
    
    $("#customerFeedbackNow").on('submit', function( e ){
      e.preventDefault();
      var form = $(this),
          customer_feedback_nonce = form.find("#customer_feedback_nonce").val(),
          current_post_id = $('#tb_current_wait_for_comment').val(),
          designer_score = form.find('#designer_score').val(),
          designing_score = form.find('#designing_score').val(),
          service_score = form.find('#service_score').val(),
          delivery_install_score = form.find('#delivery_install_score').val(),
          comment_message = form.find('#comment_message').val(),
          ajaxurl = form.data('url');
          // alert(comment_message);
      $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                current_post_id: current_post_id,
                designer_score: designer_score,
                designing_score: designing_score,
                service_score: service_score,
                delivery_install_score: delivery_install_score,
                comment_message: comment_message,
                nonce: customer_feedback_nonce,
                action: 'tb_customer_feedback_now'
            },
            error: function(response) {
                console.log("some error happand");
            },
            success: function(response) {
                if ( response === "-1" ) {
                  console.log('提交的表单有误');
                } else {
                    // console.log( response);
                    form.remove();
                    $('#order-info').append('<h3>感谢你的你对我们的评价!</h3>').slideDown(400);
                }
            }
        });

    });

    $("#tbContactForm").on('submit', function(e) {
        e.preventDefault();
        $('.has-error').removeClass('has-error');
        var form = $(this);
        var formData = new FormData(this);

        form.find('.alert').slideUp('300');
        form.find('.alert').slideUp('300');
        form.find('.alert').slideUp('300');

        var name = form.find('#name').val(),
            email = form.find('#email').val(),
            message = form.find('#message').val(),
            ajaxurl = form.data('url');

        // 检查是表单各项是否为空
        if (name === '') {
            $("#name").parent().parent('.form-group').addClass('has-error');
            $("#name").siblings().slideDown();
            return;
        }

        if (email === '') {
            $("#email").parent().parent('.form-group').addClass('has-error');
            $("#email").siblings().slideDown();
            return;
        }

        if (message === '') {
            $("#message").parent().parent('.form-group').addClass('has-error');
            $("#message").siblings().slideDown();
            return;
        }

        form.find('input, button, textarea').attr('disabled', 'disabled');
        form.find('#submission').slideDown('300');

        formData.append('action', 'tb_save_order_form');

        $.ajax({
            url: ajaxurl,
            type: 'post',
            // data: {
            //   name : name,
            //   email : email,
            //   message : message,
            //   action : 'tb_save_order_form'
            // },
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            error: function(response) {
                form.find('#failure').slideDown('300');
                form.find('#submission').slideUp('300');
                form.find('input, button, textarea').removeAttr('disabled', 'disabled');
            },
            success: function(response) {
                if (response === 0) {
                    form.find('#failure').slideUp('300');
                    form.find('#submission').slideUp('300');
                    form.find('#success').slideDown('300');
                    form.find('input, button, textarea').removeAttr('disabled');
                } else {
                    form.find('#failure').slideUp('300');
                    form.find('#submission').slideUp('300');
                    form.find('#success').slideDown('300');
                    form.find('input, button, textarea').removeAttr('disabled').val('');
                }
            }
        });
    });

    /* File uplaoder using built-in scripts */
    // var mediaUploader;
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