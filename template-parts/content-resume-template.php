<?php
/**
 * Template part for displaying resume thumbnail
 *
 * @package awesometheme
 * @since 1.0
 * @version 1.0
 */

?>

<div class="col-xs-6 col-sm-4 col-md-3">
    <a href="<?php the_permalink(); ?>">
        <img class="img-responsive" src="<?php the_post_thumbnail_url(); ?>" />
    </a>
</div>
