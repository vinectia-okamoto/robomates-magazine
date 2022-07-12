<?php
/**
 * FIXED MENU
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!-- ******************** fixedmenu ******************** -->
<ul class="fixedmenu">
<li class="fixedmenu-tel"><a href="#"><i class="fas fa-phone-alt"></i><span>TEL</span></a></li>
<li class="fixedmenu-mail"><a href="<?php echo esc_url( get_page_link() ); ?>"><i class="far fa-envelope"></i><span>お問い合わせ</span></a></li>
<li class="fixedmenu-backtotop"><a class="backtotop" href="javascript:void(0);"><i class="fas fa-chevron-up"></i><span>TOP</span></a></li>
</ul>
