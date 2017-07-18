<div class="blog-post">
    <div class="row">
        <div class="col-sm-5">
            <img class="img-responsive" src="<?php the_post_thumbnail_url(); ?>" >
        </div>
        <div class="post-content-data col-sm-7">
            <h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="blog-post-meta">发表于/ <?php the_date(); ?> / 由 <a href="#"> <?php the_author(); ?> </a> 编辑</p>
            <p><?php the_excerpt(); ?></p>
            <?php the_content(); ?>
            <span>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary"> Read More</a>
            </span>
        </div>
    </div>
</div>
<hr>
<!-- /.blog-post -->