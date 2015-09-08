<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package snowproblem
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Include the css -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/stylesheets/404.css" />

		<!-- Give a title -->
		<title>Page Not Found</title>
	</head>
	<body>
		<section id="content" style="background-image: url(<?php bloginfo('template_directory'); ?>/images/saturn-404.jpg)">
			<div id="astonaut">
				<img src="<?php bloginfo('template_directory'); ?>/images/astronaut-clip-art.png">
			</div>
			<section id="message">
				<span class="primary-text"><h1>Going, going, gone... We lost you</h1></span>
				<span class="go-home"><a href="<?php print get_home_url(); ?>">Send Him home</a></span>
			</section>
		</section> <!-- #content -->
	</body>
</html>
