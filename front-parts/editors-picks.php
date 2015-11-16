<?php
/**
 * A section to show some of the editors picks of stories so there is
 * an increased differentiation of posts!
 *
 */

query_posts( array(
    'posts_per_page' => 5,
    'category_name'  => 'editors-picks',
    'orderby'        => 'date',
    'order'  		 => 'DESC',
) ); ?>
<?php if ( have_posts() ) : ?>

    <section id="editors-picks" class="front-category">

        <div id="editors-picks-container" add-hover-class="last-hovered">

            <article class="pick first title">
                <div class="editors-picks-title">
                    <h1>Editors Picks</h1>
                </div>
            </article>

            <?php /* Info about how this is the editors picks... */ ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                /**
                 * Include content speciffically of the 'editors-pick' type.
                 */
                get_template_part( 'template-parts/content', 'editors-pick' );

                // Ensure the item is loaded with an id.
                $loaded_posts[]= get_the_ID();
                ?>

            <?php endwhile; ?>

        </div> <!-- #editors-picks-container -->

    </section> <!-- #editors-picks -->

<?php endif; ?>
<?php wp_reset_query(); ?>
