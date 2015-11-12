
<article class="pick" id="first-editors-pick" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">

    <div class="author-name">
        <a href="<?php print get_author_posts_url( get_the_author_ID() ); ?>"><?php the_author(); ?></a>
    </div>


    <div class="post-name">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </diV>

</article>
