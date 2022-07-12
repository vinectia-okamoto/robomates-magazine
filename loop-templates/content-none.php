<?php
/**
 * コンテンツパーツ：None
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<header class="entry-header">
<div class="entry-meta">
<?php vinectia_entrymeta(); ?>
</div>
<h1 class="entry-title">何も見つかりません</h1>
</header>

<div class="entry-content">
<div class="editor-styles-wrapper">
<?php
if ( is_front_page() && is_home() && current_user_can( 'publish_posts' ) ) {
	$adminurl = admin_url( 'post-new.php' );
	echo '<p>';
	echo '<p>最初の投稿を公開する準備はできましたか？ <a href="' . esc_url( $adminurl ) . '">ここから始めてください</a>';
	echo '</p>';
} elseif ( is_search() ) {
	echo '<p>申し訳ありませんが、検索キーワードに一致するものはありません。 別のキーワードでもう一度お試しください。</p>';
	get_search_form();
} else {
	echo '<p>申し訳ありません。お探しのものが見つからないようです。<a href="' . esc_url( home_url( '/' ) ) . '" rel="me">トップページ</a>はこちらになります。</p>';
	get_search_form();
}
?>
</div><!-- /.editor-styles-wrapper -->
</div><!-- .entry-content -->

</article><!-- #post-## -->
