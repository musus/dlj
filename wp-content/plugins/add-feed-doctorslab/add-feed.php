<?php
/*
Plugin Name: Add Feed
Plugin URI:
Description: 独自のフィードを追加します。有効化後に「パーマリンク設定」で「変更を保存」をクリックしてください。
Author: Susumu Seino
Version: 1.0.0
Author URI: https://susu.mu
*/


/*
 定数を設定
----------------------------*/
if ( ! defined( 'ADD_FEED_PLUGIN_DIR' ) ) {
	define( 'ADD_FEED_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) );
}

//ページ分割タグを取り除く
function remove_nextpage_tag( $post ) {
	global $pages, $multipage, $numpages;
	$multipage = 0;

	//<!--nextpage-->を置換して取り除く
	$content = str_replace( "\n<!--nextpage-->\n", '<!--nextpage-->', $post->post_content );
	$content = str_replace( "\n<!--nextpage-->", '<!--nextpage-->', $content );
	$content = str_replace( "<!--nextpage-->\n", '<!--nextpage-->', $content );
	$pages   = array( str_replace( '<!--nextpage-->', '', $content ) );

	$numpages = 1;
}

/*
 フィードを追加
----------------------------*/
function custom_rss_init() {
	add_feed( 'custom', 'custom_rss' );
}

add_action( 'init', 'custom_rss_init' );


function custom_rss() {
	$feed_template = ADD_FEED_PLUGIN_DIR . '/lib/feed-custom.php';
	load_template( $feed_template );
}

// add mamatenna
function custom_rss_init_mamatenna() {
	add_feed( 'custom_mamatenna', 'custom_rss_mamatenna' );
}

add_action( 'init', 'custom_rss_init_mamatenna' );


function custom_rss_mamatenna() {
	$feed_template = ADD_FEED_PLUGIN_DIR . '/lib/feed-custom-mamatenna.php';
	load_template( $feed_template );
}

// add ranune
function custom_rss_init_ranune() {
	add_feed( 'custom_ranune', 'custom_rss_ranune' );
}

add_action( 'init', 'custom_rss_init_ranune' );


function custom_rss_ranune() {
	$feed_template = ADD_FEED_PLUGIN_DIR . '/lib/feed-custom-ranune.php';
	load_template( $feed_template );
}


// change feed count
function change_feed( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_feed() ) {
		add_action( 'the_post', 'remove_nextpage_tag' );
	}
}

add_action( 'pre_get_posts', 'change_feed' );
