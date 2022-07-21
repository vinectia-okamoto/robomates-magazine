<?php
/**
 * Parts Top EXL
 *
 * @package robomates-magazine
 */

?>
<?php
$args = array(
	'posts_per_page' => 6,
	'post_type'      => 'exp-blog',
	'order'          => 'DESC',
);
?>
<!-- ******************** topEXL ******************** -->
<section id="topEXL" class="topEXL">
	<div class="topEXL-inner container-xl">
		<div class="topEXL-titleArea">
			<div class="topEXL-titleArea-txtWrap">
				<h2 class="topEXL-title sectionTitle"><span class="en">EXPERIENTIAL LEARNING</span><span class="ja">ロボットを体験する</span></h2>
				<p class="topEXL-txt">ロボット関連企業でのインターンシップ体験レポート。学生の皆さんが、インターンでの体験内容などを紹介してくれます。<br>
					ロボットやインターンシップに興味のある方は必見です！</p>
			</div>
			<div class="topEXL-titleArea-chara">
				<img class="" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/top/topEXL-chara.png' ); ?>" alt="" />
			</div>
		</div>

		<?php
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			?>

		<ul class="exlList">
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
			<li class="exlCard inview_fadeInUp">
				<div class="imgArea"><a href="<?php the_permalink(); ?>"><img class="" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a></div>
				<div class="txtArea">
					<p class="date"><time itemprop="datePublished" datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'Y/m/d' ); ?></time></p>
					<h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
		<div class="topEXL-btnArea"><a class="btn-primary" href="<?php echo esc_url( get_post_type_archive_link( 'exp-blog' ) ); ?>">インターンシップ体験ブログへ</a></div>
		<?php else : ?>
		<p>現在体験ブログは準備中です。</p>
		<?php endif; ?>
	</div>
	</div>
</section>
