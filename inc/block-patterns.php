<?php

/**
 * ブロックパターン
 *
 * @since vinectia
 */

/**
 * ブロックパターンカテゴリとパターン生成
 *
 * @since vinectia
 *
 * @return void
 */
function vct_register_block_patterns()
{
	$block_pattern_categories = array(
		'original' => array('label' => 'オリジナル'),
	);

	/**
	 * テーマブロックパターンのカテゴリをフィルタリングします。
	 *
	 * @since vinectia
	 *
	 * @param array[] $block_pattern_categories {
	 *     カテゴリ名でキー設定された、ブロックパターンカテゴリの連想配列.
	 *
	 *     @type array[] $properties {
	 *         ブロックカテゴリプロパティの配列.
	 *
	 *         @type string $label パターンカテゴリの人間が読み取れるラベル.
	 *     }
	 * }
	 */
	$block_pattern_categories = apply_filters('vinectia_block_pattern_categories', $block_pattern_categories);

	foreach ($block_pattern_categories as $name => $properties) {
		if (!WP_Block_Pattern_Categories_Registry::get_instance()->is_registered($name)) {
			register_block_pattern_category($name, $properties);
		}
	}

	$block_patterns = array(
		'ptn-robo-companies',
	);

	/**
	 * テーマブロックパターンをフィルタリングします.
	 *
	 * @since vinectia 1.0
	 *
	 * @param array $block_patterns 名前によるブロックパターンのリスト.
	 */
	$block_patterns = apply_filters('vct_block_patterns', $block_patterns);

	foreach ($block_patterns as $block_pattern) {
		$pattern_file = get_theme_file_path('/inc/patterns/' . $block_pattern . '.php');

		register_block_pattern(
			'vct/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action('init', 'vct_register_block_patterns', 9);