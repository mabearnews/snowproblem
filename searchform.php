<?php
/**
 * The template for displaying the physical search field.
 *
 * @package snowproblem
 */
?>
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

	<div class="search-container">

		<div class="field-container">
			<div id="search-exit"></div>
			<input type="text" class="search-field" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" />
		</div>

	</div>

	<section class="search-results"></section>

	<!-- <input type="submit" class="search-submit" value="<?php // print esc_attr_x( 'Search', 'submit button' ); ?>" /> -->

</form>
