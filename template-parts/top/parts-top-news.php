<?php
/**
 * Parts Top News
 *
 * @package robomates-magazine
 */

?>
<?php
$hitotsumeargs = array(
	'orderby'        => 'post_date',
	'order'          => 'DESC',
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 1,
);

$ichiranargs = array(
	'orderby'        => 'post_date',
	'order'          => 'DESC',
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 5,
	'offset'         => 1,  // 一軒目とばす.
);
?>
<?php $the_query = new WP_Query( $hitotsumeargs ); ?>
<!-- ******************** topNews ******************** -->
<section id="topNews" class="topNews">
<div class="topNews-inner container-xl">

<div class="topNews-titleArea">
<h2 class="topNews-title sectionTitle"><span class="en">ROBOTS NEWS</span><span class="ja">ロボット関連イベントと最新情報</span></h2>
<p class="topNews-btnArea-pc"><a class="btn-primary" href="<?php echo esc_url( get_page_link( 13 ) ); ?>">お知らせ一覧へ</a></p>
</div>

<?php if ( $the_query->have_posts() ) : ?>
	<?php while ( $the_query->have_posts() ) : ?>
		<?php $the_query->the_post(); ?>
		<?php
		$thiscat = get_the_category();
		if ( $thiscat ) {
			$thiscat       = $thiscat[0];
			$category_id   = $thiscat->term_id;
			$category_link = get_term_link( $category_id );
			if ( function_exists( 'get_category_color' ) ) {
				$labelcolor = get_category_color();
			} else {
				$labelcolor = null;
			}
			if ( $labelcolor ) {
				$labelstyle = 'background-color:' . $labelcolor;
			} else {
				$labelstyle = null;}
			$category_name = $thiscat->name;
		}
		?>
				<?php
				$firstimage_get = preg_match_all( '/<img.+class=[\'"].*wp-image-([0-9]+).*[\'"].*>/i', $post->post_content, $matches );
				$firstimage_url = '';
				if ( $firstimage_get ) {
					$image_id = $matches[1][0];
				} else {
					$image_id = $matches[0];}
				if ( $image_id ) {
					$image_url_thumb = wp_get_attachment_image_src( $image_id, 'medium' );
					if ( $image_url_thumb ) {
						$firstimage_url = $image_url_thumb[0];}
				}
				?>
		<?php
		if ( has_post_thumbnail() ) {

			$image_id   = get_post_thumbnail_id();
			$image_data = wp_get_attachment_image_src( $image_id, 'medium' );
			$image_url  = $image_data[0];
		} elseif ( $firstimage_url ) {
			$image_url = $firstimage_url;
		} else {
			$image_url = get_template_directory_uri() . '/assets/images/common/noimage.png';
		}
		?>
<div class="topNews-row">
<div class="topNews-pickupArea">
<div class="news-img">
<a href="<?php the_permalink(); ?>"><img class="" src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr( get_the_title() ); ?>" /></a>
</div>
<div class="news-head">
<div class="news-date">
<time itemprop="datePublished" datetime="<?php the_time( 'c' ); ?>"><span><?php the_time( 'Y/m/d' ); ?></span></time>
</div>
<div class="news-cat">
<a href="<?php echo esc_attr( $category_link ); ?>"><span style="<?php echo esc_attr( $labelstyle ); ?>"><?php echo esc_html( $category_name ); ?></span></a>
</div>
</div>
<div class="news-body">
<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
</div>
</div>
<?php endwhile; ?>
<?php endif; ?>

<?php $the_query = new WP_Query( $ichiranargs ); ?>
<div class="topNews-listArea">
<?php if ( $the_query->have_posts() ) : ?>
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		?>
		<?php
		$thiscat = get_the_category();
		if ( $thiscat ) {
			$thiscat       = $thiscat[0];
			$category_id   = $thiscat->term_id;
			$category_link = get_term_link( $thiscategory_id );
			if ( function_exists( 'get_category_color' ) ) {
				$labelcolor = get_category_color();
			} else {
				$labelcolor = null;
			}
			if ( $labelcolor ) {
				$labelstyle = 'background-color:' . $labelcolor;
			} else {
				$labelstyle = null;}
			$category_name = $thiscat->name;
		}
		?>

<li class="inview_fadeIn" itemscope itemtype="http://schema.org/NewsArticle">
<div class="news-head">
<div class="news-date">
<time itemprop="datePublished" datetime="<?php the_time( 'c' ); ?>"><span><?php the_time( 'Y/m/d' ); ?></span></time>
</div>
<div class="news-cat">
<a href="<?php echo esc_url( $category_link ); ?>"><span style="<?php echo esc_attr( $labelstyle ); ?>"><?php echo esc_html( $category_name ); ?></span></a>
</div>
</div>
<div class="news-body">
<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
</div>
</li>

<?php endwhile; ?>
</ul>
<?php else : ?>

<?php endif; ?>
</div>
</div>
<p class="topNews-btnArea-sp"><a class="btn-primary" href="<?php echo esc_url( get_page_link( 13 ) ); ?>">お知らせ一覧へ</a></p>
</div>
</section>

<?php wp_reset_postdata(); ?>
