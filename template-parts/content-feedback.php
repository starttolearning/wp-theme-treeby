<section id="tbc-feedback">
   <div class="container text-center">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
            <form id="customerFeedback" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>" >
                <?php wp_nonce_field( 'user_feedback_comment', 'user_feedback_comment_nonce' ); ?>
                <h2>查询订单号并对我们评价</h2>
                <p>现在你可以通过我们向你提供的订单号查询订单进度，以及对我们的服务进行评价。</p>
                <div class="form-group">
                    <input id="tb_comment_search_order_id" name="tb_comment_search_order_id"  type="text" class="form-control" style="text-align:center; vertical-align:middle" placeholder="请输入订单号">
                </div>
                <button type="submit" class="btn btn-primary">查询</button>
            </form>
            <div id="order-info"></div>
            <form id="customerFeedbackNow" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>" >
                <h3>你的评价对我们至关重要！</h3>
                <p>我们的每一步成长都离不开你们的支持，让我们携手并进。</p>
                <?php wp_nonce_field( 'customer_feedback', 'customer_feedback_nonce' ); ?>
                <table class="table">
                    <!-- Column: designer_score -->
                    <tr>
                        <th scope="row">
                            <label for="designer_score">设计师评分</label>
                        </th>
                        <td>
                            <input id="designer_score" name="designer_score" value="0" type="number" class="rating" min=0 max=10 step=1 data-size="xs" data-stars="10">
                        </td>
                    </tr>
                    
                    <!-- Column: designing_score -->
                    <tr>
                        <th scope="row">
                            <label for="designing_score">设计评分</label>
                        </th>
                        <td>
                            <input id="designing_score" name="designing_score" value="0" type="number" class="rating" min=0 max=10 step=1 data-size="xs" data-stars="10">
                        </td>
                    </tr>

                    <!-- Column: service_score -->
                    <tr>
                        <th scope="row">
                            <label for="service_score">质量服务</label>
                        </th>
                        <td>
                            <input id="service_score" name="service_score" value="0" type="number" class="rating" min=0 max=10 step=1 data-size="xs" data-stars="10">
                        </td>
                    </tr>

                    <!-- Column: delivery_install_score -->
                    <tr>
                        <th scope="row">
                            <label for="delivery_install_score">送货和安装服务</label>
                        </th>
                        <td>
                            <input id="delivery_install_score" name="delivery_install_score" value="0" type="number" class="rating" min=0 max=10 step=1 data-size="xs" data-stars="10">
                        </td>
                    </tr>

                    <!-- Column: message -->
                    <tr>
                        <th scope="row">用户评价</th>
                        <td>
                            <fieldset>
                                <p>
                                    <textarea id="comment_message" name="comment_message" rows="4" cols="60" id="message" class="large-text"><?php //echo $comment_data['user_message']; ?></textarea>
                                </p>
                            </fieldset>
                        </td>
                    </tr>

                </table>
                <button type="submit" class="btn btn-primary">提交评价</button>
            </form> 
        </div>
    </div>
</section>