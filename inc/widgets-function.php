<?php
/**
 * ウィジェット Function
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

if ( ! function_exists( 'vinectia_widgets_init' ) ) {
	/**
	 * テーマウィジェットを初期化
	 */
	function vinectia_widgets_init() {
		// すべてのregister_sidebar（）呼び出しで使用される引数.
		$shared_args = array(
			'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
			'after_title'   => '</h2>',
			'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
		);
		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'          => 'サイドバーウィジェット',
					'id'            => 'side-widgets',
					'description'   => '記事ページサイドバーのウィジェットエリア',
					'before_widget' => '<aside id="%1$s" class="side-area widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			)
		);

	}
	add_action( 'widgets_init', 'vinectia_widgets_init' );
}




/******************************************************************
 * 「アーカイブ」ウィジェットの表示件数を設定
 *
 * @param string $args 値がはいる.
 ******************************************************************/
function hook_widget_archives_args( $args ) {
	// 月別表示 年別ならyearly.
	$args['type'] = 'yearly';

	// 最大出力件数を10件に設定.
	$args['limit'] = 10;

	return $args;
}
add_filter( 'widget_archives_args', 'hook_widget_archives_args' );


/******************************************************************
 * 「年」という文字を追加
 *
 * @param string $html アーカイブ自体.
 ******************************************************************/
function my_get_archives_link( $html ) {
	return preg_replace( '/<\/a>/', '年</a>', $html );
}
add_filter( 'get_archives_link', 'my_get_archives_link' );
