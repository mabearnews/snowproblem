<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package snowproblem
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- #sidebar -->
<?php get_sidebar(); ?>

<!-- Primary Submenu Navigation -->
<section id="site-navigation-more"></section>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class="wrapper">
		<section id="menu-toggle"  class="menu-toggle recieves-toggles">
			<div class="toggle container">
				<div class="row"></div>
				<div class="row"></div>
				<div class="row"></div>
			</div>
		</section>
		<!-- Primary Menu  -->
		<?php snowproblem_primary_menu(); ?>

		<!-- Site Name -->
		<section id="site-title-wrapper" class="container">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</section>

		<!-- Social Menu -->
		<?php snowproblem_social_menu(); ?>

		<!-- Sidebar Toggle -->
		<div class="center-vertical-child-flex">
			<section id="sidebar-toggle">
				<div class="toggle container">
					<div class="row">
						<div class="dot"></div>
						<div class="dash"></div>
					</div>
					<div class="row">
						<div class="dot"></div>
						<div class="dash"></div>
					</div>
					<div class="row">
						<div class="dot"></div>
						<div class="dash"></div>
					</div>
				</div> <!-- .toggle.container -->
			</section> <!-- #sidebar-toggle -->
		</div> <!-- .center-vertical-child-flex -->
	</div> <!-- .wrapper -->

</nav><!-- #site-navigation -->

<div id="page" class="hfeed site">
	<div class="content-container container">
	<div id="content" class="site-content">
		<div id="content-nav-bar-padding"></div>
