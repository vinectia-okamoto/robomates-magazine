<?php
/**
 * アーカイブページテンプレート
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
<?php
if ( 'post' !== $check_post_type && 'attachment' !== $check_post_type && is_single() ) {
	$container_class = 'container';
} else {
	$container_class = 'container-xl';}
?>
<!-- ******************** pageHero ******************** -->
<div id="pageHero">
<div class="pageHero-inner <?php echo esc_attr( $container_class ); ?>">
<div class="pageHero-titleWrap">
<?php the_archive_title( '<h1 class="pageHero-title"><span>', '</span></h1>' ); ?>
</div>
</div>
</div>
<!-- ******************** breadcrumbs ******************** -->
<?php get_template_part( 'template-parts/parts-breadcrumbs' ); ?>

<!-- ******************** contentWrap ******************** -->
<div class="contentWrap">
<!-- ******************** contentRow ******************** -->
<div class="contentRow container-xl">

<!-- ******************** contentMain ******************** -->
<div class="contentMain">
<?php if ( ! is_paged() ) : ?>
	<?php if ( category_description() ) : ?>
	<div class="entry-content">
		<div class="editor-styles-wrapper">
		<?php echo category_description(); ?>
</div>
	</div><!-- .entry-content -->
<?php endif; ?>
<?php endif; ?>
<?php
if ( is_post_type_archive( 'companies' ) || is_tax( 'companies_category' ) ) {
	get_template_part( 'template-parts/parts-companies-card' );
} else {
	get_template_part( 'template-parts/parts-newslist' );
}
?>

</div>
<!-- ******************** contentSide ******************** -->
<?php get_sidebar(); ?>

</div>
<!-- ▲.contentRow▲ -->
</div>
<!-- ▲.contentWrap▲ -->
<!-- ******************** footer ******************** -->
<?php get_footer(); ?>
