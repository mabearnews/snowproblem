<?php query_posts( array(
    'posts_per_page' => 5,
    'category_name'  => 'featured',
    'orderby'        => 'date',
    'order'          => 'DESC',
) ); /* Query all posts with 'featured' category. Maximum of 5. */ ?>

<?php if ( have_posts() ): ?>

    <section id="featured">
        <section id="featured-posts">
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                    /**
                     * Include content speciffically of the 'featured' type.
                     */
                    get_template_part( 'template-parts/content', 'featured' );

                    // Ensure the item is loaded with an id.
                    $loaded_posts[]= get_the_ID();
                    ?>

                <?php endwhile; ?>
        </section> <!-- #featured-posts -->
    </section> <!-- #featured -->

<?php endif; ?>
<?php wp_reset_query(); /* Reset for all posts. */ ?>
