<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
	<div class="row">
		<div class="col-xs-12">
		<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<!-- <?php the_post_thumbnail(  ); ?> -->
				</a>
			</div><!-- .post-thumbnail -->
		<?php endif; ?>
		</div>

	<div class="col-xs-12">
		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
					get_the_title()
				) );
			?>
		</div><!-- .entry-content -->
	</div>
	</div>

</article><!-- #post-## -->
