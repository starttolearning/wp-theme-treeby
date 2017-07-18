<?php
/**
 * The footer for our theme
 *
 * @package awesometheme
 * @since 1.0
 * @version 1.0
 */

?>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
				    <h3>快速链接</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'footer-nav') ); ?>
				</div>
				<div class="col-xs-12 col-sm-4">
				    <h3>联系我们</h3>
				    <address>
                      <strong>&nbsp;南充种树人广告公司</strong><br>
                        &nbsp;西华师范大学科技园203<br>
                        &nbsp;西华师范大学一期学府花园10栋<br>
                        &nbsp;<abbr title="Phone">电话:</abbr> 0817-2220214<br>
                        &nbsp;<abbr title="Phone">创业交流:</abbr> 180-4882-3225<br>
                        &nbsp;<abbr title="Phone">投诉电话:</abbr> 180-4882-3225<br>
                    </address>
				</div>
				<div class="col-xs-12 col-sm-4">
				    <h3>社交媒体</h3>
				    <div class="awesome-socail">
				        <table class="table table-condensed table-hover">
                         <tbody>
                             <tr>
                              <td><i class="fa fa-qq" aria-hidden="true"></i></td>
                              <td>QQ： 1397302829</td>
                              </tr>
                              <tr>
                                  <td><i class="fa fa-weixin" aria-hidden="true"></i></td>
                                  <td>微信：树人印萌</td>
                              </tr>
                              <tr>
                                  <td><i class="fa fa-weibo" aria-hidden="true"></i></td>
                                  <td>新浪：@校园种树人广告公司</td>
                              </tr>
                         </tbody>
                    </table>
				    </div>
				    
				</div>
				<div class="col-xs-12">
					<p class="text-center">&copy; 2016-<?php echo get_the_date('Y'); ?> 版权归南充种树人广告公司所有  蜀ICP备:16026179.</p>
<!--					<p class="text-center">Powered by: WordPress</p>-->
				</div>
			</div>
		</div>
	</footer>

</body>
<?php wp_footer(); ?>
</html>