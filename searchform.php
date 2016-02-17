<?php
/**
 * The template for displaying the physical search field.
 *
 * @package snowproblem
 */
?>
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

	<div id="search-exit"></div>

	<div class="search-container">

		<div class="field-container">
			<input type="text" class="search-field" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" />
		</div>

		<section class="search-results loaded-posts"></section>

	</div>

	<!-- <input type="submit" class="search-submit" value="<?php // print esc_attr_x( 'Search', 'submit button' ); ?>" /> -->

</form>
