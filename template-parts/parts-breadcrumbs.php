<?php
/**
 * パンくずテンプレート
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
if ( function_exists( 'bcn_display' ) ) {
	echo '<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/"><div class="container">';
	bcn_display();
	echo '</div></div>';
}
