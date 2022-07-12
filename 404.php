<?php
/**
 * 404 page
 *
 * @package robomates-magazine
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
?>

<!-- ▼▼#pageHero▼ -->
<div id="pageHero">
	<div class="pageHero-inner container">
		<div class="pageHero-titleWrap">
			<h1 class="pageHero-title">404: Page Not Found.</h1>
		</div>
	</div>
</div>
<!-- ▲▲#pageHero▲▲ -->

<?php
if ( function_exists( 'bcn_display' ) ) {
	echo '<div class="breadcrumb"><div class="container">';
	bcn_display();
	echo '</div></div>';
}
?>

<!-- ******************** contentWrap ******************** -->
<div class="contentWrap">

<!-- ******************** contentMain ******************** -->
<div class="contentMain">
		<main class="site-main" id="main">
			<div class="container">
				<div class="entry-content editor-styles-wrapper">

					<p class="tac">申し訳ございません、お探しのページは見つかりませんでした。<br />
						入力したURLが誤っているか、ページが消え去った可能性があります。</p>
					<p class="tac">URLをご確認の上再読み込みするか、<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="me">トップページ</a>へお戻りください。</p>
					<p class="tac mt30 "><a class="wp-block-button__link" style="border-radius:50px" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップページへ</a></p>
				</div>
			</div><!-- /.container-->
		</main><!-- #main -->
	</div>
	<!-- ▲▲.content-main▲▲ -->

</div>
<!-- ▲▲.contentWrap▲▲ -->

<?php
get_footer();
