<?php
/**
 * 固定ページテンプレート
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php get_header(); ?>

<!-- ******************** pageHero ******************** -->
<section id="pageHero">
<div class="pageHero-inner container">
<div class="pageHero-titleWrap">
<?php
if ( is_page() && $post->post_parent ) {
		$parent_id    = $post->post_parent; // 親ページのIDを取得.
		$parent_title = get_post( $parent_id )->post_title; // 親ページのタイトルを取得.
		echo '<p class="pageHero-parenttitle"><span>' . esc_html( $parent_title ) . '</span></p>';
		the_title( '<h1 class="pageHero-title"><span>', '</span></h1>' );
} else {
		the_title( '<h1 class="pageHero-title"><span>', '</span></h1>' );
}
?>
</div>
</div>
</section>

<!-- ******************** breadcrumbs ******************** -->
<?php get_template_part( 'template-parts/parts-breadcrumbs' ); ?>

<!-- ******************** contentWrap ******************** -->
<div class="contentWrap">

<!-- ******************** contentMain ******************** -->
<div class="contentMain">
<main id="main" class="site-main wp-block-group"><!-- wp:group {"layout":{"inherit":true}} -->
<?php if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<?php get_template_part( 'loop-templates/content', 'page' ); ?>
	<?php endwhile; // end of the loop. ?>
<?php endif; ?>
</main>
</div>

</div>

<!-- ******************** footer ******************** -->
<?php get_footer(); ?>
