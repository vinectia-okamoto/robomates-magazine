<?php
/**
 * Parts 企業カード
 *
 * @package robomates-magazine
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>


<?php
if ( is_singular( 'companies' ) ) {
	global $post;
	$thisterm = array_shift( get_the_terms( $post->ID, 'companies_category' ) );
	$args     = array(
		'orderby'        => 'rand',
		'order'          => 'DESC',
		'post_type'      => 'companies',
		'taxonomy'       => 'companies_category',
		'post_status'    => 'publish',
		'term'           => $thisterm->slug,
		'posts_per_page' => 6,
		'post__not_in'   => array( $post->ID ),
	);
} else {
	$args = $wp_query->query;
}

?>
<?php $the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>
<ul class="companiesList noteditor">
		<?php
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
				$company_address = get_acfblock_data( $post, $block_name = 'acf/companydata', $field_name = 'company-address' );
			if ( has_post_thumbnail() ) {
				$image_id   = get_post_thumbnail_id();
				$image_data = wp_get_attachment_image_src( $image_id, 'medium' );
				$image_url  = $image_data[0];
			} else {
				$image_url = get_template_directory_uri() . '/assets/images/common/noimage.png';
			}
			?>
<li class="companiesCard inview_fadeInUp">
<div class="imgArea">
<a href="<?php the_permalink(); ?>">
<img class="" src="<?php echo esc_url( $image_url ); ?>" alt="" />
</a>
</div>
<div class="txtArea">
			<?php $company_read = get_acfblock_data( $post, $block_name = 'acf/companyhero', $field_name = 'robocom-hero-read' );if ( $company_read ) : ?>
<h5 class="title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $company_read ); ?></a></h5>
<?php endif; ?>
			<?php
				$thiscats = get_the_terms( $post->ID, 'companies_category' );
			if ( $thiscats ) {
				echo '<div class="cat">';
				foreach ( $thiscats as $thiscat ) {
					$thiscat_id   = $thiscat->term_id;
					$thiscat_url  = get_term_link( $thiscat_id );
					$thiscat_name = $thiscat->name;
					echo '<a href="' . esc_url( $thiscat_url ) . '">' . esc_html( $thiscat_name ) . '</a>';
				}
				echo '</div>';
			}
			?>
<p class="companyName"><?php the_title(); ?></p>
			<?php if ( $company_address ) : ?>
<p class="address"><?php echo esc_html( $company_address ); ?></p>
<?php endif; ?>
</div>
</li>
		<?php endwhile; ?>

</ul>
		<?php
		if ( function_exists( 'responsive_pagination' ) ) {
			responsive_pagination(
				$wp_query->max_num_pages
			);
		}
		?>
<?php else : ?>
<p>申し訳ありません。お探しの企業が見つかりませんでした。</p>
<?php endif; ?>



<?php wp_reset_postdata(); ?>
