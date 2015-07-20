<?php
/*
Plugin Name: Toggle Read More
Version: 1.0.0
Plugin URI: http://private.hibou-web.com
Description: When you add shortcode, it will action toggle. You can put this at paragraph or inside paragraph
Author: Shuhei Nishimura
Author URI: http://private.hibou-web.com
License: GPLv2 or later
License URI: http://opensource.org/licenses/gpl-2.0.php GPLv2
Domain Path: /languages
*/

if ( !defined( 'SC_READ_MORE_DOMAIN' ) )
	define( 'SC_READ_MORE_DOMAIN', 'sc_read_more' );

if ( !defined( 'SC_READ_MORE_PLUGIN_URL' ) )
	define( 'SC_READ_MORE_PLUGIN_URL', plugins_url() . '/' . dirname( plugin_basename( __FILE__ ) ) );

if ( !defined( 'SC_READ_MORE_PLUGIN_DIR' ) )
	define( 'SC_READ_MORE_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) );

load_plugin_textdomain( SC_READ_MORE_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * sc_read_more function.
 *
 * @access public
 * @param mixed $attrs
 * @param mixed $content (default: null)
 * @return void
 */
function sc_read_more( $attrs, $content = null ) {
	return "<span class='hide_expand'><a class='text_expand' href='#'>…続きを読む</a></span><div class='hide_obj'>$content</div>";
}
add_shortcode( 'more', 'sc_read_more' );

/**
 * Load javascript
 */
add_action( 'wp_enqueue_scripts', 'load_sc_read_more_js' );
function load_sc_read_more_js() {
	wp_enqueue_script(
		'sc_read_more_js',
		SC_READ_MORE_PLUGIN_URL . '/js/sc-read-more.js',
		array( 'jquery' ),
		date( 'YmdHis', filemtime( SC_READ_MORE_PLUGIN_DIR . '/js/sc-read-more.js' ) ),
		true
	);
	wp_enqueue_style(
		'sc_read_more_style',
		SC_READ_MORE_PLUGIN_URL . '/css/sc-read-more.css',
		'',
		date( 'YmdHis', filemtime( plugin_dir_path( __FILE__ ) . '/css/sc-read-more.css' ) ),
		'all'
	);
}