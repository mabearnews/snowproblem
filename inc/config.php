<?php
/// Enable comments on the site.
define( 'SNOWPROBLEM_COMMENTS_ALLOWED', true );

/**
 * Definitions for the social media links, this allows posts to
 * be shared via the file in 'template-parts/content-social-share'
 *
 * Both the url and the message are customized here.
 */
function snowproblem_twitter_url() {
  return 'https://twitter.com/intent/tweet?text='  . urlencode( html_entity_decode( get_the_title() ) ) . '&url=' . get_the_permalink();
}

function snowproblem_facebook_url() {
    return 'https://www.facebook.com/sharer/sharer.php?s=100' .
      '&p[title]='     . urlencode( html_entity_decode( get_the_title() ) ) .
      '&p[url]='       . urlencode( get_the_permalink() ) .
      '&p[images][0]=' . urlencode( snowproblem_get_thumbnail_url() );

}

function snowproblem_reddit_url() {
    return 'http://www.reddit.com/submit?' .
      'url='       . urlencode( get_the_permalink() ) .
      '&title='     . urlencode( html_entity_decode( get_the_title() ) );
}

function snowproblem_googleplus_url() {
    return 'https://plus.google.com/share?url=' . urlencode( get_the_permalink() );
}
