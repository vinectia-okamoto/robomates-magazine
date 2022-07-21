<?php
/**
 * コンテンツパーツ：Single
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

	<div class="entry-content">
		<div class="editor-styles-wrapper">
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:' ),
					'after'  => '</div>',
				)
			);
			?>

		</div>
	</div><!-- .entry-content -->
	<?php
	if ( is_singular( 'companies' ) ) {
		global $post;
		$thisterm = array_shift( get_the_terms( $post->ID, 'companies_category' ) );
		$args     = array(
			'orderby'      => 'rand',
			'order'        => 'DESC',
			'post_type'    => 'companies',
			'taxonomy'     => 'companies_category',
			'post_status'  => 'publish',
			'term'         => $thisterm->slug,
			'post__not_in' => array( $post->ID ),
		);
	} else {
		$args = $wp_query->query;
	}

	?>
<?php $the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>

	<hr>

	<div class="editor-styles-wrapper">
		<h3>同じ関連カテゴリの企業</p>
	</div>
	<div class="container">
	<?php get_template_part( 'template-parts/parts-companies-card' ); ?>
	</div>
	<?php endif; ?>
</article><!-- #post-## -->
