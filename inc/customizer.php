<?php
/**
 * snowproblem Theme Customizer.
 *
 * @package snowproblem
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function snowproblem_customize_register( $wp_customize ) {
	
}
add_action( 'customize_register', 'snowproblem_customize_register' );

// /**
//  * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
//  */
// function snowproblem_customize_preview_js() {
// 	wp_enqueue_script( 'snowproblem_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
// }
// add_action( 'customize_preview_init', 'snowproblem_customize_preview_js' );
