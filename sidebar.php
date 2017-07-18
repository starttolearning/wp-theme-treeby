    <div class="col-sm-3 blog-sidebar">
        <div class="panel panel-info">
            <div class="panel-heading">About</div>
            <div class="panel-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam asperiores dolore dolorem enim magni, neque obcaecati provident sed vel! Aspernatur autem blanditiis corporis earum eligendi error est obcaecati odit.
            </div>
        </div>

        <div class="list-group">
            <a class="list-group-item active">
                分类模板
            </a>
            <a href="/resume" class="list-group-item">
                所有
            </a>
            <?php
                $resumes_cats = get_categories(array( 'taxonomy' => 'tb_resume_tax' ));
                foreach( $resumes_cats as $category ) {
                    $category_link = sprintf(
                        '<a class="list-group-item" href="%1$s" alt="%2$s">%3$s</a>',
                        esc_url( get_category_link( $category->term_id ) ),
                        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                        esc_html( $category->name )
                    );
                    echo $category_link;
                }

            ?>
        </div>
    </div>
<!-- /.blog-sidebar -->