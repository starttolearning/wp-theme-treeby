<div class="list-group">
    <div class="list-group-item active">
        <h2 class="list-group-item-heading">请给我们的本次服务打分^_^</h2>
        <p class="list-group-item-text">请你对我们的服务进行评价和建议，你的评价和建议对我们今后向你提供更好的服务打下坚实的基础。</p>
    </div>
    <form id="tbCommentForm" class="list-group-item form-horizontal" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

        <input type="hidden" name="post_id" id="post_id" value="<?php the_ID(); ?>" />
        <?php wp_nonce_field( 'user_file_upload', 'user_file_upload_nonce' ); ?>
        
        <!-- 订单号码 -->
        <div class="form-group">
            <label class="control-label col-sm-2" for="order_id">订单号码</label>
            <div class="col-sm-10">
                <input type="text" placeholder="填写订单号码" id="order_id" name="order_id" class="form-control">
                <span id="helpBlock2" class="help-block">*此字段不能为空!</span>
            </div>
        </div>

        <!-- 订单负责人 -->
        <div class="form-group">
            <label class="control-label col-sm-2" for="person_in_charge">订单负责人</label>
            <div class="col-sm-10">
                <input type="text" placeholder="订单负责人" id="person_in_charge" name="person_in_charge" class="form-control">
                <span id="helpBlock2" class="help-block">*此字段不能为空!</span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="name">邮箱地址</label>
            <div class="col-sm-10">
                <input type="email" placeholder="邮箱地址" id="email" name="email" class="form-control">
                <span id="helpBlock2" class="help-block">*此字段不能为空!</span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="name">信息</label>
            <div class="col-sm-10">
                <textarea placeholder="告诉我们你的想法..." id="message" name="message" class="form-control"></textarea>
                <span id="helpBlock2" class="help-block">*此字段不能为空!</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">文件</label>
            <div class="col-sm-10">
                <div id="upload_button" class="btn btn-primary" style="display: block; max-width: 180px; position: relative; overflow: hidden; direction: ltr;"><i class="fa fa-upload" aria-hidden="true"></i> 选择文件<input multiple="multiple" accept="image/jpeg,image/png,image/svg+xml,.psd,application/photoshop,application/psd,image/psd,.ai,application/illustrator,application/ai,application/postscript,video/mpeg,video/mp4,video/quicktime,video/avi,video/x-msvideo" type="file" name="user_upload_file_id" id="user_upload_file_id" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;"></div>
                <input type="hidden" name="post_id" id="post_id" value="231" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
        <div class="text-center">
            <div id="submission" class="alert alert-warning" role="alert">正在提交中……</div>
            <div id="success" class="alert alert-success" role="alert">提交成功你将很快收到我们的回复！</div>
            <div id="failure" class="alert alert-danger" role="alert">对不起，请仔细看看所填写的内容。</div>
        </div>
    </form>
    </div>