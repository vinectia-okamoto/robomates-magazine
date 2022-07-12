<?php
/**
 * 自動保存 Function
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

/******************************************************************************************
 * 自動保存停止しました
 ******************************************************************************************/
/* 記事の自動保存AutoSaveを無効化する */
function disable_autosave() {
	wp_deregister_script( 'autosave' );
};
add_action( 'wp_print_scripts', 'disable_autosave' );

// リビジョン無効
add_filter( 'wp_revisions_to_keep', '__return_false' );

// クイックドラフト自動下書き停止
function disable_quickpress() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
  add_action( 'wp_dashboard_setup', 'disable_quickpress' );
