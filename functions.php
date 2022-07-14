<?php
/**
 * Function 設定
 *
 * @package robomates-magazine
 */

?>
<?php
$vinectia_includes = array(
	'/theme-support.php',  // テーマサポート設定.
	'/enqueue.php', // スタイルとスクリプト設定.
	'/editor-function.php', // エディター設定.
	'/revision-autosave-function.php', // リビジョン・自動保存設定.
	'/menu-function.php', // メニュー設定.
	'/theme-function.php', // その他テーマの設定.
	'/dashboad-function.php', // ダッシュボードの設定.
	'/widgets-function.php', // ウィジェット設定.
	// '/class-custom-walker.php', // カスタムウォーカーメニュー追加.
	'/security.php', // セキュリティ設定.
	'/template-tags.php',  // テンプレートタグ設定.
	'/postnavi-pagenation.php', // ポストナビゲーションとページネーション設定.
	'/shortcode.php', // ショートコード.
	'/block-patterns.php', // ブロックパターン.

	'/acf.php', // ACFプラグインの設定.
	'/classes/class-wpwidget-recent-posts-override.php', // ウィジェットで記事タイトル→投稿日付となっているところを投稿日→記事タイトル.
	/** '/ogp.php', // OGP設定. */
	/** '/add-category-color-field.php', // カテゴリーに色のカスタムフィールドを追加. */
	'/custom-post-type.php', // カスタム投稿タイプ追加.
	/**  '/mwwpform-custom.php', // MWWFFORMプラグイン設定. */
	/** '/schimaorg-function.php', // 構造化マークアップ. */
	/** '/search-function.php',  //検索カスタム（カスタム投稿ある場合）. */
	/** '/pdf-manual.php',  //PDFマニュアル. */

);
foreach ( $vinectia_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		// @codingStandardsIgnoreStart
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', esc_attr( $file ) ), E_USER_ERROR );
		// @codingStandardsIgnoreEnd
	}
	require_once $filepath;
}
