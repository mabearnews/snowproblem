<article <?php post_class( 'column post newscard' ); ?> style="background-image: url(<?php print get_the_post_thumbnail_url(); ?>);">

    <?php if ( has_post_thumbnail() ) : ?>
        <section className="entry-image-placeholder"></section>
    <?php endif; ?>

    <div class="post-date">
        <span class="month"><?php print get_the_date( 'M' ); ?></span>
        <span class="day"><?php print get_the_date( 'j' ); ?></span>
        <span class="year"><?php print get_the_date( 'y' ); ?></span>
    </div>

    <div class="post">

        <section class="categories">
            <?php
    		/* Print the categories beloning to the post. */
    		$categories = get_the_category();

    		foreach ( $categories as $category ) :
    			// Remove uncategorized posts.
    			if ( strtolower( $category->name ) == 'uncategorized' ) { continue; }
    		?>

                <div class="category">
                    <a href="<?php print get_category_link( $category->term_id ); ?>">
                        <?php print $category->name; ?>
                    </a>
                </div> <!-- .category -->

            <?php endforeach; ?>
        </section> <!-- .categories -->

        <header>

            <a href="<?php print get_permalink(); ?>">
                <?php the_title(); ?>
            </a>

        </header>

        <section class="post-content">

            <p><?php the_excerpt(); ?></p>

        </section>

        <footer>

            <?php snowproblem_posted_on(); ?>

        </footer>

    </div> <!-- .post -->
</article> <!-- .newscard -->
