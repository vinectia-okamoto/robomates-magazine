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
<?php $check_post_type = get_post_type(); ?>
<?php
if ( 'post' !== $check_post_type && 'attachment' !== $check_post_type && is_single() ) {
	$container_class = 'container';
} else {
	$container_class = 'container-xl';}
?>
<section id="pageHero">
<div class="pageHero-inner <?php echo esc_attr( $container_class ); ?>">
<div class="pageHero-titleWrap">
<?php $show_categories = apply_filters( 'vinectia_show_categories_in_entry_header', true ); ?>
<?php if ( 'post' !== $check_post_type && 'attachment' !== $check_post_type && is_single() ) : // カスタム投稿かどうか. ?>
	<?php
	$check_post_type_object       = get_post_type_object( $check_post_type ); // 投稿タイプの情報を取得.
	$check_post_type_object_label = $check_post_type_object->label;
	?>
<h2 class="pageHero-title"><span><?php echo esc_html( $check_post_type_object_label ); ?></span></h2>
<?php else : ?>
	<?php
	if ( true === $show_categories && has_category() ) {
		$cat_now  = get_the_category();
		$cat_now  = $cat_now[0];
		$cat_name = $cat_now->name; // 複数カテゴリでも一つだけにする.
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
<?php if ( 'post' !== $check_post_type && 'attachment' !== $check_post_type && is_single() ) : ?>
<?php else : ?>
<!-- ******************** contentRow ******************** -->
<div class="contentRow container-xl">
<?php endif; ?>
<!-- ******************** contentMain ******************** -->
<div class="contentMain">
<?php if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<?php if ( 'post' !== $check_post_type && 'attachment' !== $check_post_type && is_single() ) : ?>
			<?php get_template_part( 'loop-templates/content', get_post_type() ); ?>
<?php elseif ( is_single() ) : ?>
	<?php get_template_part( 'loop-templates/content', 'single' ); ?>
<?php else : ?>
	<?php get_template_part( 'loop-templates/content', get_post_type() ); ?>
<?php endif; ?>
<?php endwhile; ?>
	<?php
	if ( function_exists( 'vinectia_post_navi' ) ) {
		vinectia_post_navi();
	}
	?>
<?php else : ?>
	<?php get_template_part( 'loop-templates/content', 'none' ); ?>
<?php endif; ?>
</div>
<?php if ( 'post' !== $check_post_type && 'attachment' !== $check_post_type && is_single() ) : ?>
<?php else : ?>
<!-- ******************** contentSide ******************** -->
	<?php get_sidebar(); ?>
</div>
<!-- ▲.contentRow▲ -->
<?php endif; ?>

</div>
<!-- ▲.contentWrap▲ -->

<!-- ******************** footer ******************** -->
<?php get_footer(); ?>
