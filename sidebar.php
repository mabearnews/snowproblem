<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package snowproblem
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

function snowproblem_sidebar_posts( $title, $posts ) { ?>
	<article class="recent-posts">
		<div class="sb-title">
			<span><?php print $title; ?></span>
		</div>

		<ul class="sb-posts">
			<?php foreach ( $posts as $post ) : ?>

				<?php $permlink = get_permalink( $post['ID'] ); ?>

				<li class="sb-post <?php if ( ! has_post_thumbnail( $post['ID'] ) ) { print 'no-image'; } ?>">
					<a href="<?php print $permlink; ?>">
						<div class="sb-image" style="background-image: url(<?php print snowproblem_get_thumbnail_url('medium', $post['ID']); ?>)"></div>
					</a>
					<div class="sb-info">
						<a href="<?php print $permlink; ?>">
							<div class="sb-name"><?php print $post['post_title']; ?></div>
						</a>
						<div class="sb-date"><?php print get_the_date( 'F j, Y', $post['ID'] ); ?></div>
					</div>
				</li>

			<?php endforeach; ?>
		</ul>
	</article>
<?php } ?>


<div id="sidebar" class="widget-area" role="complementary">
	<?php snowproblem_sidebar_posts( 'Recent Posts', wp_get_recent_posts( array( 'numberposts' => 5 ) ) ) ?>

	<?php
	// Get popular posts via query
	$sb_query = new WP_Query( array(
		'meta_key'       => 'snowproblem_views_count',
        'orderby'        => 'meta_value_num',
		'order'		     => 'DESC',
        'posts_per_page' => 4,
	) );

	$popular_posts = array();

	while ( $sb_query->have_posts()) {
		$sb_query->the_post();
		$popular_posts[] = array(
			'ID' => get_the_ID(),
			'post_title' => get_the_title(),
		);
	}

	snowproblem_sidebar_posts( 'Popular', $popular_posts ); ?>

</div><!-- #sidebar -->
