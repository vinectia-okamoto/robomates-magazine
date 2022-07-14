<?php
/**
 * Parts Top Companies
 *
 * @package robomates-magazine
 */

?>
<?php
$args = array(
	'posts_per_page' => 6,
	'post_type'      => 'companies',
	'order'          => 'DESC',
);
?>
<!-- ******************** topCompanies ******************** -->
<section id="topCompanies" class="topCompanies">
	<h2 class="topCompanies-title sectionTitle container"><span class="en">ROBOTICS COMPANIES</span><span class="ja">ロボット関連企業</span></h2>
	<div class="topCompanies-inner container-xl">
		<div class="topCompanies-txtArea">
			<div class="topCompanies-chara-men"><img class="" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/top/topCompanies-chara-men.png' ); ?>" alt="" /></div>
			<p class="topCompanies-txt">ロボットを導入して業務に活用している「ロボット導入企業」、 ロボットを使用した機械システムの導入提案や設計、組立などを行う「ロボットシステムインテグレータ」、ロボットの「開発企業」など、ロボットに関連した事業を行っている会社をご紹介します。</p>
			<div class="topCompanies-chara-women"><img class="" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/top/topCompanies-chara-women.png' ); ?>" alt="" /></div>
		</div>
		<div class="topCompanies-searchArea">
			検索作る
		</div>
		<?php
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			?>
		<ul class="companiesList">
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
			<li class="companiesCard">
				<div class="imgArea">
					<a href="<?php the_permalink(); ?>">
						<img class="" src="<?php echo esc_url( $image_url ); ?>" alt="" />
					</a>
				</div>
				<div class="txtArea">
					<?php $company_read = get_acfblock_data( $post, $block_name = 'acf/companyhero', $field_name = 'robocom-hero-read' ); ?>
					<?php if ( $company_read ) : ?>
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
							echo '<a href="' . esc_url( $thiscat__url ) . '">' . esc_html( $thiscat_name ) . '</a>';
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
		<div class="topCompanies-btnArea"><a class="btn-primary" href="<?php echo esc_url( get_post_type_archive_link( 'companies' ) ); ?>">ロボット関連企業紹介へ</a></div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
