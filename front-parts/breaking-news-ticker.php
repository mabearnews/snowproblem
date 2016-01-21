<?php query_posts('post_type=breaking_news_ticker&orderby=date&order=DESC'); /* Query all posts of 'breaking_news' type.*/ ?>
<?php if ( have_posts() ) : ?>

    <section id="breaking-news-ticker">

        <section id="breaking-news-items">
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                    /**
                     * Include content speciffically of the 'featured' type.
                     */
                    get_template_part( 'template-parts/breaking' );
                    ?>

                <?php endwhile; ?>
            <?php wp_reset_query(); /* Reset for all posts. */ ?>
        </section> <!-- #breaking-news-items -->

    </section> <!-- #breaking-news-ticker -->

<?php endif; ?>
