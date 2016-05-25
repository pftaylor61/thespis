<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Thespis
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function Thespis_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'Thespis_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function Thespis_jetpack_setup
add_action( 'after_setup_theme', 'Thespis_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function Thespis_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function Thespis_infinite_scroll_render
