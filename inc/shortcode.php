<?php
/**
 * ショートコード Function
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php

/**************************************************
 * サイトのURLを出力[url]
 **************************************************/
function shortcode_url() {
	return get_bloginfo( 'url' );
}
add_shortcode( 'site_url', 'shortcode_url' );


/**
 * テンプレート・ディレクトリへのパス[template]
 * <a href="[url]"><img src="[template_url]/images/sample.png"></a>
 */
function shortcode_tp() {
	return get_template_directory_uri();
}
add_shortcode( 'template_url', 'shortcode_tp' );

function function_name( $return_value ) {
	$reflect_items = array( '[template_url]' );
	foreach ( $reflect_items as $item ) {
		$shortcode[] = do_shortcode( $item );
	}
	return str_replace( $reflect_items, $shortcode, $return_value );
}
add_filter( 'format_for_editor', 'function_name' );


/**************************************************
 * アップロード・ディレクトリへのパス[uploads]
 * <a href="[url]"><img src="[uploads_url]/sample.png"></a>
 */
function shortcode_up() {
	$upload_dir = wp_upload_dir();
	return $upload_dir['baseurl'];
}
add_shortcode( 'uploads_url', 'shortcode_up' );

/**************************************************
 * WordPress をインストールしたディレクトリ[wp_url]
 * <a href="[url]"><img src="[wp_url]/images/sample.png"></a>
 */
function shortcode_wpurl() {
	return get_bloginfo( 'wpurl' );
}
add_shortcode( 'wp_url', 'shortcode_wpurl' );



/**************************************************
 * [get_privacycontent post_id=""]
 **************************************************/
function get_privacycontent_func( $atts ) {

	// post_idが省略された場合のデフォルト値設定
	$a = shortcode_atts(
		array(

			'post_id' => url_to_postid( get_privacy_policy_url() ),
		),
		$atts,
		'get_privacycontent'
	);

	// 【値取得】
	// ショートコードのpost_idを取得
	$id = $a['post_id'];
	// post_idから投稿情報取得
	$post = get_post( $id );

	// 投稿本文取得
	if ( $post->post_content ) {
		$content = '<div class="privacyBox">' . $post->post_content . '</div>';
	}

	return $content;

}
add_shortcode( 'get_privacycontent', 'get_privacycontent_func' );
