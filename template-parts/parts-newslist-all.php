<?php
/**
 * お知らせ用
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args  = array(
	'orderby'     => 'post_date',
	'order'       => 'DESC',
	'post_type'   => 'post',
	'post_status' => 'publish',


	'paged'       => $paged,
);
?>
<?php
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :
	?>
<ul class="newsList mb30">
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		?>
		<?php
		$this_post_id   = get_the_ID();
		$this_post_type = get_post_type( $this_post_id );
		if ( is_post_type_archive() ) {
			$taxonomies = get_taxonomies();
			$cat        = get_the_terms( $post->ID, $taxonomies );

		} else {
			$cat = get_the_category(); }
		if ( $cat ) {
			$cat           = $cat[0];
			$category_id   = $cat->term_id;
			$category_link = get_term_link( $category_id );
			$labelcolor    = get_category_color();
			if ( $labelcolor ) {
				$labelstyle = 'background-color:' . $labelcolor;
			} else {
				$labelstyle = null;}
			$category_name = $cat->name;
		}
		?>

	<li class="inview_fadeInUp">
		<div class="news-head">
			<div class="news-date"><time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time></div>
			<?php
			if ( $cat ) :
				?>
				<div class="news-cat"><a href="<?php echo $category_link; ?>"><span style="<?php echo $labelstyle; ?>"><?php echo $category_name; ?></span></a></div><?php endif; ?>
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
			$the_query->max_num_pages// 上を見て$the_queryか$wp_queryどっちで書いているか確認
		);
	}
	?>
<?php else : ?>
<p>申し訳ありません。お知らせは見つかりませんでした。</p>
<?php endif; ?>



<?php wp_reset_postdata(); ?>
