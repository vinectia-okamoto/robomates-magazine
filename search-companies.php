<?php
/**
 * 会社サーチテンプレート
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
global $wp_query;

$search_query = get_search_query();
if ( isset( $_GET['selectcats'] ) ) {
	$selectcats_id = filter_input( INPUT_GET, 'selectcats', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );

}

$companiesquery = array(
	array(
		'taxonomy'         => 'companies_category',
		'terms'            => $selectcats_id,
		'include_children' => false,
		'field'            => 'term_id',
		'operator'         => 'IN',
	),
);
$args           = array(
	'tax_query'      => $companiesquery,
	'posts_per_page' => -1,
);
$the_query      = new WP_Query( $args );

$total_results = $the_query->found_posts;
?>
<?php
get_header();

?>
<!-- ******************** pageHero ******************** -->

<section id="pageHero">
<div class="pageHero-inner container">
<div class="pageHero-titleWrap">
<h1 class="pageHero-title">
<span>
ロボット関連企業検索
</span>
</h1>

</div>
</div>
</section>

<!-- ******************** breadcrumbs ******************** -->
<?php get_template_part( 'template-parts/parts-breadcrumbs' ); ?>

<!-- ******************** contentWrap ******************** -->
<div class="contentWrap">

<!-- ******************** contentMain ******************** -->
<div class="contentMain">
<div class="editor-styles-wrapper">
<div class="reslut-txt">

<?php
if ( $search_query || $selectcats_id ) :
	?>
<p class="mb20">
	<?php
	if ( $selectcats_id ) {
		echo 'カテゴリ：';
		$loopcount = 1;
		$countall  = count( $selectcats_id );
		foreach ( $selectcats_id as $selectcat_id ) {
			if ( ( 1 === $loopcount ) ) {
				echo '「';
			}
			$setterm      = get_term( $selectcat_id );
			$setterm_name = $setterm->name;
			echo esc_html( $setterm_name );

			if ( ! ( $countall === $loopcount ) ) {
				echo '、';
			} else {
				echo '」';
			}
			$loopcount ++;
		}
		if ( $search_query ) {
			echo '＋';}
	}
	if ( $search_query ) {
		echo 'キーワード「' . esc_html( $search_query ) . '」';
	};
	?>
	の検索結果：<?php echo esc_html( $total_results ); ?>件見つかりました。</p>

<?php else : ?>
<p class="mb20">申し訳有りません。見つかりませんでした。</p>
<?php endif; ?>
</div>
</div>
<?php
if ( $the_query->have_posts() ) :
	?>
		<div class="container">
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
	</div>

<?php else : // 該当なしの場合. ?>
<h2><?php echo esc_html( $search_query ); ?> に一致する情報は見つかりませんでした。</h2>
<?php endif; ?>
</div>
<!-- ▲.contentMain▲ -->
</div>
<!-- ▲.contentWrap▲ -->

<!-- ******************** footer ******************** -->
<?php get_footer(); ?>
