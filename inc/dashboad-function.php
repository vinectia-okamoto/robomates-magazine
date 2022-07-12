<?php
/**
 * ダッシュボード Function
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
if ( ! function_exists( 'custom_admin_footer' ) ) {
	/**
	 * フッター部の「WordPress のご利用ありがとうございます」表示内容を変更する
	 */
	function custom_admin_footer() {
		echo 'サイトでお困りのことがありましたら合同会社ビネクティア（078-599-6432）お問い合わせください。';
	}
}
add_filter( 'admin_footer_text', 'custom_admin_footer' );



if ( ! function_exists( 'my_admin_notices' ) ) {
	/**
	 * ノーティス（警告文）をメディアの登録に出力
	 */
	function my_admin_notices() {
		global $pagenow;
		if ( isset( $pagenow ) ) {
			if ( ( 'media-new.php' === $pagenow ) || ( 'upload.php' === $pagenow ) ) {
				$notices = 'media_notices'; // あとで個別に呼び出すためのエラー名.
				$code    = esc_attr( 'my_code' );
				$message = '「タイトル」と「代替テキスト」はできる限りいれてください。同じでOKです';
				$type    = 'info';
				add_settings_error( $notices, $code, $message, $type );   // エラーの登録.
				settings_errors( $notices ); // メディアページの登録を出力.
			}
		}
	}
}
add_action( 'admin_notices', 'my_admin_notices' );


if ( ! function_exists( 'login_logo' ) ) {
	/**
	 * ログイン画面のロゴ変更
	 */
	function login_logo() {
		$loginlogo_url    = get_bloginfo( 'template_directory' ) . '/assets/images/common/site-logo.svg';
		$loginlogo_width  = 320;
		$loginlogo_height = 60;
		echo '<style type="text/css">.login h1 a {background-image: url(' . esc_url( $loginlogo_url ) . ');width:' . esc_attr( $loginlogo_width ) . 'px;height:' . esc_attr( $loginlogo_height ) . 'px;background-size:' . esc_attr( $loginlogo_width ) . 'px ' . esc_attr( $loginlogo_height ) . 'px;}</style>';
	}
}
add_action( 'login_head', 'login_logo' );


if ( ! function_exists( 'custom_login_logo_url' ) ) {
		/**
		 * ログイン画面のロゴのリンク先URLをHOMEに
		 */
	function custom_login_logo_url() {
		return get_bloginfo( 'url' );
	}
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );


if ( ! function_exists( 'custom_login_logo_url_title' ) ) {
			/**
			 * ログイン画面のロゴタイトル
			 */
	function custom_login_logo_url_title() {
		return get_bloginfo( 'name' );
	}
}
add_filter( 'login_headertext', 'custom_login_logo_url_title' );


if ( ! function_exists( 'remove_menus' ) ) {
				/**
				 * 各種メニュー停止
				 */
	function remove_menus() {
		remove_menu_page( 'edit-comments.php' ); // コメントメニュー.

		/**@ remove_menu_page( 'index.php' ); //ダッシュボード.*/
		/**@ remove_menu_page( 'edit.php' ); //投稿メニュー. */
		/**@ remove_menu_page( 'upload.php' ); //メディア. */
		/**@ remove_menu_page( 'edit.php?post_type=page' ); //ページ追加. */
		/**@ remove_menu_page( 'themes.php' ); //外観メニュー. */
		/**@ remove_menu_page( 'plugins.php' ); //プラグインメニュー. */
		/**@ remove_menu_page( 'tools.php' ); //ツールメニュー. */
		/**@ remove_menu_page( 'options-general.php' ); //設定メニュー. */

	}
	add_filter( 'comments_open', '__return_false' );
}
add_action( 'admin_menu', 'remove_menus' );


/**
* 本体の更新通知を非表示
*/
global $current_user;
wp_get_current_user();
if ( '1' !== $current_user->ID ) { // ID1のみ更新通知を表示.
	add_filter( 'pre_site_transient_update_core', '__return_null' );
	add_filter( 'pre_site_transient_update_plugins', '__return_null' );
}
// *デフォルトではGITでバージョン管理していると自動更新が効かないのでこちらで回避.
add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );



if ( ! function_exists( 'pdf_image_media_library_preview' ) ) {
		/**
		 * Xserverはpdfの画像を生成しているので
		 * PDFの画像をメディアライブラリに表示するようにする
		 *
		 * @param string $query  クエリ.
		 */
	function pdf_image_media_library_preview( $query ) {
		global $wpdb;
		$post_parent             = ( isset( $query['post_parent'] ) && $query['post_parent'] ? '&post_parent=' . $query['post_parent'] : '' );
		$query['post_mime_type'] = array( 'image', 'application/pdf' );
		if ( isset( $query['post_parent'] ) && $query['post_parent'] ) {
			$post__in = array();
// @codingStandardsIgnoreStart
			$results  = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE $wpdb->posts.post_parent = " . $query['post_parent'] . " AND $wpdb->posts.post_type = 'attachment' " );
// @codingStandardsIgnoreEnd
			if ( $results ) :
				foreach ( $results as $result ) :
					$post__in[]   = $result->ID;
					$thumbnail_id = get_post_meta( $result->ID, '_thumbnail_id', true );
					if ( get_post_mime_type( $result->ID ) === 'application/pdf' && $thumbnail_id ) {
						$post__in[] = $thumbnail_id;
					}
				endforeach;
			endif;
			if ( $post__in ) {
				$query['post_parent'] = false;
				$query['post__in']    = $post__in;
			}
		}
		return $query;
	}
}
add_filter( 'ajax_query_attachments_args', 'pdf_image_media_library_preview', 11, 1 );
