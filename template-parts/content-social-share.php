<?php
/**
 * @package snowproblem
 *
 * Set up the social media links to share a post for the current post.
 *
 * This should only be shown on standard single page sites.
 */ ?>

<article id="social-share">

    <header class="title">
        <span>Share</span>
    </header>

    <ul class="social-media-links">

        <li>
            <a href="<?php print snowproblem_twitter_url(); ?>" target="_blank">
                <span>Twitter</span>
            </a>
        </li>

        <li>
            <a href="<?php print snowproblem_facebook_url(); ?>" target="_blank">
                <span>Facebook</span>
            </a>
        </li>

        <li>
            <a href="<?php print snowproblem_reddit_url(); ?>" target="_blank">
                <span>Reddit</span>
            </a>
        </li>

        <li>
            <a href="<?php print snowproblem_googleplus_url(); ?>" target="_blank">
                <span>Google+</span>
            </a>
        </li>

    </ul>

</article> <!-- #social-media -->
