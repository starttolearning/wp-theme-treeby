<?php
/**
 * The header for our theme
 *
 * @package awesometheme
 * @since 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( bloginfo( 'name' ).'&raquo;' ); ?></title>
    <meta name="Keywords" content="Treeby, Tree By, 种树人广告, 南充市区种树人广告公司, 简历制作, 在线打印, 设计师, 个性定制" />
    <meta name="Description" content="南充市区种树人广告公司 :: 种树人信息技术有限公司由成立于2015年的种树人校园广告公司重组而成，是一家集广告服务、自助打印和一对一交换于一体的新型资源循环利用公司。公司坐落在四川省第二人口大市、中国优秀旅游城市、久负盛名的 “绸都”——南充。项目的建设以科技园的产业为基础，立志塑造未来中国服务业知名品牌。目前，公司业务范围主要涵括三大系列，分别是广告服务模块、自助打印模块和一对一交换模块，再根据不同系列分为若干小系列。" />
    <meta name="Publisher" content="南充市区种树人广告公司" />
    <meta name="Copyright" content="Copyright 2016, 南充市区种树人广告公司. All rights reserved." />
    <meta name="Author" content="南充市区种树人广告公司" />
    <meta name="distribution" content="global" />
    <meta name="revisit-after" content="10 days" />
    <meta name="Robots" content="All" />
    <?php wp_head(); ?>
</head>

<?php 
	if( is_front_page()):
		$awesome_classes = array( 'awesome-class', 'my-class' );
	else:
		$awesome_classes = array( 'no-awesome-class' );
	endif;
 ?>

<body <?php body_class( $awesome_classes ); ?>>
	<header>
		<nav class="navbar navbar-default">
		  <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <a class="navbar-brand" href="<?php bloginfo( 'url' ); ?>">
                  <img src="<?php echo get_template_directory_uri().'/assets/images/logo.png' ?>" alt="brand-logo">
              </a>
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <h1 style="display: none">南充市种树人广告有限公司 - 主页::南充市种树人广告有限公司位于南充市顺庆区莲池路54号大学科技园大厦203-4号交通便利。南充市种树人广告有限公司本着“客户第一，诚信至上”的原则，欢迎国内外企业/公司/机构与本单位建立长期的合作关系。热诚欢迎各界朋友前来参观、考察、洽谈业务。游益然代表南充市种树人广告有限公司欢迎新老客户来电咨询。</h1>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <?php
                  wp_nav_menu( array(
                      'theme_location' 	=> 'primary',
                      'container'			=> false,
                      'menu_class'		=> 'nav navbar-nav'
                  ) ); ?>
              </div><!-- /.navbar-collapse -->

		  </div><!-- /.container-fluid -->
		</nav>
	</header>