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

<!-- ******************** pageHero ******************** -->
<div id="pageHero">
<div class="pageHero-inner container">
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
<div class="contentRow">

<!-- ******************** contentMain ******************** -->
<div class="contentMain">

	<?php get_template_part( 'template-parts/parts-newslist' ); ?>

</div>
<!-- ******************** contentSide ******************** -->
<?php get_sidebar(); ?>

</div>
<!-- ▲.contentRow▲ -->
</div>
<!-- ▲.contentWrap▲ -->
<!-- ******************** footer ******************** -->
<?php get_footer(); ?>
