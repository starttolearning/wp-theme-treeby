<section id="home-a">
   <div class="container">
        <div class="row">
            <div class="col-sm-8"><img src="<?php echo the_post_thumbnail_url( 'post-thumbnail' ); ?>" /></div>
            <!-- col-sm-6 -->
            <div class="col-sm-4">
                <h2>制作简历再也不麻烦了</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id nostrum corporis reiciendis libero? Itaque obcaecati, reprehenderit illo. Nulla quis laudantium ad dignissimos animi quidem expedita placeat voluptate maxime, repudiandae laborum.</p>
            </div>
        </div>
    </div>
</section>

<section id="home-b">
  <div class="container">
       <div class="row">
           <h2 class="text-center">我们的优势和特点</h2>
           <hr>
            <div class="col-sm-4 col-md-2">
                <i class="fa fa-rocket" aria-hidden="true"></i>
                <h2>快速</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor hic similique molestiae, architecto expedita. Ducimus sapiente, quisquam. Ut excepturi nemo nisi tenetur, cupiditate at inventore, itaque voluptas aliquam, nihil vel.</p>
            </div>
            <div class="col-sm-4 col-md-2">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <h2>简单</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor hic similique molestiae, architecto expedita. Ducimus sapiente, quisquam. Ut excepturi nemo nisi tenetur, cupiditate at inventore, itaque voluptas aliquam, nihil vel.</p>
            </div>
            <div class="col-sm-4 col-md-2">
                <i class="fa fa-certificate" aria-hidden="true"></i>
                <h2>专业</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor hic similique molestiae, architecto expedita. Ducimus sapiente, quisquam. Ut excepturi nemo nisi tenetur, cupiditate at inventore, itaque voluptas aliquam, nihil vel.</p>
            </div>
            <div class="col-sm-4 col-md-2">
                <i class="fa fa-usd" aria-hidden="true"></i>
                <h2>便宜</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor hic similique molestiae, architecto expedita. Ducimus sapiente, quisquam. Ut excepturi nemo nisi tenetur, cupiditate at inventore, itaque voluptas aliquam, nihil vel.</p>
            </div>
            <div class="col-sm-4 col-md-2">
                <i class="fa fa-users" aria-hidden="true"></i>
                <h2>定制</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor hic similique molestiae, architecto expedita. Ducimus sapiente, quisquam. Ut excepturi nemo nisi tenetur, cupiditate at inventore, itaque voluptas aliquam, nihil vel.</p>
            </div>
            <div class="col-sm-4 col-md-2">
                <i class="fa fa-universal-access" aria-hidden="true"></i>
                <h2>大方</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor hic similique molestiae, architecto expedita. Ducimus sapiente, quisquam. Ut excepturi nemo nisi tenetur, cupiditate at inventore, itaque voluptas aliquam, nihil vel.</p>
            </div>
        </div>
    </div>
</section>


<section id="home-c">
    <div class="container">
        <div class="row">
            <h2 class="text-center">选择模板,开始制定</h2>
            <hr>
            <?php
            $args = array(
                'post_type' => array('resume'),
                'order' => 'ASC'
            );

            $resume_templates = new WP_Query($args);
            if ($resume_templates->have_posts()):
                while ($resume_templates->have_posts()):
                    $resume_templates->the_post();
                    get_template_part('template-parts/content', 'resume-template');
                endwhile;
            endif;

            wp_reset_postdata();
            ?>
            <div class="col-xs-12 text-center">
                <a  href="./resume"><button class="btn btn-primary btn-lg">更多&raquo;</button></a>
            </div>
        </div>
    </div>
</section> <!-- #tb-resume-template -->

<section id="home-d">
     <div class="container">
         <div class="row">
           <div class="container">
                <div class="call-action">
                    <h2>轻松三个步骤解决你所有的简历问题</h2>
                    <p>Lis libero? Itaque obcaecati, reprnimi quidem expedita placeat voluptate maxime, repudiandae laborum.</p>
                    <p>Lorem ipsciendis lium ad dignissimos animi quidem expedita placeat voluptate maxime, repudiandae laborum.</p>
                    <p>Lorem ipsum doro? Itaque obcaecati, reprehenderit illo. Nulla quis laimi quidem expedita placeat voluptate maxime, repudiandae laborum.</p>
                    <br>
                    <a href="#" class="btn btn-primary">选择模板开始</a>
                </div>
           </div>
        </div>
     </div>
</section>