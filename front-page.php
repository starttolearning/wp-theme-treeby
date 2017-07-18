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
<div class="header-image" style="background-image: url('<?php header_image(); ?>');">
    <div class="hero">
        <h1>在线简历，再也不求人！</h1> 
        <p class="lead">My resume, my own way</p>
    </div>
</div>
<div id="content">
    <?php if(  have_posts()): ?>
        <?php while( have_posts()) : the_post(); ?>
            <?php get_template_part( 'template-parts/content', 'front' ); ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>