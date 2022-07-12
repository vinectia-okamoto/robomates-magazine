<?php
// @codingStandardsIgnoreFile
/**
 * カテゴリーカラーフィールド追加 Function
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
/**
 * [新しいカテゴリの追加]画面に新しいカラーピッカーフィールドを追加します
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param string $taxonomy タクソノミ.
 */
function colorpicker_field_add_new_category( $taxonomy ) {
	?>
	<?php
	$site_primary_color = vinectia_get_color_for_area( 'content', 'gray' );
	if ( $site_primary_color ) {
		$cat_color = $site_primary_color;
	} else {
		$cat_color = '#ffffff';
	}
	?>

<div class="form-field term-colorpicker-wrap">
	<label for="term-colorpicker">カテゴリーカラー</label>
	<input name="_category_color" value="<?php echo esc_attr( $cat_color ); ?>" class="colorpicker" id="term-colorpicker" />
	<p>カテゴリのラベルの色を選ぶことができます。</p>
</div>

	<?php

}
/**@ add_action( 'category_add_form_fields', 'colorpicker_field_add_new_category' ); //可変フック名 */

/**
 * 「カテゴリの編集」画面に新しいcolopickerフィールドを追加します
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param WP_Term_Object $term ターム.
 */
function colorpicker_field_edit_category( $term ) {

	$color = get_term_meta( $term->term_id, '_category_color', true );
	$color = ( ! empty( $color ) ) ? "#{$color}" : null;

	?>

<tr class="form-field term-colorpicker-wrap">
	<th scope="row"><label for="term-colorpicker">Select Color</label></th>
	<td>
<input name="_category_color" value="<?php echo esc_attr( $color ); ?>" class="colorpicker" id="term-colorpicker" />
<p class="description">カテゴリのラベルの色を選ぶことができます。</p>
</td>
</tr>

	<?php

}
/**@ add_action( 'category_edit_form_fields', 'colorpicker_field_edit_category' ); */

/**
 * 用語メタデータ-作成および編集された用語メタデータを保存
 * - https://developer.wordpress.org/reference/hooks/created_taxonomy/
 * - https://developer.wordpress.org/reference/hooks/edited_taxonomy/
 *
 * @param Integer $term_id タームID.
 */
function save_termmeta( $term_id ) {

	// 可能であれば用語の色を保存します.
	if ( isset( $_POST['_category_color'] ) && ! empty( $_POST['_category_color'] ) ) {
		update_term_meta( $term_id, '_category_color', sanitize_hex_color_no_hash( $_POST['_category_color'] ) );
	} else {
		delete_term_meta( $term_id, '_category_color' );
	}

}
add_action( 'created_category', 'save_termmeta' ); // 可変フック名.
add_action( 'edited_category', 'save_termmeta' ); // 可変フック名.

/**
 * Enqueue wp-color-picker
 *
 * @param Integer $taxonomy タクソノミ.
 */
function category_colorpicker_enqueue( $taxonomy ) {
	$screen = get_current_screen();
	if ( ( null !== ( $screen ) ) && 'edit-category' !== $screen->id ) {
		return;
	}

	// Colorpicker Scripts.
	wp_enqueue_script( 'wp-color-picker' );

	// Colorpicker Styles.
	wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'category_colorpicker_enqueue' );


/**
 * Print javascript to initialize the colorpicker
 * - https://developer.wordpress.org/reference/hooks/admin_print_scripts/
 *
 * @return void
 */
function colorpicker_init_inline() {
	$screen = get_current_screen();
	if ( null !== ( $screen ) && 'edit-category' !== $screen->id ) {
		return;
	}

	?>

<script>
jQuery(document).ready(function($) {

	$('.colorpicker').wpColorPicker();

}); // End Document Ready JQuery
</script>

	<?php

}
add_action( 'admin_print_scripts', 'colorpicker_init_inline', 20 );



/**
 * カラー取得関数
 */
function get_category_color() {

	$categories = get_the_category();

	if ( $categories ) {
		if ( isset( $category->term_id ) ) {
			$color = get_term_meta( $category->term_id, '_category_color', true );
		} else {
			$color = '#767676';
		}

		$separator = '';
		$output    = '';
		foreach ( $categories as $category ) {
			$output = get_term_meta( $category->term_id, '_category_color', true );
			if ( $output ) {
				$output = '#' . $output;
			} else {
				$output = null;
			}
			break;
		}
		return $output;
	}
}

/**
 * カテゴリ色列を管理する
 *
 * @param string $columns カラム.
 */
function manage_category_color_columns( $columns ) {
	$columns['category_color'] = 'カテゴリカラー';
	return $columns;
}
/**
 * カテゴリ色カスタムフィールドを管理する
 *
 * @param string $content カラム.
 * @param string $column_name カラム.
 * @param string $term_id カラム.
 */
function manage_category_color_custom_fields( $content, $column_name, $term_id ) {

	if ( 'category_color' === $column_name ) {
			$term_id = absint( $term_id );
		$output      = get_term_meta( $term_id, '_category_color', true );
		if ( $output ) {
			$content = '#' . $output;
			$content = '<div style="width:20px; height:20px; background-color:' . $content . ';">';
		} else {
			$content = null; }
	}

	return $content;
}
/**@ add_filter( 'manage_edit-category_columns', 'manage_category_color_columns' ); */
/**@ add_action( 'manage_category_custom_column', 'manage_category_color_custom_fields', 10, 3 );*/
