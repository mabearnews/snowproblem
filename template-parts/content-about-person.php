<article class="person">

    <?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

    <div class="author">

        <span class="author vcard">
            <a class="url" href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php print esc_html( get_the_author() ); ?></a>
        </span>

    </div> <!-- .author -->

    <div class="position">
        <?php the_title(); ?>
    </div>


    <div class="description">
        <?php the_content(); ?>
    </div>

</article> <!-- nperson -->
