<?php
/**
 * テンプレートタグ Function
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
if ( ! function_exists( 'get_image_sizes' ) ) {
	/**
	 * WordPressの画像サイズを取得できる.
	 *
	 * 以下はサイズをすべて取得.
	 * var_dump( get_image_sizes() );
	 * 以下はサイズを指定する例.
	 * var_dump( get_image_sizes( 'large' ) );
	 *
	 * @param string $size  サイズ.
	 */
	function get_image_sizes( $size = '' ) {

		global $_wp_additional_image_sizes; // add_image_size()で追加されたサイズの配列.

		$sizes                        = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info.
		foreach ( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		// Get only 1 size if found.
		if ( $size ) {
			if ( isset( $sizes[ $size ] ) ) {
				return $sizes[ $size ];
			} else {
				return false;
			}
		}
		return $sizes;
	}
}

if ( ! function_exists( 'theme_posted_on' ) ) {
	/**
	 * 現在の投稿日時のメタ情報を含むHTMLを印刷
	 */
	function theme_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$d        = 'Ymd';
		$postdate = get_post_time( $d );
		$update   = get_post_modified_time( $d );
		if ( $postdate == $update ) { // 投稿の投稿日と最終更新日が同じ場合.
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		} else { // 投稿の投稿日と最終更新日が異なる場合.
			$time_string = '<time class="entry-date published" datetime="%1$s">投稿日：%2$s</time> / <time class="entry-date updated" datetime="%3$s">更新：%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		printf(
			'<span class="posted-on">%2$s</span>',
			esc_url( get_permalink() ),
			wp_kses_post( $time_string )
		);
	}
}


if ( ! function_exists( 'vinectia_entrymeta' ) ) {
	/**
	 * カテゴリ、タグ、コメントのメタ情報を含むHTMLを印刷
	 */
	function vinectia_entrymeta() {
		 // ページの作成者、投稿日、カテゴリ、タグテキストを非表示.
		if ( 'post' === get_post_type() ) {
			// Posted on上からもってくる.
			theme_posted_on();
			// リスト項目間に使用され、コンマの後にスペースがあります.
			// @codingStandardsIgnoreStart
			// if ('column' === get_post_type()){
			// $postID = get_the_ID();
			// $categories_list = get_the_term_list( $postID, 'column_category', '',', ');
			// }else{
			// $categories_list = get_the_category_list( ', ');
			// }
			// @codingStandardsIgnoreEnd
			$categories_list = get_the_category_list( ', ' );
			if ( $categories_list ) {
				printf(
					'<span class="entry-category">%1$s</span>',
					$categories_list
				); // WPCS: XSS OK.
			}
		}
	}
}


/**
 * ソーシャルリンクメニューにSVGアイコンを表示します。
 *
 * @param string  $item_output メニュー項目の出力。
 * @param WP_Post $item メニュー項目オブジェクト。
 * @param int     $depth メニューの深さ。
 * @param array   $args wp_nav_menu()引数。
 * @return string $item_output ソーシャルアイコン付きのメニュー項目出力。
 */
function vinectia_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	 // サポートされているURLがある場合、ソーシャルリンクメニュー内のSVGアイコンを変更します。
	if ( 'socialMenu' === $args->theme_location ) {
		$svg = vinectia_SVG_Icons::get_social_link_svg( $item->url );
		if ( empty( $svg ) ) {
			$svg = vinectia_get_theme_svg( 'link' );
		}
		$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'vinectia_nav_menu_social_icons', 10, 4 );

/**
 * クラス
 */
/**
 * JavaScriptのサポートがない場合、HTML要素には非JavaScriptクラスが含まれます。
 */
function vinectia_no_js_class() {
	?>
<script>
document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
</script>
	<?php

}

add_action( 'wp_head', 'vinectia_no_js_class' );

/**
 * 条件付きボディクラスを追加します。
 *
 * @param array $classes bodyタグに追加されたクラス。
 *
 * @return array $classes bodyタグに追加されたクラス。
 */
function vinectia_body_classes( $classes ) {
	global $post;
	$post_type = isset( $post ) ? $post->post_type : false;

	// Singularチェック
	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	// 現在のページに全幅のコンテンツがあるかどうかを確認します。
	if ( is_page_template( array( 'templates/template-full-width.php' ) ) ) {
		$classes[] = 'has-full-width-content';
	}

	// 有効な検索を確認します。
	if ( true === get_theme_mod( 'enable_header_search', true ) ) {
		$classes[] = 'enable-search-modal';
	}

	// 投稿のサムネイルを確認します。
	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	} elseif ( is_singular() ) {
		$classes[] = 'missing-post-thumbnail';
	}

	// カスタマイザプレビューが表示されているかどうかを確認します。
	if ( is_customize_preview() ) {
		$classes[] = 'customizer-preview';
	}

	// 投稿に単一のページ付けがあるかどうかを確認します。
	if ( is_single() && ( get_next_post() || get_previous_post() ) ) {
		$classes[] = 'has-single-pagination';
	} else {
		$classes[] = 'has-no-pagination';
	}

	// フッターの上部に出力されている要素を確認します。
	$has_footer_menu = has_nav_menu( 'footerMenu' );
	$has_social_menu = has_nav_menu( 'socialMenu' );
	$has_sidebar_1   = is_active_sidebar( 'sidebar-1' );
	$has_sidebar_2   = is_active_sidebar( 'sidebar-2' );

	// これらの要素が出力されるかどうかを示すクラスを追加します。
	if ( $has_footer_menu || $has_social_menu || $has_sidebar_1 || $has_sidebar_2 ) {
		$classes[] = 'footer-top-visible';
	} else {
		$classes[] = 'footer-top-hidden';
	}

	return $classes;
}

add_filter( 'body_class', 'vinectia_body_classes' );

/**
 * アーカイブ
 */
/**
 * アーカイブのタイトルをフィルタリングし、最初のコロンの前の単語のスタイルを設定します。
 *
 * @param string $title　現在のアーカイブのタイトル。
 *
 * @return string $title　現在のアーカイブのタイトル。
 */
function vinectia_get_the_archive_title( $title ) {
	$regex = apply_filters(
		'vinectia_get_the_archive_title_regex',
		array(
			'pattern'     => '/(\A[^\:]+\:)/',
			'replacement' => '<span class="color-accent">$1</span>',
		)
	);

	if ( empty( $regex ) ) {

		return $title;
	}

	return preg_replace( $regex['pattern'], $regex['replacement'], $title );
}

add_filter( 'get_the_archive_title', 'vinectia_get_the_archive_title' );

/**
 * 雑多なもの
 */
/**
 * アニメーション時間をミリ秒単位で切り替えます。
 *
 * @return integerミリ秒単位の継続時間
 */
function vinectia_toggle_duration() {
	/**
	  *サブメニューの切り替えに通常使用されるアニメーションの継続時間/速度をフィルタリングします。
	  *
	  * @since vinectia 1.0
	  *
	  * @param integer $durationミリ秒単位の期間。
	  */
	$duration = apply_filters( 'vinectia_toggle_duration', 250 );

	return $duration;
}

/**
 * Get unique ID.取得
 *
 * これはUnderscoreのuniqueIdメソッドのPHP実装です。 静的変数は、呼び出しごとに増加する整数を含みます。 この番号が返されます
 * オプションの接頭辞。 そのため、戻り値は普遍的に一意ではありません。しかし、これはPHPプロセスの存続期間を通じて固有です。
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function vinectia_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}


/****************************************
 * 記事本文の最初の画像を取得 なければノーイメージ
 */
if ( ! function_exists( 'catch_that_image' ) ) {
	function catch_that_image() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

		$first_img = $matches[1][0];

		if ( empty( $first_img ) ) { // Defines a default image
			$first_img = get_template_directory_uri() . '/asetts/images/common/noimage.png';
		}
		return $first_img;
	}
}

/****************************************
 * 記事本文の最初の画像を取得2
 ****************************************/
// $get_size: 取得する画像のサイズ
// $altimg_id: 代替画像のID。（画像はあらかじめメディアライブラリからアップロードしておく）
// nullの場合、投稿内に画像が無ければ何も出力しない
function catch_thumbnail_image( $get_size = 'thumbnail', $altimg_id = null ) {
	global $post;
	$image     = '';
	$image_get = preg_match_all( '/<img.+class=[\'"].*wp-image-([0-9]+).*[\'"].*>/i', $post->post_content, $matches );
	if ( $image_get ) {
		$image_id = $matches[1][0];
	} else {
		$image_id = $matches[0];
	}

	if ( ! $image_id && $altimg_id ) {
		$image_id = $altimg_id;
	}

	$image = wp_get_attachment_image(
		$image_id,
		$get_size,
		false,
		array(
			'class' => 'thumbnail-image',
			'alt'   => $post->post_title,
			// 'srcset' => wp_get_attachment_image_srcset( $image_id, $get_size ),
			'sizes' => wp_get_attachment_image_sizes( $image_id, $get_size ),
		)
	);
	if ( empty( $image ) ) {
		if ( $get_size == 'custom_600x400' ) {
			$imgurl = get_template_directory_uri() . '/asetts/images/common/noimage-custom_600x400.png';
		} elseif ( $get_size == 'thumbnail' ) {
			$imgurl = get_template_directory_uri() . '/asetts/images/common/noimage-thumbnail.png';
		} else {
			$imgurl = get_template_directory_uri() . '/asetts/images/common/noimage.png';
		}
		$image = '<img src="' . $imgurl . '" alt="">';
	}
	return $image;
}


/****************************************
 * 固定ページの最上親ページを取得する
 ****************************************/
function get_most_parent_page( $current_id = '' ) {
	 global $post;
	if ( $current_id == '' ) {
		$current_id == $post->ID;
	}
	$current_post = get_post( $current_id );
	$par_id       = $current_post->post_parent;
	while ( $par_id != 0 ) :
		$par_post     = get_post( $par_id );
		$current_post = $par_post;
		$par_id       = $par_post->post_parent;
	endwhile;
	return $current_post;
}

/****************************************
 * 現在使用しているカスタム投稿タイプ名を取得する
 * $always_ignore_post_types = array( 'xxx' );
 * ↑こうしていするとXXXが除外
 * nxw_get_custom_post_types();
 * nxw_get_custom_post_types( 'yyy' );//yyy除外
 */
if ( ! function_exists( 'nxw_get_custom_post_types' ) ) {
	function nxw_get_custom_post_types( $ignore_post_types = '' ) {
		 $always_ignore_post_types = array( '{post_type}' );

		if ( ! is_array( $ignore_post_types ) ) {
			$ignore_post_types = $ignore_post_types ? array( $ignore_post_types ) : array();
		}

		$args = array(
			'public'   => true,
			'_builtin' => false,
		);
		return array_diff( get_post_types( $args ), array_merge( $always_ignore_post_types, $ignore_post_types ) );
	}
}
