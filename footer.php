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

			<section id="subscribe">
				<section class="footer-content">
					<!-- Begin MailChimp Signup Form -->
					<div id="mailchimp-signup">
						<form action="//machronicle.us12.list-manage.com/subscribe/post?u=451c6f9fe64374a773f510241&amp;id=efcd75d79e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

							<div class="field-container">
								<input type="email" placeholder="Subscribe" value="" name="EMAIL" class="required email" id="mce-EMAIL">
							</div>

							<div class="field-container">
								<input type="submit" id="submit-subscribe" name="submit" value="Subscribe" />
							</div>

						</form>
					</div>
				</section>

				<!--End mc_embed_signup-->
				</section>

			<section id="footer-location">

				<span class="location-text">555 Middlefield Road, Atherton, CA 94027</span>

			</section>

			<section id="credits">
				<section class="footer-content">
					<div class="credit"><span><a href="mailto:sequoia@sequoiasnow.com">Site Design by Sequoia Snow</a></span></div>
				</section>
			</section>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<?php if (is_front_page()) {?>

	<script type="text/javascript" src="<?php print get_template_directory_uri(); ?>/dist/js/front.js"></script>

<?php }?>


</body>
</html>
