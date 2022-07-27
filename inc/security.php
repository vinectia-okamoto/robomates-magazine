<?php
/**
 * セキュリティ設定.
 *
 * @package    WordPress
 * @since vinectia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
/******************************************************************************************
 * WPのバージョン番号のジェネレータタグを削除します。ハッカーはこれを使用して弱く古いWPのインストールを見つけます
 ******************************************************************************************/
function no_generator() {
	return '';
}
add_filter( 'the_generator', 'no_generator' );

/******************************************************************************************
 * Wp_headの不必要なもの削除
 * Clean up wp_head() from unused or unsecure stuff
*/
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );

// rel="canonical"が不要.
remove_action( 'wp_head', 'rel_canonical' );


// oembedを無効.
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );



// api* .w.orgリンクの削除.
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );




/******************************************************************************************
 * Wp_enqueue_styleとかから 余計な情報をとる
 *
 * @param string $tag タグ.
 ******************************************************************************************/
function remove_script_type( $tag ) {
	$tag = preg_replace( array( "| type='.+?'s*|", "| id='.+?'s*|", "| media='.+?'s*|", '| />|' ), array( ' ', ' ', '>' ), $tag );
	return $tag;
}
add_filter( 'script_loader_tag', 'remove_script_type' );

/******************************************************************************************
 * Wp_enqueue_scriptとかから 余計な情報をとる
 *
 * @param string $tag タグ.
 ******************************************************************************************/
function remove_style_type( $tag ) {
	$tag = preg_replace( array( "| type='.+?'s*|", "| id='.+?'s*|", '| />|' ), array( ' ', ' ', '>' ), $tag );
	return $tag;
}
add_filter( 'style_loader_tag', 'remove_style_type' );


/******************************************************************************************
 * セキュリティのためにログインに失敗した場合、ユーザーに情報を表示しないようにする。
 * (有効なユーザー名がわからないようにする)
 ******************************************************************************************/
function show_less_login_info() {
	return '<strong>エラー</strong>: 推測停止';
}

add_filter( 'login_errors', 'show_less_login_info' );

/******************************************************************************************
 * Recentcommentsを消す
 ******************************************************************************************/
function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

/******************************************************************************************
 * XML-RPCを無効.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/******************************************************************************************
 * X-Pingbackをとる
 *
 * @param string $headers ヘッダー情報.
 ******************************************************************************************/
function remove_x_pingback( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
}
add_filter( 'wp_headers', 'remove_x_pingback' );

/**************************************************
 * 投稿者アーカイブ非表示リダイレクト（セキュリティ対策）
 **************************************************/
function author_archive_redirect() {
	if ( is_author() ) {
		wp_safe_redirect( home_url() );
		exit;
	}
}
add_action( 'template_redirect', 'author_archive_redirect' );



/**************************************************
/* 画像だけのページにnoindexを設定する
 **************************************************/
function my_add_noindex_to_attachment_page() {
	if ( is_attachment() ) {
		echo '<meta name="robots" content="noindex,nofollow">';
	}
}
add_action( 'wp_head', 'my_add_noindex_to_attachment_page' );
