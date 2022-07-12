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
add_shortcode( 'site_url', 'shortcode_url' );
function shortcode_url() {
	return get_bloginfo( 'url' );
}



/**************************************************
* テンプレート・ディレクトリへのパス[template]
* <a href="[url]"><img src="[template_url]/images/sample.png"></a>
*/
add_shortcode( 'template_url', 'shortcode_tp' );
function shortcode_tp() {
	return get_template_directory_uri();
}

add_filter( 'format_for_editor', 'function_name' );

function function_name( $return_value ) {

	$reflect_items = array( '[template_url]' );

	foreach ( $reflect_items as $item ) {

		$shortcode[] = do_shortcode( $item );
	}

	return str_replace( $reflect_items, $shortcode, $return_value );
}

/**************************************************
* アップロード・ディレクトリへのパス[uploads]
* <a href="[url]"><img src="[uploads_url]/sample.png"></a>
*/
add_shortcode( 'uploads_url', 'shortcode_up' );
function shortcode_up() {
	$upload_dir = wp_upload_dir();
	return $upload_dir['baseurl'];
}

/**************************************************
* WordPress をインストールしたディレクトリ[wp_url]
* <a href="[url]"><img src="[wp_url]/images/sample.png"></a>
*/

add_shortcode( 'wp_url', 'shortcode_wpurl' );
function shortcode_wpurl() {
	return get_bloginfo( 'wpurl' );
}


/**************************************************
* <a href="[pagelink id=" 投稿ID"]"></a>
* <a href="[pagelink slug=" スラッグ"]"></a>
*/
add_shortcode( 'pagelink', 'linkpage_func' );
function linkpage_func( $atts ) {
	extract(
		shortcode_atts(
			array(
				'id'   => '', // 投稿ID
				'slug' => '', // ページスラッグ
			),
			$atts
		)
	);
	$my_url = home_url( '/' );
	if ( $slug ) { // スラッグを指定したときに投稿IDを取得する
		$id = url_to_postid( $my_url . $slug );
	}
	$link = get_permalink( $id );
	// $title = get_the_title($id); //投稿IDで指定した投稿のレコードをデータベースから取得
	// return '<a href="'. $link .'"' .'>'. $title. '</a>';
	return $link;
}


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




/**************************************************
* 内部リンクをショートコードで指定する[get_postlink]
https://blog.s-giken.net/272.html

* <a href="[url]"><img src="[wpurl]/images/sample.png"></a>

* id　　[get_postlink id=数字]
* リンク対象を Post IDを指定します。デフォルトは「0」。
　
* slug [get_postlink slug=スラッグ]
* リンク対象を slugで指定します。
* ただし、正確にはページのパスを指定します。詳細は後述しています。
* デフォルト値はなく、slugに入力がある場合は、idより優先的に処理を行います。
　
* postpage [get_postlink slug=autolink postpage=post anchorlink=aaa anchortext=あああ]
* リンク対象の投稿タイプを指定します。
* 投稿は「post」、固定ページは「page」、カスタム投稿は「カスタム投稿の slug」を指定します。
* デフォルト値は「post」。
　
* anchorlink
* アンカーリンクを設定する場合は、アンカーのテキストを指定します。
　
* anchortext
* アンカーリンクを設定するときにタイトルに追加するテキストを指定します。
*/
add_shortcode( 'get_postlink', 'shortcode_func' );

function shortcode_func( $arg ) {
	extract(
		shortcode_atts(
			array(
				'id'         => 0,
				'slug'       => '',
				'postpage'   => 'post',
				'anchorlink' => '',
				'anchortext' => '',
			),
			$arg
		)
	);

	$html        = '';
	$post_object = '';

	if ( $slug ) {
		$post_object = get_page_by_path( $slug, OBJECT, $postpage );
	} elseif ( $id != 0 ) {
		$post_object = get_post( $id );
	}

	if ( $post_object ) {
		if ( $anchorlink ) {
			$anchorlink = '#' . $anchorlink;
		}
		if ( $anchortext ) {
			$anchortext = '／' . $anchortext;// 「／」で区切った後につなげる仕様になっています。
		}
		$html = '<a href=' . get_permalink( $post_object->ID ) . $anchorlink . $post_object->post_title . $anchortext . '</a>';
	}

	return $html;
}
