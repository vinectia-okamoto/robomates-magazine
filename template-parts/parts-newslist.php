<?php
/**
 * お知らせ用
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( have_posts() ) : ?>
	<?php
	$nocat_class = '';
	if ( 'research' === get_post_type() ) {
		$nocat_class = 'nocat';
	};
	?>
<ul class="newsList mb30 <?php echo esc_attr( $nocat_class ); ?>">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<?php
		$this_post_id   = get_the_ID();
		$this_post_type = get_post_type( $this_post_id );
		if ( is_post_type_archive() ) {
			$taxonomies = get_taxonomies();
			$thiscats   = get_the_terms( $post->ID, $taxonomies );
		} else {
			$thiscats = get_the_category();
		}
		if ( $thiscats ) {
			$thiscat       = $thiscats[0];
			$category_id   = $thiscat->term_id;
			$category_link = get_term_link( $category_id );
			$labelcolor    = get_category_color();
			if ( $labelcolor ) {
				$labelstyle = 'background-color:' . $labelcolor;
			} else {
				$labelstyle = null;
			}
			$category_name = $cat->name;
		}
		?>


<li class="">
<div class="news-head">
<div class="news-date"><time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time></div>
		<?php if ( $cat ) : ?>
<div class="news-cat"><a href="<?php echo esc_url( $category_link ); ?>"><span style="<?php echo esc_attr( $labelstyle ); ?>"><?php echo esc_html( $category_name ); ?></span></a></div>
		<?php endif; ?>
</div>
<div class="news-body">
<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
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
<p>申し訳ありません。お知らせは見つかりませんでした。</p>
<?php endif; ?>



<?php wp_reset_postdata(); ?>
