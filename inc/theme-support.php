<?php
/**
 * テーマサポート Function
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
if ( ! function_exists( 'vinectia_theme_support' ) ) :
	/**
	 * テーマのデフォルトを設定し、さまざまなWordPress機能のサポートを登録します。
	 */
	function vinectia_theme_support() {
		/** フルサイトエディタテンプレート無効化*/
		remove_theme_support( 'block-templates' );

		/** すべてのデフォルトパターンの登録を解除*/
		remove_theme_support( 'core-block-patterns' );

		/** フルサイトエディタを無効化 */
		remove_theme_support( 'fse' );

		/** ブロックスタイルのサポートを追加（テーマにブロックエディターのスタイルを適用）*/
		add_theme_support( 'wp-block-styles' );

		/** エディタースタイルの読み込み*/
		add_editor_style( 'style.css' );

		/** デフォルトの投稿とコメントのRSSフィードリンクをヘッドに追加します*/
		add_theme_support( 'automatic-feed-links' );

		/** 投稿とページの投稿サムネイルのサポートを有効にします*/
		add_theme_support( 'post-thumbnails' );

		/** ワードプレスの画像サイズを新しく追加する. */
		/** @ add_image_size('custom_600x400', 600, 400, true); */

		/** 投稿のサムネイルサイズを設定します。（post-thumbnailができるので一旦停止）*/
		/** @ set_post_thumbnail_size(300, 300); */

		/** WordPressにドキュメントのタイトルを管理させます*/
		add_theme_support( 'title-tag' );

		/** 固定ページに抜粋*/
		add_post_type_support( 'page', 'excerpt' );

		/** 検索フォーム、コメントフォーム、コメントのデフォルトのコアマークアップを切り替える有効なHTML5を出力します*/
		/** @ add_theme_support('html5', array('search-form', 'gallery', 'caption', 'script', 'style',));*/

		/** レスポンシブ埋め込みのサポートを追加します。Gutenbergの埋め込みブロックから埋め込みを行うとレスポンシブではありませんが、以下のコードを記述することで16:9のアスペクト比を保って表示させます。*/
		add_theme_support( 'responsive-embeds' );

		/** テーマカスタマイザーでウィジェットを変更した際に、ページ遷移なしでそのまま反映された様子を確認できる。*/
		/** @ add_theme_support('customize-selective-refresh-widgets');*/

	}
endif;

add_action( 'after_setup_theme', 'vinectia_theme_support' );
