<?php
/**
 * カスタム投稿タイプ Function
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
/************************************************
 * カスタム投稿タイプ「ロボット関連企業」
 ***********************************************/
function create_custom_post_type() {
	/*投稿タイプ-メニュー**/
	$labels = array(
		'name'               => 'ロボット関連企業紹介',
		'singular_name'      => 'ロボット関連企業紹介',
		'add_new'            => '新しいロボット関連企業を追加',
		'add_new_item'       => '新規ロボット関連企業',
		'edit_item'          => 'ロボット関連企業を編集',
		'new_item'           => '新しいロボット関連企業',
		'view_item'          => 'ロボット関連企業を表示',
		'search_items'       => 'ロボット関連企業を探す',
		'not_found'          => 'ロボット関連企業は見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱にロボット関連企業はありません。',

	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 6,
		'has_archive'        => true,
		'show_in_rest'       => true,
		'rewrite'            => array( 'with_front' => false ),
		'mode'               => 'preview',
		'supports'           => array(
			'title',
			'editor',
			'thumbnail',
		),

	);

	register_post_type( 'companies', $args );

	/*投稿タイプ-メニュー**/
	$labels = array(
		'name'               => 'インターンシップ体験ブログ',
		'singular_name'      => 'インターンシップ体験ブログ',
		'add_new'            => '新しい体験ブログを追加',
		'add_new_item'       => '新規体験ブログ',
		'edit_item'          => '体験ブログを編集',
		'new_item'           => '新しい体験ブログ',
		'view_item'          => '体験ブログを表示',
		'search_items'       => '体験ブログを探す',
		'not_found'          => '体験ブログは見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱に体験ブログはありません。',

	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 6,
		'has_archive'        => true,
		'show_in_rest'       => true,
		'rewrite'            => array( 'with_front' => false ),
		'mode'               => 'preview',
		'supports'           => array(
			'title',
			'editor',
			'thumbnail',
		),

	);

	register_post_type( 'exp-blog', $args );

	/*投稿タイプ-メニュー**/
	$labels = array(
		'name'               => 'ロボット導入ビフォーアフター',
		'singular_name'      => 'ロボット導入ビフォーアフター',
		'add_new'            => '新しい導入ビフォーアフターを追加',
		'add_new_item'       => '新規導入ビフォーアフター',
		'edit_item'          => '導入ビフォーアフターを編集',
		'new_item'           => '新しい導入ビフォーアフター',
		'view_item'          => '導入ビフォーアフターを表示',
		'search_items'       => '導入ビフォーアフターを探す',
		'not_found'          => '導入ビフォーアフターは見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱に導入ビフォーアフターはありません。',

	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => 6,
		'has_archive'        => true,
		'show_in_rest'       => true,
		'rewrite'            => array( 'with_front' => false ),
		'mode'               => 'preview',
		'supports'           => array(
			'title',
			'editor',
			'thumbnail',
		),

	);

	register_post_type( 'beforeafter', $args );

	/*タクソノミ-メニューカテゴリ**/
	$args = array(
		'label'             => '企業カテゴリ',
		'labels'            => array(
			'name'          => '企業カテゴリ',
			'singular_name' => '企業カテゴリ',
			'search_items'  => '企業カテゴリを検索',
			'popular_items' => 'よく使われている企業カテゴリ',
			'all_items'     => 'すべての企業カテゴリ',
			'parent_item'   => '親企業カテゴリ',
			'edit_item'     => '企業カテゴリの編集',
			'update_item'   => '更新',
			'add_new_item'  => '新規企業カテゴリを追加',
			'new_item_name' => '新しい企業カテゴリ',
		),
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'public'            => true,
		'show_ui'           => true,
		'hierarchical'      => true,

	);
	register_taxonomy( 'companies_category', 'companies', $args );

	/*タクソノミ-メニューカテゴリ**/
	$args = array(
		'label'             => 'エリア',
		'labels'            => array(
			'name'          => 'エリア',
			'singular_name' => 'エリア',
			'search_items'  => 'エリアを検索',
			'popular_items' => 'よく使われているエリア',
			'all_items'     => 'すべてのエリア',
			'parent_item'   => '親エリア',
			'edit_item'     => 'エリアの編集',
			'update_item'   => '更新',
			'add_new_item'  => '新規エリアを追加',
			'new_item_name' => '新しいエリア',
		),
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'public'            => true,
		'show_ui'           => true,
		'hierarchical'      => true,

	);
	register_taxonomy( 'companies_area', 'companies', $args );

	$args = array(
		'label'             => '体験ブログカテゴリ',
		'labels'            => array(
			'name'          => '体験ブログカテゴリ',
			'singular_name' => '体験ブログカテゴリ',
			'search_items'  => '体験ブログカテゴリを検索',
			'popular_items' => 'よく使われている体験ブログカテゴリ',
			'all_items'     => 'すべての体験ブログカテゴリ',
			'parent_item'   => '親体験ブログカテゴリ',
			'edit_item'     => '体験ブログカテゴリの編集',
			'update_item'   => '更新',
			'add_new_item'  => '新規体験ブログカテゴリを追加',
			'new_item_name' => '新しい体験ブログカテゴリ',
		),
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'public'            => true,
		'show_ui'           => true,
		'hierarchical'      => true,

	);
	// @ register_taxonomy( 'exp-blog_category', 'exp-blog', $args );

	$args = array(
		'label'             => 'ビフォーアフターカテゴリ',
		'labels'            => array(
			'name'          => 'ビフォーアフターカテゴリ',
			'singular_name' => 'ビフォーアフターカテゴリ',
			'search_items'  => 'ビフォーアフターカテゴリを検索',
			'popular_items' => 'よく使われているビフォーアフターカテゴリ',
			'all_items'     => 'すべてのビフォーアフターカテゴリ',
			'parent_item'   => 'ビフォーアフターカテゴリ',
			'edit_item'     => 'ビフォーアフターカテゴリの編集',
			'update_item'   => '更新',
			'add_new_item'  => '新規ビフォーアフターカテゴリを追加',
			'new_item_name' => '新しいビフォーアフターカテゴリ',
		),
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'public'            => true,
		'show_ui'           => true,
		'hierarchical'      => true,

	);
	// @ register_taxonomy( 'beforeafter_category', 'exp-blog', $args );

	/**
	 * タクソノミ - メニュータグ
	 */
	register_taxonomy_for_object_type( 'post_tag', 'exp-blog' );
}
add_action( 'init', 'create_custom_post_type' );


/**********************************************
 * タクソノミ絞り込み機能追加 （companiesのみ。カテゴリで）
 **********************************************/
function add_custom_taxonomies_term_filter_soat() {
	$posttypename = 'companies';
	$taxonomyname = 'companies_category';
	global $post_type;
	if ( $posttypename === $post_type ) {
		$taxonomy = $taxonomyname;
		wp_dropdown_categories(
			array(
				'show_option_all' => 'すべてのカテゴリー',
				'orderby'         => 'name',
				'selected'        => get_query_var( $taxonomy ),
				'hide_empty'      => 0,
				'name'            => $taxonomy,
				'taxonomy'        => $taxonomy,
				'value_field'     => 'slug',
			)
		);
	}
}
add_action( 'restrict_manage_posts', 'add_custom_taxonomies_term_filter_soat' );
/**********************************************
 * タクソノミ絞り込み機能追加 （companiesのみ。エリアで）
 **********************************************/
function add_custom_taxonomies_term_filter_soat2() {
	$posttypename = 'companies';
	$taxonomyname = 'companies_area';
	global $post_type;
	if ( $posttypename === $post_type ) {
		$taxonomy = $taxonomyname;
		wp_dropdown_categories(
			array(
				'show_option_all' => 'すべてのエリア',
				'orderby'         => 'name',
				'selected'        => get_query_var( $taxonomy ),
				'hide_empty'      => 0,
				'name'            => $taxonomy,
				'taxonomy'        => $taxonomy,
				'value_field'     => 'slug',
			)
		);
	}
}
add_action( 'restrict_manage_posts', 'add_custom_taxonomies_term_filter_soat2' );


/**
 * カスタム投稿：robo-companiesにデフォルトのテンプレ
 *
 * @param string $default_content デフォルトの文字.
 */
function my_editor_content( $default_content ) {
	global $pagenow;
	global $post_type;

	if ( 'post-new.php' === $pagenow && 'companies' === $post_type ) {

		$default_content = include get_theme_file_path( '/inc/patterns/ptn-companies.php' );
		if ( isset( $default_content['content'] ) ) {
			$default_content = $default_content['content'];
		} else {
			$default_content = '';
		}
	}

	return $default_content;
}
add_filter( 'default_content', 'my_editor_content', 10, 2 );
