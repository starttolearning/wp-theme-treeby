<?php
/**
 * The index for my theme
 *
 * @package awesometheme
 * @since 1.0
 * @version 1.0
 */

?>
<?php get_header(); ?>
    <div class="post-header-image" style="background-image: url('<?php echo get_template_directory_uri()."/assets/images/orders.jpg"; ?>');">
        <div class="hero">
            <h1>简历模板</h1>
            <p class="lead">此处展示了本公司所有的精美模板供你选择。</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 blog-main">
                <?php if(  have_posts()): ?>
                    <?php while( have_posts()) : the_post(); ?>
                        <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
<!--                <nav>-->
<!--                    <ul class="pager">-->
<!--                        <li><a href="#">Previous</a></li>-->
<!--                        <li><a href="#">Next</a></li>-->
<!--                    </ul>-->
<!--                </nav>-->
            </div>
            <?php get_sidebar(); ?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
<?php get_footer(); ?>