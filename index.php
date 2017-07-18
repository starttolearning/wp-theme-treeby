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
<div class="container">
	<?php if(  have_posts()): ?>
		<?php while( have_posts()) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'hottest' ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div> <!-- .container -->
<?php get_footer(); ?>