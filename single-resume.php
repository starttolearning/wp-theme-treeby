<?php
/**
 * The template for displaying all single posts
 *
 *
 * @package awesometheme
 * @since 1.0
 * @version 1.0
 */
get_header();
?>
<div id="resume-order">
   <section id="awesome-order-preview">
       <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <?php
                    // If a regular post or page, and not the front page, show the featured image.
                    if (has_post_thumbnail() && ( is_single() || ( is_page() && !is_front_page() ) )) :
                        ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive tb-fullwidth" alt="简历预览图">
                    <?php endif;
                    ?>
                </div>
                <div class="col-sm-4">
                    <h2>模板简介:<i><?php the_title(); ?></i></h2>
                    <?php the_excerpt(); ?>
                    <h3>页数</h3>
                    <span><?php echo get_post_meta(get_the_ID(), 'tb_resume_total_pages',true); ?></span>
                    <hr>
                    <h3>纸张大小</h3>
                    <span><?php echo get_post_meta(get_the_ID(), 'tb_resume_page_size',true) ; ?></span>
                    <hr>
                    <h3>装订风格</h3>
                    <span><?php echo get_post_meta(get_the_ID(), 'tb_resume_print_style',true) ; ?></span>
                    <hr>
                    <h3>纸张质量</h3>
                    <span><?php echo get_post_meta(get_the_ID(), 'tb_resume_print_quality',true) ; ?></span>
                    <hr>
                    <h3>价格</h3>
                    <span><?php echo get_post_meta(get_the_ID(), 'tb_resume_price',true) ; ?></span>
                    <hr>
                    <h3>场所：<small><?php echo get_post_meta(get_the_ID(), 'tb_resume_context',true)  ; ?></small></h3>
                    <small><?php echo get_post_field('版权声明') ; ?></small>
                </div>
            </div>
       </div>
   </section> <!--#awesome-order-preview-->

<section id="awesome-order-contents">
    <div class="container">
        <div class="row">
            <h2 class="text-center">内部详图</h2>
                <?php
            while (have_posts()) : the_post();

               the_content();

            endwhile; // End of the loop.
            ?>
        </div>
    </div>
</section> <!--#awesome-order-contents-->


<section id="awesome-order-action">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">制作精美的简历<br>马上开始与我们的设计师交流...</h2>
            </div>
            <div class="col-sm-12 text-center">
                <a class="btn" href="#awesome-order-form" role="button">开始填写资料 &raquo;</a>
            </div>
        </div>
    </div>
</section> <!--#awesome-order-action    -->

<section id="awesome-order-designers">
    <div class="container">
        <div class="row">
            <?php

            $args = array(
                'post_type'         => 'designer',
                'orderby'           => 'rand',
            );

            $designers = new WP_Query( $args );

            // The Loop
            if ( $designers->have_posts() ) {
                while ( $designers->have_posts() ) {
                    $designers->the_post();
            ?>
                    <div class="col-xs-12  col-sm-4">
                        <div class="text-center awesome-designer">
                            <img class="img-circle" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Generic placeholder image" width="140" height="140">
                            <h2><?php the_title(); ?></h2>
                            <p><?php echo get_post_meta( get_the_ID() , 'tb_designer_desc', true ); ?></p>
                            <p><script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=<?php echo get_post_meta( get_the_ID() , 'tb_designer_qqkey', true ); ?>"></script></p>
                        </div>
                    </div><!-- /.col-xs-12  col-sm-4 -->

            <?php
                }
            } else {
            ?>

                <div class="col-xs-12  col-sm-4">
                    <div class="text-center awesome-designer">
                        <img class="img-circle" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2>于淑慧</h2>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzgwMDEwODUwOV80NTg4MzFfODAwMTA4NTA5Xw"></script></p>
                    </div>
                </div><!-- /.col-xs-12  col-sm-4 -->
                <div class="col-xs-12  col-sm-4">
                    <div class="text-center awesome-designer awesome-designer-background">
                        <img class="img-circle" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2>张小东</h2>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzgwMDEwODUwOV80NTg4MzFfODAwMTA4NTA5Xw"></script></p>
                    </div>
                </div><!-- /.col-xs-12  col-sm-4 -->
                <div class="col-xs-12  col-sm-4">
                    <div class="text-center awesome-designer">
                        <img class="img-circle" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2>李小</h2>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzgwMDEwODUwOV80NTg4MzFfODAwMTA4NTA5Xw"></script></p>
                    </div>
                </div><!-- /.col-xs-12  col-sm-4 -->

            <?php
            }
            /* Restore original Post Data */
            wp_reset_postdata();

            ?>
        </div>
    </div>
</section> <!--#awesome-order-designers-->

    
<section id="awesome-order-form">
    <div class="background-filter">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php echo do_shortcode( '[order]', false ); ?>
                </div>
            </div>
        </div>
    </div>
</section><!--#awesome-order-form-->

</div> <!-- #resume-order-->

<?php
get_footer();
