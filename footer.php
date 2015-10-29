<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package snowproblem
 */

?>

		</div><!-- #content -->
	</div><!-- .content-container.container -->


	<footer id="primary-footer">
		<?php if ( is_active_sidebar( 'footer' ) ): ?>

			<section class="widget-container masonry-grid">
				<?php dynamic_sidebar( 'footer' ); ?>
			</section>

		<?php endif; ?>

		<section class="contact">
			<div class="column">
				<div class="location">

				</div>
			</div>
		</section>

		<section class="credits">
			<div class="credit"><span><a href="mailto:sequoia@sequoiasnow.com">Site Design by Sequoia Snow</a></span></div>
		</section>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
