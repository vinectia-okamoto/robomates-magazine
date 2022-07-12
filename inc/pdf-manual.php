<?php
/**
 * PDFマニュアル Function
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
/******************************************************************************************
 * PDFはimages/manual/manual.pdfを参照します。
 ******************************************************************************************/

// pdfのurlを設定
$pdf_url = get_bloginfo( 'template_directory' ) . '/assets/pdf/shiawasenomura-manual-20220421.pdf';
if ( file_exists( $pdf_url ) && ! function_exists( 'custom_admin_footer' ) ) {

	function add_side_menu_manual() {
		// メニューにPDFマニュアル追加する
		function artist_add_pages() {
			add_menu_page( 'PDFマニュアル', 'PDFマニュアル', 'read', 'manual', 'manual' );
		}
		add_action( 'admin_menu', 'artist_add_pages' );

		?>
<script type="text/javascript">
jQuery(function($) {
	$("#toplevel_page_manual a").attr("href", "<?php echo $pdf_url; ?>"); //hrefを書き換える
	$("#toplevel_page_manual a").attr("target", "_blank"); //target blankを追加する
});
</script>
		<?php
	}
}
add_action( 'admin_footer', 'add_side_menu_manual' );
