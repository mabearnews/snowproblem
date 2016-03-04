<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package snowproblem
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'snowproblem' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'snowproblem' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'snowproblem' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'snowproblem' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'snowproblem_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function snowproblem_posted_on( $date_format = '' ) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	// Remove updated timestamp
	// if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
	// 	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	// }

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( $date_format ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'snowproblem' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'snowproblem' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'snowproblem_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function snowproblem_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list();
		if ( $categories_list && snowproblem_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'snowproblem' ) . '</span>', $categories_list, $tags_list ); // WPCS: XSS OK.
		}
	}


	edit_post_link( esc_html__( 'Edit', 'snowproblem' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( '%s', 'snowproblem' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'snowproblem' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'snowproblem' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'snowproblem' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'snowproblem' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'snowproblem' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'snowproblem' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'snowproblem' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'snowproblem' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'snowproblem' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'snowproblem' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'snowproblem' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'snowproblem' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'snowproblem' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function snowproblem_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'snowproblem_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'snowproblem_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so snowproblem_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so snowproblem_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in snowproblem_categorized_blog.
 */
function snowproblem_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'snowproblem_categories' );
}
add_action( 'edit_category', 'snowproblem_category_transient_flusher' );
add_action( 'save_post',     'snowproblem_category_transient_flusher' );

/**
 * Social media icon menu.
 */
function snowproblem_social_menu() {
	if ( has_nav_menu( 'social') ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'container' 	  => 'div',
				'container_id'    => 'social-menu',
				'container_class' => 'menu',
				'menu_id' 		  => 'social-menu-items',
				'menu_class' 	  => 'menu-items',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'depth' 		  => 1,
				'fallback_cb'	  => '',
			)
		);
	}
}

/**
 * Primary menu creation.
 */
function snowproblem_primary_menu() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container' 	  => 'div',
				'container_id'    => 'primary-menu',
				'container_class' => 'menu',
				'menu_id' 		  => 'primary-menu-items',
				'menu_class' 	  => 'menu-items',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'depth' 		  => 5,
				'fallback_cb'	  => '',
			)
		);
	}
}

/**
 * Returns a featured image url if one exists.
 */
function snowproblem_get_thumbnail_url( $id = null ) {
	if ( ! $id ) { $id = $post->ID; }
	if ( has_post_thumbnail( $id ) ) {
		return wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' )[0];
	}
	return '';
}


/**
 * Query posts using thd exclude ids array as a reference. Note, this requires
 * the presence of the global variable exclude_ids, it will query a post and
 * then apply a function to each post in the loop, after some cursory inspection
 * of the loop. Does not work particularly well if there are few of a certain post,
 * or the posts have already been loaded.
 *
 * @param array $query
 * @param callback $func
 */
function snowproblem_excluded_query( array $query, callable $func) {
	global $exclude_ids;

	$numb_posts = isset( $query['numberposts'] ) ? $query['numberposts'] : -1;

	if ( $numb_posts != -1 ) {
		$query['numberposts'] = $query['numberposts'] + 10;
	}

	query_posts( $query );

	while ( have_posts() ) {
		the_post();

		// Ensure the post is not already loaded.
		if ( in_array( get_the_ID(), $exclude_ids ) ) { continue; }

		// Ensure that the number of posts desired is not exeeded.
		if ( $numb_posts-- == 0 ) { break; }

		// Allow future uses of this function to work.
		$exclude_ids[] = get_the_ID();

		// Execute the callback, at this point, all tests have been passed.
		$func();
	}

	wp_reset_query();
}
