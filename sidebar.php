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
	if ( is_active_sidebar( 'side-widgets' ) ) {
		dynamic_sidebar( 'side-widgets' );
	}
	?>
</div>
