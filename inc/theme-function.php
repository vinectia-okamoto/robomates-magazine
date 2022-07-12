<?php
/**
 * テーマ Function
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

/**
 * スタイリングとスクリーンリーダーマークアップでデフォルトのmoreタグを上書き
 *
 * @param string $html moreタグのデフォルトの出力HTML.
 */
function vinectia_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}





if ( ! function_exists( 'custom_wp_dequeue_css' ) ) {
	/**
	 * 5.9からのグローバルCC読み込まないようにする
	 */
	function custom_wp_dequeue_css() {
		// global-styles-inline-css を読み込まないようにする（※ v5.9 から追加される）.
		wp_dequeue_style( 'global-styles' );
	}
}
/** @ add_action('wp_enqueue_scripts', 'custom_wp_dequeue_css', 100);*/







if ( ! function_exists( 'disable_image_sizes' ) ) {
	/**
	 * 5.3から追加された画像サイズ停止
	 *
	 * @param string $new_sizes 新しいサイズ.
	 */
	function disable_image_sizes( $new_sizes ) {
		unset( $new_sizes['1536x1536'] );
		unset( $new_sizes['2048x2048'] );
		return $new_sizes;
	}
}
add_filter( 'intermediate_image_sizes_advanced', 'disable_image_sizes' );
add_filter( 'big_image_size_threshold', '__return_false' );



if ( ! function_exists( 'my_gallery_default_settings' ) ) {
	/**
	 * ギャラリーのデフォルトサイズ（なぜか設定していないと反映されないバグ）
	 *
	 * @param string $settings 設定.
	 */
	function my_gallery_default_settings( $settings ) {
		$settings['galleryDefaults']['size'] = 'medium';
		return $settings;
	}
}
add_filter( 'media_view_settings', 'my_gallery_default_settings' );


/**
 * WordPress srcset無効化
 */
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );



if ( ! function_exists( 'add_page_column_title' ) && ! function_exists( 'add_page_column' ) ) {
	/**
	 * WordPress管理画面の固定ページ一覧にスラッグを表示
	 *
	 * @param string $columns カラムデータ.
	 */
	function add_page_column_title( $columns ) {
		unset( $columns['comments'] );
		$columns['slug'] = 'スラッグ';
		return $columns;
	}
		/**
		 * WordPress管理画面の固定ページ一覧にスラッグを表示
		 *
		 * @param string $column_name カラム名.
		 * @param string $post_id ポストID.
		 */
	function add_page_column( $column_name, $post_id ) {
		$checkparam = 'slug';
		if ( $column_name === $checkparam ) {
			$post = get_post( $post_id );
			$slug = $post->post_name;
			echo esc_attr( $slug );
		}
	}
	add_filter( 'manage_pages_columns', 'add_page_column_title' );
	add_action( 'manage_pages_custom_column', 'add_page_column', 10, 2 );
}


if ( ! function_exists( 'add_custom_post_column_title' ) && ! function_exists( 'add_custom_post_column' ) ) {

	$selectposttype = 'robo-companies';
	/**
	 * カスタム投稿タイプ一覧にスラッグを追加
	 * manage_●●●●●●●_posts_columnsの部分を投稿タイプにする
	 *
	 *  @param string $columns カラム.
	 */
	function add_custom_post_column_title( $columns ) {
		$columns['slug'] = 'スラッグ';
		return $columns;
	}
		/**
		 * カスタム投稿タイプ一覧にスラッグを追加
		 * manage_●●●●●●●_posts_columnsの部分を投稿タイプにする
		 *
		 * @param string $column_name カラム名.
		 * @param string $post_id ポストID.
		 */
	function add_custom_post_column( $column_name, $post_id ) {
		$checkparam = 'slug';
		if ( $column_name === $checkparam ) {
			$post = get_post( $post_id );
			$slug = $post->post_name;
			echo esc_attr( $slug );
		}
	}
	$target_custom_post_type_columns       = 'manage_' . $selectposttype . '_posts_columns';
	$target_custom_post_type_custom_column = 'manage_' . $selectposttype . '_posts_custom_column';

	/** @ add_filter( $target_custom_post_type_columns, 'add_custom_post_column_title' ); */
	/** @ add_action( $target_custom_post_type_custom_column, 'add_custom_post_column', 10, 2 ); */
}



if ( ! function_exists( 'theme_get_the_archive_title' ) ) {
	/**
	 * デフォルトのアーカイブタイトルをフィルタリング
	 */
	function theme_get_the_archive_title() {
		if ( is_category() ) {
			$title = single_term_title( '', false ); // Category Archives.
		} elseif ( is_tag() ) {
			$title = 'タグ：' . single_term_title( '', false ); // Tag Archives.
		} elseif ( is_author() ) {
			$title = '作者：' . get_the_author_meta( 'display_name' ); // Author Archives.

		} elseif ( is_year() ) {
			$title = get_the_date( 'Y年' ) . 'のアーカイブ'; // Yearly Archives.

		} elseif ( is_month() ) {
			$title = get_the_date( 'Y年n月' ) . 'のアーカイブ'; // Monthly Archives.

		} elseif ( is_day() ) {
			$title = get_the_date() . 'のアーカイブ'; // Daily Archives.

		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false ); // Post Type Archives.

		} elseif ( is_tax() ) {

			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: %s: Taxonomy singular name */

			$title = sprintf( '%s', $tax->labels->singular_name );
			$title = single_term_title( '', false ); // Category Archives.
		}

		$title = wp_kses_post( $title );
		return $title;
	}
	add_filter( 'get_the_archive_title', 'theme_get_the_archive_title' );
}


if ( ! function_exists( 'my_css_attributes_filter' ) ) {
	/**
	 * 「page_item page-item-○」を削除し、現在のページクラス「current_page_item」を「current」に変更する
	 *
	 * @param string $var 変数.
	 */
	function my_css_attributes_filter( $var ) {
		if ( is_array( $var ) ) {
			$varci     = array_intersect( $var, array( 'current_page_item' ) );
			$cmeni     = array( 'current_page_item' );
			$selava    = array( 'current' );
			$selavaend = array();
			$selavaend = str_replace( $cmeni, $selava, $varci );
		} else {
			$selavaend = '';
		}
		return $selavaend;
	}
}
add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 );



if ( ! function_exists( 'strip_empty_classes' ) ) {
	/**
	 * クラス「class=""」を削除する設定
	 *
	 * @param string $menu メニュー.
	 */
	function strip_empty_classes( $menu ) {
		$menu = preg_replace( '/ class=(["\'])(?!on).*?\1/', '', $menu );
		return $menu;
	}
}
add_filter( 'wp_list_pages', 'strip_empty_classes' );




if ( ! function_exists( 'pagename_class' ) ) {
	/**
	 * Bodyのクラスにページスラッグ追加
	 *
	 * @param string $classes クラス.
	 */
	function pagename_class( $classes = '' ) {
		if ( is_page() ) {
			$page      = get_page( get_the_ID() );
			$classes[] = $page->post_name;
		}
		return $classes;
	}
}
add_filter( 'body_class', 'pagename_class' );


if ( ! function_exists( 'add_page_slug_class_name' ) ) {
		/**
		 * Bodyのクラスにに最上のスラッグ追加
		 *
		 * @param string $classes クラス.
		 */
	function add_page_slug_class_name( $classes ) {
		if ( is_page() ) {
			$page      = get_post( get_the_ID() );
			$classes[] = $page->post_name;

			$parent_id = $page->post_parent;
			if ( 0 === $parent_id ) {
				$classes[] = get_post( $parent_id )->post_name;
			} else {
				$ancestors     = get_ancestors( $page->ID, 'page', 'post_type' );
				$progenitor_id = array_pop( $ancestors );
				$classes[]     = get_post( $progenitor_id )->post_name . '-child';
			}
		}
		return $classes;
	}
}
add_filter( 'body_class', 'add_page_slug_class_name' );



if ( ! function_exists( 'vinectia_adjust_body_class' ) ) {
			/**
			 * ブートストラップマークアップのスタイルの問題を回避するためにbody_class配列からタグクラスを削除します。
			 *
			 * @param string $classes クラス.
			 */
	function vinectia_adjust_body_class( $classes ) {
		foreach ( $classes as $key => $value ) {
			if ( 'tag' === $value ) {
				unset( $classes[ $key ] );
			}
		}
		return $classes;
	}
}
add_filter( 'body_class', 'vinectia_adjust_body_class' );



if ( ! function_exists( 'remove_tagline' ) ) {
	/**
	 * タイトルからキャッチフレーズを削除
	 *
	 * @param string $title タイトル.
	 */
	function remove_tagline( $title ) {
		if ( isset( $title['tagline'] ) ) {
			unset( $title['tagline'] );
		}
		return $title;
	}
}
add_filter( 'document_title_parts', 'remove_tagline' );



if ( ! function_exists( 'custom_title_separator' ) ) {
	/**
	 * タイトルからセパレータを任意のものに変更
	 *
	 * @param string $sep セパレータ.
	 */
	function custom_title_separator( $sep ) {
		$sep = '|';
		return $sep;
	}
}
add_filter( 'document_title_separator', 'custom_title_separator' );



if ( ! function_exists( 'auto_post_slug' ) ) {
	/**
	 * 日本語スラッグを自動的に英字スラッグに書き換える
	 *
	 * @param string $slug スラッグ.
	 * @param string $post_ID ポストID.
	 * @param string $post_status ポストステータス.
	 * @param string $post_type ポストタイプ.
	 */
	function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
		if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
			$slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
		}
		return $slug;
	}
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4 );



if ( ! function_exists( 'my_add_noindex_attachment' ) ) {
	/**
	 * メディアページをインデックスさせない
	 */
	function my_add_noindex_attachment() {
		if ( is_attachment() ) {
			echo '<meta name="robots" content="noindex,follow" />';
		}
	}
}
add_action( 'wp_head', 'my_add_noindex_attachment' );
