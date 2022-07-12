<?php
/**
 * 検索 Function
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
 /*****************************
  * WordPress内の検索対象にカスタムフィールドも適用する
  *****************************/
function custom_search( $search, $wp_query ) {

	$target_posttype = array( 'post', 'page' );
	// template-tag.phpにあるカスタム投稿取得する関数
	$use_customposttypes = nxw_get_custom_post_types();
	array_push( $target_posttype, $use_customposttypes );

	global $wpdb;
	if ( ! $wp_query->is_search ) {
		return $search;
	}
	if ( ! isset( $wp_query->query_vars ) ) {
		return $search;
	}
	$search_words = explode( ' ', isset( $wp_query->query_vars['s'] ) ? $wp_query->query_vars['s'] : '' );
	if ( count( $search_words ) > 0 ) {
		$search  = '';
		$search .= "AND post_type = array('post', 'page', 'hanadayori')";
		foreach ( $search_words as $word ) {
			if ( ! empty( $word ) ) {
				$search_word = '%' . esc_sql( $word ) . '%';
				$search     .= " AND (
                 {$wpdb->posts}.post_title LIKE '{$search_word}'
                OR {$wpdb->posts}.post_content LIKE '{$search_word}'
                OR {$wpdb->posts}.ID IN (
                SELECT distinct post_id
                FROM {$wpdb->postmeta}
                WHERE meta_value LIKE '{$search_word}'
                )
              ) ";

			}
		}
	}
	return $search;
}
// add_filter('posts_search','custom_search', 10, 2);


 /*****************************
  * 検索結果のカスタマイズ
  * 特定のカスタム投稿タイプを指定したり除外したりします。
  *****************************/
function include_custom_post_search( $query ) {

	$target_posttype = array( 'post', 'page' );
	// template-tag.phpにあるカスタム投稿取得する関数
	$use_customposttypes = nxw_get_custom_post_types();
	array_push( $target_posttype, $use_customposttypes );

	if ( $query->is_search() && $query->is_main_query() && ! is_admin() ) {
			$query->set( 'post_type', $target_posttype );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'include_custom_post_search', 10, 1 );




 /*****************************
検索対象を『タイトルのみ』にする
  *****************************/

function __search_by_title_only( $search, &$wp_query ) {
	global $wpdb;
	if ( empty( $search ) ) {
		return $search; // skip processing - no search term in query
	}
	$q         = $wp_query->query_vars;
	$n         = ! empty( $q['exact'] ) ? '' : '%';
	$search    =
	$searchand = '';
	foreach ( (array) $q['search_terms'] as $term ) {
		$term      = esc_sql( like_escape( $term ) );
		$search   .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
		$searchand = ' AND ';
	}
	if ( ! empty( $search ) ) {
		$search = " AND ({$search}) ";
		if ( ! is_user_logged_in() ) {
			$search .= " AND ($wpdb->posts.post_password = '') ";
		}
	}
	return $search;
}
// add_filter( 'posts_search', '__search_by_title_only', 500, 2 );// （※２）
