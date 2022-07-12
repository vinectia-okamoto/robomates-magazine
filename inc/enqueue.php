<?php
/**
 * Enqueue Function
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
if ( ! function_exists( 'vinectia_theme_styles' ) ) :
	/**
	 * テーマスタイル読み込み
	 */
	function vinectia_theme_styles() {
		// @ テーマスタイルシートを登録
		$theme_version  = wp_get_theme()->get( 'Version' );
		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'vinectia_theme-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// @ テーマスタイルシートを読み込み
		wp_enqueue_style( 'vinectia_theme-style' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'vinectia_theme_styles' );


	$theme_version = wp_get_theme()->version; // Theme の version.


if ( ! function_exists( 'vinectia_register_styles' ) ) :
	/**
	 * ページのスタイル読み込み
	 */
	function vinectia_register_styles() {
		wp_enqueue_style( 'style_style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version );
		if ( is_front_page() && is_home() ) {
			wp_enqueue_style( 'top_css', get_stylesheet_directory_uri() . '/assets/css/top.css', array(), $theme_version );
		} else {
			wp_enqueue_style( 'page_css', get_stylesheet_directory_uri() . '/assets/css/page.css', array(), $theme_version );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'vinectia_register_styles' );




if ( ! function_exists( 'vinectia_register_scripts' ) ) :
	/**
	 * スクリプトの登録と読み込み
	 */
	function vinectia_register_scripts() {

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'main_js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $theme_version, true );

		if ( is_front_page() && is_home() ) {
			wp_enqueue_script( 'top_js', get_template_directory_uri() . '/assets/js/top.js', array( 'jquery' ), $theme_version, true );
		}

		if ( is_page( array( 'contact' ) ) ) { // フォームなら.
			wp_enqueue_script( 'yubinbango-js', '//yubinbango.github.io/yubinbango/yubinbango.js', array(), $theme_version, true );
			wp_enqueue_script( 'function_form_js', get_template_directory_uri() . '/assets/js/function-form.js', array(), $theme_version, true );
		}
	}

endif;
add_action( 'wp_enqueue_scripts', 'vinectia_register_scripts' );




if ( ! function_exists( 'vinectia_admin_script' ) ) {
	/**
	 * Admin専用スクリプト.
	 */
	function vinectia_admin_script() {
		wp_enqueue_script( 'function_adminonly-js', get_template_directory_uri() . '/assets/js/function-adminonly.js', array( 'jquery' ), $theme_version, true );
	}
}
add_action( 'admin_enqueue_scripts', 'vinectia_admin_script' );


if ( ! function_exists( 'wordpress_editor_style_setup' ) ) :
		/**
		 * ワードプレスの標準のブロックエディタをスタイルに反映
		 */
	function wordpress_editor_style_setup() {
		add_theme_support( 'editor-styles' );
	}
endif;
add_action( 'after_setup_theme', 'wordpress_editor_style_setup' );

// @ブロックエディタ用スタイル機能jsをテーマに追加


if ( ! function_exists( 'add_block_editor_script' ) ) {
	/**
	 * 独自のブロックスタイル読み込み
	 */
	function add_block_editor_script_and_style() {
		// 編集画面CSS（gudenberg用）
		wp_enqueue_style( 'gudenberg-style-css', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), $theme_version );

		wp_enqueue_script( 'vinectia-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
		// @ブロックエディタ用CSSの読み込み
		add_editor_style( array( get_stylesheet_directory_uri() . '/assets/css/editor_preview.css' ) );
	}
}
add_action( 'enqueue_block_editor_assets', 'add_block_editor_script_and_style', 1, 1 );
