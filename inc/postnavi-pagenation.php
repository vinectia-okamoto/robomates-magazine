<?php
/**
 * ページネーション Function
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

if ( ! function_exists( 'vinectia_post_navi' ) ) {
	function vinectia_post_navi() {
		// 移動する場所がない場合は、空のマークアップを出力しないでください。
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
<ul class="post-navigation">
		<?php
		if ( get_previous_post_link() ) {
			previous_post_link( '<li class="nav-previous">%link</li>', 'Prev' );
		}
		if ( get_next_post_link() ) {
			next_post_link( '<li class="nav-next">%link</li>', 'Next' );
		}
		?>
</ul>
<!-- .navigation -->
		<?php
	}
}

/******************************************************************************************
 * レスポンシブなページネーションを作成する
 */
if ( ! function_exists( 'responsive_pagination' ) ) {
	function responsive_pagination( $pages = '', $range = 4 ) {
		$showitems = ( $range * 2 ) + 1;
		global $paged;
		if ( empty( $paged ) ) {
			$paged = 1;
		}
		// ページ情報の取得
		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}
		if ( 1 != $pages ) {
			echo '<ul class="pagination" role="menubar" aria-label="Pagination">';
			// 先頭へ
			echo '<li class="first"><a href="' . get_pagenum_link( 1 ) . '"><span>First</span></a></li>';
			// 1つ戻る
			if ( $paged > 1 ) { // 現在のページ値が１より大きい場合の表示
				echo '<li class="previous"><a href="' . get_pagenum_link( $paged - 1 ) . '"><span>Previous</span></a></li>';
			} else { // 最初のページを表示している時はリンク無効にして表示
				echo '<li class="previous"><a><span>Previous</span></a></li>';
			}
			// 番号つきページ送りボタン
			for ( $i = 1; $i <= $pages; $i++ ) {
				if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
					echo( $paged == $i ) ? '<li class="current"><a>' . $i . '</a></li>' : '<li><a href="' . get_pagenum_link( $i ) . '" class="inactive" >' . $i . '</a></li>';
				}
			}
			// 1つ進む
			if ( $paged < $pages ) { // 全ページ数より現在のページ値が小さい場合の表示
				echo '<li class="next"><a href="' . get_pagenum_link( $paged + 1 ) . '"><span>Next</span></a></li>';
			} else { // 最後のページを表示している時はリンク無効にして表示
				echo '<li class="next"><a><span>Next</span></a></li>';

			}
			// 最後尾へ
			echo '<li class="last"><a href="' . get_pagenum_link( $pages ) . '"><span>Last</span></a></li>';
			echo '</ul>';
		}
	}
}
