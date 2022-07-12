<?php
/**
 * エディター Function
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
if ( ! function_exists( 'tiny_mce_editor_midashi_settings' ) ) {
	/**
	 * Tinymceの見出し減らす
	 *
	 * @param string $init_array  中身.
	 */
	function tiny_mce_editor_midashi_settings( $init_array ) {
		// 管理画面の「見出し１」等を削除する.
		$init_array['block_formats'] = '段落=p; 見出し2=h2; 見出し3=h3; 見出し4=h4; 見出し5=h5;';
		return $init_array;
	}
}
/**@ add_filter('tiny_mce_before_init', 'tiny_mce_editor_midashi_settings'); */


if ( ! function_exists( 'customize_tinymce_settings' ) ) {
	/**
	 * Tinymceのwidth heightなくす
	 *
	 * @param string $mce_init  MCE中身.
	 */
	function customize_tinymce_settings( $mce_init ) {
		$mce_init['table_resize_bars'] = false;
		$mce_init['object_resizing']   = 'img';
		return $mce_init;
	}
}
/**@ add_filter('tiny_mce_before_init', 'customize_tinymce_settings', 0);*/



if ( ! function_exists( 'my_tiny_mce_before_init' ) ) {
	/**
	 * ペースト時にテーブル (table) およびセル (td) の width 属性が削除
	 *
	 * @param string $table_init  中身.
	 */
	function my_tiny_mce_before_init( $table_init ) {
		$table_init['paste_preprocess'] = <<<SCRIPT
function(plugin, args) {
var content = jQuery('<div>' + args.content + '</div>');
content.find('table,td').removeAttr('width');
args.content = content.html();
}
SCRIPT;
		return $table_init;
	}
}
/**@ add_filter('tiny_mce_before_init', 'my_tiny_mce_before_init');*/



if ( ! function_exists( 'tinymce_custom_table_width' ) ) {
	/**
	 * TINYMCEのテーブルの幅つくのをやめる
	 *
	 * @param string $settings  中身.
	 */
	function tinymce_custom_table_width( $settings ) {

		$invalid_style              = array(
			'table' => 'width height',
			'th'    => 'width height',
			'td'    => 'width height',
		);
		$settings['invalid_styles'] = wp_json_encode( $invalid_style );
		return $settings;
	}
}
/**@  add_filter('tiny_mce_before_init', 'tinymce_custom_table_width', 0);*/




if ( ! function_exists( 'tiny_mce_bodyclass_settings' ) ) {
	/**
	 * TINYMCEのエディターのbodyにクラス.editor-styles-wrapperを追加
	 *
	 * @param string $init_array  中身.
	 */
	function tiny_mce_bodyclass_settings( $init_array ) {
		$init_array['body_class'] = 'editor-styles-wrapper';
		return $init_array;
	}
}
/**@ add_filter('tiny_mce_before_init', 'tiny_mce_bodyclass_settings');*/




if ( ! function_exists( 're_register_post_tag_taxonomy' ) ) {
	/**
	 * 投稿画面にタグ一覧を表示しチェックボックス選択式にする
	 */
	function re_register_post_tag_taxonomy() {
		$tag_slug_args               = get_taxonomy( 'post_tag' );
		$tag_slug_args->hierarchical = true;
		$tag_slug_args->meta_box_cb  = 'post_categories_meta_box';
		register_taxonomy( 'post_tag', 'post', (array) $tag_slug_args );
	}
}
/**@ add_action('init', 're_register_post_tag_taxonomy', 1);*/


if ( ! function_exists( 'extend_tiny_mce_before_init' ) ) {
	/**
	 *  Tiny_mceのキャッシュクリア
	 *
	 * @param string $mce_init  中身.
	 */
	function extend_tiny_mce_before_init( $mce_init ) {
		$mce_init['cache_suffix'] = 'v=' . time();
		return $mce_init;
	}
}
/**@ add_filter('tiny_mce_before_init', 'extend_tiny_mce_before_init');*/






if ( ! function_exists( 'remove_default_block_pattern_category' ) ) {
	/**
	 *  標準のブロックパターンカテゴリを削除する
	 */
	function remove_default_block_pattern_category() {
		$categories = array(
			'buttons', // ボタン.
			'columns', // カラム.
			'gallery', // ギャラリー.
			'header',  // ヘッダー.
			'text',    // テキスト.
			'query',    // クエリー.
		);
		foreach ( $categories as $category ) {
			unregister_block_pattern_category( $category );
		}
	}
}
/**@ add_action('init', 'remove_default_block_pattern_category');*/



if ( ! function_exists( 'remove_block_editor_options' ) ) {
		/**
		 *  文書設定パネルの不要な項目削除
		 */
	function remove_block_editor_options() {
		/**@ remove_post_type_support( 'post', 'author' );// 投稿者. */

		remove_post_type_support( 'post', 'post-formats' );// 投稿フォーマット.
		remove_post_type_support( 'post', 'revisions' );// リビジョン.
		/**@ remove_post_type_support( 'post', 'thumbnail' );// アイキャッチ. */
		/**@ remove_post_type_support( 'post', 'excerpt' );// 抜粋. */
		remove_post_type_support( 'post', 'comments' );// コメント.
		remove_post_type_support( 'post', 'trackbacks' );// トラックバック.
		remove_post_type_support( 'post', 'templates' );
		/**@ remove_post_type_support('page', 'page-attributes'); */

		/**@ remove_post_type_support( 'post', 'custom-fields' );// カスタムフィールド. */
		/**@ unregister_taxonomy_for_object_type( 'category', 'post' );// カテゴリー. */
		unregister_taxonomy_for_object_type( 'post_tag', 'post' ); // タグ.
	}
}
/**@ add_action('init', 'remove_block_editor_options'); */


if ( ! function_exists( 'disable_new_catecory_add_txt_link' ) ) {
			/**
			 *  カテゴリーの「新規カテゴリーを追加」を非表示
			 */
	function disable_new_catecory_add_txt_link() {
		echo '<style>
.components-button.editor-post-taxonomies__hierarchical-terms-add, .components-button.editor-post-taxonomies__hierarchical-terms-submit{
display:none;
}
</style>' . PHP_EOL;
	}
}
add_action( 'admin_print_styles', 'disable_new_catecory_add_txt_link' );





if ( ! function_exists( 'add_dropdown_pages' ) ) {
				/**
				 *  【管理画面】ページの属性で非公開などを親に選択できるようにする.
				 *
				 * @param string $add_dropdown_pages  選択.
				 * @param string $post  ポスト.
				 */
	function add_dropdown_pages( $add_dropdown_pages, $post = null ) {
		$add_dropdown_pages['post_status'] = array( 'publish', 'future', 'draft', 'pending', 'private' ); // 公開済、予約済、下書き、承認待ち、非公開、を選択.
		return $add_dropdown_pages;
	}
}
add_filter( 'page_attributes_dropdown_pages_args', 'add_dropdown_pages' );
add_filter( 'quick_edit_dropdown_pages_args', 'add_dropdown_pages' );
