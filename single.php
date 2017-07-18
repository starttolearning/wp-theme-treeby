<?php
/**
 * The template for displaying all single posts
 *
 * @package awesometheme
 * @since 1.0
 * @version 1.0
 */
get_header();
?>

<section class="section-resume-order">
    <div class="container">
        <div class="row">
            <h1 class="tb-resume-heading1"><b>简历模板：</b><?php the_title(); ?></h1>
            <div class="col-sm-8">
                <?php
                // If a regular post or page, and not the front page, show the featured image.
                if (has_post_thumbnail() && ( is_single() || ( is_page() && !twentyseventeen_is_frontpage() ) )) :
                    ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive tb-fullwidth" alt="简历预览图">
                <?php endif;
                ?>
            </div>
            <div class="col-sm-4 tb-properties">
                <p><?php echo get_post_field('简介') ; ?></p>
                <h2>页数</h2>
                <span><?php echo get_post_field('页数') ; ?></span>
                <hr>
                <h2>纸张大小</h2>
                <span><?php echo get_post_field('纸张大小') ; ?></span>
                <hr>
                <h2>装订风格</h2>
                <span><?php echo get_post_field('装订风格') ; ?></span>
                <hr>
                <h2>纸张质量</h2>
                <span><?php echo get_post_field('纸张质量') ; ?></span>
                <hr>
                <h2>价格</h2>
                <span><?php echo get_post_field('价格') ; ?></span>
                <hr>
                <p>场所：<small><?php echo get_post_field('场所') ; ?></small></p>
                <small><?php echo get_post_field('版权声明') ; ?></small>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    while (have_posts()) : the_post();

                        get_template_part('templates/content', get_post_format());
                        
                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>
        </div>
</section>  <!-- section-resume-oredr -->
<section class="section-call-action">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="tb-resume-heading2">制作精美的简历<br>马上开始与我们的设计师交流...</h2>
            </div>
            <div class="col-sm-12">
                <a class="btn btn-default" href="#" role="button">开始填写资料 &raquo;</a>
            </div>
        </div>
    </div>
</div>
</section> <!-- section-call-action -->

<section class="section-our-designers">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                <h2>Jhon Smith</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                <p><a class="btn btn-default" href="#" role="button">联系我们的设计师 &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                <h2>Wilton Lee</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                <p><a class="btn btn-default" href="#" role="button">联系我们的设计师 &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                <h2>Doctor Wang</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                <p><a class="btn btn-default" href="#" role="button">联系我们的设计师 &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div>
</section>  <!-- section-our-designers -->
<section class="section-form">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2 class="form-heading2">填写你的简历需要呈现的信息</h2>
                <p class="lead">通过使用我们提供给大家的简单模板，按照要求填写简历的详细内容（研究表明：详细和结构化的建立更能帮助求职者），然后通过提交该文档由我们的设计师完成排版和设计。</p>
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="user-name">姓名</label>
                        <input type="email" class="form-control" id="user-name" placeholder="填写你的姓名">
                    </div>
                    <div class="form-group">
                        <label for="user-email">Email</label>
                        <input type="email" class="form-control" id="user-email" placeholder="你的邮箱地址">
                    </div>
                    <div class="form-group">
                        <label for="form-upload">上传未排版的原始文件</label>
                        <input type="file" id="form-upload">
                        <p class="help-block">仅支持*.doc,*.pdf文档.</p>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> 同意我们的服务条款
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">立即提交制作</button>
                </form>
            </div>
            <div class="col-md-5">
                <img class="img-responsive center-block" src="<?php echo get_theme_file_uri(); ?>/images/service.png" alt="Generic placeholder image">
            </div>
        </div>
    </div>
</section>  <!-- section-form -->

<?php
get_footer();
