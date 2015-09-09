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

	<?php if ( is_active_sidebar( 'footer' ) ): ?>
		<footer id="primary-footer">
			<section class="widget-container masonry-grid">
				<?php dynamic_sidebar( 'footer' ); ?>
			</section>

			<section class="contact">

			</section>

			<section class="credits">
				
			</section>

		</footer>
	<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</div> <!-- #base-wrapper -->
</body>
</html>
