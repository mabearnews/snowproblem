<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package snowproblem
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'column post post-front' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php print get_permalink(); ?>">
			<div class="entry-image">

				<?php the_post_thumbnail( 'large' ); ?>

			</div>
		</a>
	<?php endif; ?>

	<section class="post-categories">
		<?php
		/* Print the categories beloning to the post. */
		$categories = get_the_category();

		foreach ( $categories as $category ) :
			// Remove uncategorized posts.
			if ( strtolower( $category->name ) == 'uncategorized' ) { continue; }
		?>

			<div class="category">
				<a href="<?php print esc_url( get_category_link( $category->term_id ) ); ?>">
					<span class="title">
						<?php print $category->name; ?>
					</span>
				</a>
			</div>

		<?php endforeach; ?>
	</section>

	<section class="post-content">

		<header class="entry-header">
			<a href="<?php print get_permalink(); ?>" title="<?php print  __('Read More', 'snowproblem'); ?>" rel="bookmark"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php snowproblem_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	</section>
	<!-- Shows the background of the site with the vertical slant as specified. -->
	<div class="background"></div>
</article><!-- #post-## -->
