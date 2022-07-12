<?php
/**
 * メニュー Function
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
 * ナビゲーションメニューの登録 wp_nav_menuを使用します。
 */
function vinectia_menus() {
	$locations = array(
		'globalNavi' => 'グローバルメニュー',
		'spNavi'     => 'スマホメニュー',
		'footerNavi' => 'フッターメニュー',
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'vinectia_menus' );

/**
 * 「wp_nav_menu」のliにclass追加
 *
 * @param string $classes wp_nav_menuで'add_li_class'でlistにclass追加できる.
 * @param string $item item.
 * @param string $args args.
 */
function add_additional_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes['class'] = $args->add_li_class;
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'add_additional_class_on_li', 1, 3 );

/**
 * 「wp_nav_menu」のaにclass追加
 *
 * @param string $classes wp_nav_menuで'add_a_class'でlistのaにclass追加できる.
 * @param string $item item.
 * @param string $args args.
 */
function add_additional_class_on_a( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes['class'] = $args->add_a_class;
	}
	return $classes;
}
add_filter( 'nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3 );


/**
 * WordPressのナビゲーションメニューで非公開の記事を自動的に非表示にする方法
 *
 * @param string $sorted_menu_items 宣言.
 */
function remove_private_post_menu( $sorted_menu_items ) {
	$unset_ids = array();
	foreach ( $sorted_menu_items as $key => $item ) {
		$check_itemtype = 'post_type';
		if ( $item->type === $check_itemtype ) {
			$post      = get_post( $item->object_id );
			$post_type = get_post_type_object( $post->post_type );

			$check_post_status = 'post_type';
			if ( $post->post_status === $check_post_status && ! current_user_can( $post_type->cap->read_private_posts ) ) {
				unset( $sorted_menu_items[ $key ] );
				$unset_ids[] = $item->ID;
				continue;
			}
		}
		if ( in_array( $item->menu_item_parent, $unset_ids, true ) ) {
			unset( $sorted_menu_items[ $key ] );
			$unset_ids[] = $item->ID;
		}
	}
	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'remove_private_post_menu' );



if ( ! function_exists( 'remove_to_current_class' ) ) {
	/**
	 * クラスを削除して、表示中メニューに 'current' クラスを付与する
	 *
	 * @param string $classes クラス.
	 * @param string $item アイテム.
	 */
	function remove_to_current_class( $classes, $item ) {
		$classes = array();
		if ( true === $item->current ) {
			$classes[] = 'current';
		}
		return $classes;
	}
}
add_filter( 'nav_menu_css_class', 'remove_to_current_class', 10, 2 );



if ( ! function_exists( 'remove_id' ) ) {
	/**
	 * 表示中メニューからID削除
	 *
	 * @param string $id ID.
	 */
	function remove_id( $id ) {
		$id = array();
		return $id;
	}
}
add_filter( 'nav_menu_item_id', 'remove_id', 10 );
