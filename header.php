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

    <?php
      // Google analytics
      include_once("analyticstracking.php");
    ?>

</head>

<body <?php body_class(); ?>>

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

		<!-- Site Name -->
		<section id="site-title-wrapper" class="container">
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<!-- <img src="<?php print get_template_directory_uri(); ?>/images/logo-full.svg" /> -->
					<?php print bloginfo('name'); ?>
				</a>
		</section>

		<!-- Primary Menu  -->
		<?php snowproblem_primary_menu(); ?>

		<!-- Social Menu -->
		<?php snowproblem_social_menu(); ?>

		<section id="search-toggle">
			<span class="fa fa-search"></span>
		</section>
		</div> <!-- .center-vertical-child-flex -->
	</div> <!-- .wrapper -->

</nav><!-- #site-navigation -->

<?php get_search_form( true ); ?>

<?php
// Shows the social menu sidebar on most pages.
if ( 0 && ! is_home() ) : ?>

	<div id="social-menu-sidear">

		<?php snowproblem_social_menu(); ?>

	</div>

<?php endif; ?>

<div id="page" class="hfeed site">
	<div class="content-container container">
	<div id="content" class="site-content">
		<div id="content-nav-bar-padding"></div>
