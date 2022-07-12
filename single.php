<?php
/**
 * シングルページテンプレート
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
<?php $show_categories = apply_filters( 'vinectia_show_categories_in_entry_header', true ); ?>
<?php if ( get_post_type() === 'voice' && is_single() ) : ?>
<h2 class="pageHero-title"><span><?php echo esc_html( get_post_type_object( get_post_type() )->label ); ?></span></h2>
<?php else : ?>
	<?php
	if ( true === $show_categories && has_category() ) {
		$cat_now  = get_the_category();
		$cat_now  = $cat_now[0];
		$cat_name = $cat_now->name;// 複数カテゴリでも一つだけにする.
		echo '<h2 class="pageHero-title"><span>' . esc_html( $cat_name ) . '</span></h2>';
	} else {
		the_title( '<h2 class="pageHero-title"><span>', '</span></h2>' );
	}
	?>
<?php endif; ?>
</div>
</div>
</section>

<!-- ******************** breadcrumbs ******************** -->
<?php get_template_part( 'template-parts/parts-breadcrumbs' ); ?>
<!-- ******************** contentWrap ******************** -->
<div class="contentWrap">
<!-- ******************** contentRow ******************** -->
<div class="contentRow">

<!-- ******************** contentMain ******************** -->
<div class="contentMain">
<?php if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<?php if ( is_singular( 'voice' ) ) : ?>
			<?php get_template_part( 'loop-templates/content', 'voice' ); ?>
		<?php elseif ( is_single() ) : ?>
			<?php get_template_part( 'loop-templates/content', 'single' ); ?>
		<?php else : ?>
			<?php get_template_part( 'loop-templates/content', get_post_type() ); ?>
		<?php endif; ?>

<?php endwhile; // end of the loop. ?>
	<?php
	if ( function_exists( 'vinectia_post_navi' ) ) {
		vinectia_post_navi(); }
	?>
<?php else : ?>
	<?php get_template_part( 'loop-templates/content', 'none' ); ?>
<?php endif; ?>
</div>

<!-- ******************** contentSide ******************** -->
<?php get_sidebar(); ?>

</div>
<!-- ▲.contentRow▲ -->
</div>
<!-- ▲.contentWrap▲ -->

<!-- ******************** footer ******************** -->
<?php get_footer(); ?>
