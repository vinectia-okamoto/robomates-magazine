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
		wp_register_style( 'vinectia_theme-style', get_template_directory_uri() . '/style.css', array(), 1 );
		// @ テーマスタイルシートを読み込み
		wp_enqueue_style( 'vinectia_theme-style' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'vinectia_theme_styles' );





if ( ! function_exists( 'vinectia_register_styles' ) ) :
	/**
	 * ページのスタイル読み込み
	 */
	function vinectia_register_styles() {
		$version = gmdate( 'Ymd_Hi', filemtime( get_theme_file_path( '/assets/css/style.css' ) ) );
		wp_enqueue_style( 'style_style', get_template_directory_uri() . '/assets/css/style.css', array(), $version );
		if ( is_front_page() && is_home() ) {
			$version = gmdate( 'Ymd_Hi', filemtime( get_theme_file_path( '/assets/css/top.css' ) ) );
			wp_enqueue_style( 'top_css', get_stylesheet_directory_uri() . '/assets/css/top.css', array(), $version );
		} else {
			$version = gmdate( 'Ymd_Hi', filemtime( get_theme_file_path( '/assets/css/page.css' ) ) );
			wp_enqueue_style( 'page_css', get_stylesheet_directory_uri() . '/assets/css/page.css', array(), $version );

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
		$version = gmdate( 'Ymd_Hi', filemtime( get_theme_file_path( '/assets/js/main.js' ) ) );
		wp_enqueue_script( 'main_js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $version, true );

		if ( is_front_page() && is_home() ) {
			$version = gmdate( 'Ymd_Hi', filemtime( get_theme_file_path( '/assets/js/top.js' ) ) );

			wp_enqueue_script( 'top_js', get_template_directory_uri() . '/assets/js/top.js', array( 'jquery' ), $version, true );
		}

		if ( is_page( array( 'contact' ) ) ) { // フォームなら.
			wp_enqueue_script( 'yubinbango-js', '//yubinbango.github.io/yubinbango/yubinbango.js', array(), 1, true );
			$version = gmdate( 'Ymd_Hi', filemtime( get_theme_file_path( '/assets/js/top.js' ) ) );
			wp_enqueue_script( 'function_form_js', get_template_directory_uri() . '/assets/js/function-form.js', array(), $version, true );
		}
	}

endif;
add_action( 'wp_enqueue_scripts', 'vinectia_register_scripts' );


if ( ! function_exists( 'wordpress_editor_style_setup' ) ) :
		/**
		 * ワードプレスの標準のブロックエディタをスタイルに反映
		 */
	function wordpress_editor_style_setup() {
		add_theme_support( 'editor-styles' );
		add_editor_style( array( get_stylesheet_directory_uri() . '/assets/css/editor_preview.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'wordpress_editor_style_setup' );

// @ブロックエディタ用スタイル機能jsをテーマに追加


if ( ! function_exists( 'add_block_editor_script_and_style' ) ) {
	/**
	 * 独自のブロックスタイル読み込み
	 */
	function add_block_editor_script_and_style() {
		// 編集画面CSS（gudenberg用）.
		$version = gmdate( 'Ymd_Hi', filemtime( get_theme_file_path( '/assets/css/style.css' ) ) );
		wp_enqueue_style( 'gudenberg-style-css', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), $version );
		// 各ブロックの独自のスタイル追加.
		wp_enqueue_script( 'vinectia-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );

	}
}
add_action( 'enqueue_block_editor_assets', 'add_block_editor_script_and_style', 1, 1 );
