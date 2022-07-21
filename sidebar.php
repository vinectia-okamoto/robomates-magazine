<?php
/**
 * サイドバーテンプレート
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="contentSide">

	<?php
	if ( get_post_type() === 'companies' ) {

		$companies_category_terms = get_terms( 'companies_category' );
		echo '<aside class="side-area">';
		echo '<h3>企業カテゴリー</h3>';
		echo '<ul>';
		foreach ( $companies_category_terms as $companies_category_term ) {
			echo '<li><a href="' . esc_url( get_term_link( $companies_category_term ) ) . '">' . esc_html( $companies_category_term->name ) . '</a></li>';
		}
		echo '</ul>';
		echo '</aside>';
	} else {
		if ( is_active_sidebar( 'side-widgets' ) ) {
			dynamic_sidebar( 'side-widgets' );}
	}
	?>

</div>
