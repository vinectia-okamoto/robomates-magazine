<?php
/**
 * Schima ORG Function
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
function schimaorg_func() {
	 global $post;
	// 参考にしたサイト
	// https://www.itti.jp/web-design/microdata-json-ld/
	// 共通の情報
	$schimalogo_url    = get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/schima-logo.png'; // 画像サイズは 600 x 60px の矩形
	$schimalogo_width  = 300;
	$schimalogo_height = 140;

	$noimage_schimaimage_url    = get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/noimage-schima.png';
	$noimage_schimaimage_width  = 1100;  // 横幅
	$noimage_schimaimage_height = 730; // 高さ

	$schimaimage_1x1  = get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/schimaImage-1x1.png';
	$schimaimage_4x3  = get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/schimaImage-4x3.png';
	$schimaimage_16x9 = get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/schimaImage-16x9.png';

	$addressRegion   = '兵庫県'; // 都道府県
	$addressLocality = '神戸市北区'; // 市区町村
	$streetAddress   = 'しあわせの村1番1号'; // 市区町村以降（番地など）
	$postalCode      = '〒651-1106'; // 郵便番号
	$addressCountry  = 'JP'; // 国
	$telephone       = '078-743-8000';
	$contactType     = '' // customer support

	?>
	<?php if ( is_single() ) : ?>
		<?php
		// image（画像）の指定のためにアイキャッチ画像の情報を取得します
		$thumbnail_id = get_post_thumbnail_id( $post->ID ); // アタッチメントIDの取得
		$image        = wp_get_attachment_image_src( $thumbnail_id, 'large' ); // アイキャッチの情報を取得
		if ( $image ) {
			$src    = $image[0];    // URL
			$width  = $image[1];  // 横幅
			$height = $image[2]; // 高さ
		} else {
			$src    = $noimage_schimaimage_url;
			$width  = $noimage_schimaimage_width;
			$height = $noimage_schimaimage_height;
		}
		?>
		<?php $postid = get_the_ID(); ?>
		<?php $meta_description = get_post_custom_values( 'meta_description', $postid ); ?>

		<?php if ( $meta_description ) : ?>
			<?php
			if ( $meta_description[0] ) : // カスタムディスクリプションあるなら
				?>
				<?php $schima_description = esc_attr( trim( $meta_description[0] ) ); ?>
			<?php endif; ?>
			<?php
	else : // カスタムディスクリプションないなら
		?>
		<?php $schima_description = mb_substr( str_replace( array( "\r\n", "\r", "\n", ' ', '　', '・・・', '続きを読む', 'more' ), '', strip_tags( get_the_excerpt() ) ), 0, 120 ); ?>
	<?php endif; ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "NewsArticle",
	"mainEntityOfPage": {
		"@type": "WebPage",
		"@id": "<?php the_permalink(); ?>"
	},
	"headline": "<?php echo get_the_title(); ?>",
	"image": {
		"@type": "ImageObject",
		"url": "<?php echo $src; ?>",
		"height": <?php echo $height; ?>,
		"width": <?php echo $width; ?>
	},
	"datePublished": "<?php echo get_the_date( DATE_ISO8601 ); ?>",
	"dateModified": "
		<?php
		if ( get_the_date() != get_the_modified_time() ) {
														the_modified_date( DATE_ISO8601 );
		} else {
			echo get_the_date( DATE_ISO8601 );
		}
		?>
													",
	"author": {
		"@type": "Organization",
		"name": "<?php bloginfo( 'name' ); ?>"
	},
	"publisher": {
		"@type": "Organization",
		"name": "<?php bloginfo( 'name' ); ?>",
		"logo": {
			"@type": "ImageObject",
			"url": "<?php echo $schimalogo_url; ?>",
			"width": <?php echo $schimalogo_width; ?>,
			"height": <?php echo $schimalogo_height; ?>
		}
	},
	"description": "<?php echo $schima_description; ?>"
}
</script>

	<?php elseif ( is_front_page() && is_home() ) : ?>

<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "LocalBusiness",
	"name": "<?php bloginfo( 'name' ); ?>",
	"description": "<?php echo get_bloginfo( 'description' ); ?>",
	"url": "<?php bloginfo( 'url' ); ?>",
	"image": [
		"<?php echo $schimaimage_1x1; ?>",
		"<?php echo $schimaimage_4x3; ?>",
		"<?php echo $schimaimage_16x9; ?>"
	],
	"logo": {
		"@type": "ImageObject",
		"url": "<?php echo $schimalogo_url; ?>",
		"width": <?php echo $schimalogo_width; ?>,
		"height": <?php echo $schimalogo_height; ?>
	},
	"telephone": "<?php echo $telephone; ?>",

	"address": {
		"@type": "PostalAddress",
		"streetAddress": "<?php echo $streetAddress; ?>",
		"addressLocality": "<?php echo $addressLocality; ?>",
		"addressRegion": "<?php echo $addressRegion; ?>",
		"postalCode": "<?php echo $postalCode; ?>",
		"addressCountry": "<?php echo $addressCountry; ?>"
	},
	"geo": "34.709871,135.114107",
	"alternateName": "しあわせの村",
	"contactPoint": [{
		"@type": "ContactPoint",
		"telephone": "<?php echo $telephone; ?>",
		"contactType": "<?php echo $contactType; ?>"
	}]
}

}
</script>

		<?php
	endif;
};
add_action( 'wp_footer', 'schimaorg_func' );
