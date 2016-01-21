<article <?php post_class( 'pick' ); ?> id="first-editors-pick" >

    <?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php print get_permalink(); ?>">
			<div class="entry-image">

				<?php the_post_thumbnail( 'large' ); ?>

			</div>
		</a>
	<?php endif; ?>

    <div class="post-content">

        <div class="post-name">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </diV>

        <div class="author-name">
            <a href="<?php print get_author_posts_url( get_the_author_ID() ); ?>"><?php the_author(); ?></a>
        </div>

    </div> <!-- .post-content -->
</article>
