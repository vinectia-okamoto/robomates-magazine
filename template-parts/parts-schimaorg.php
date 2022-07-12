
<?php
//参考にしたサイト
//https://www.itti.jp/web-design/microdata-json-ld/
//共通の情報
  $schimalogo_url = get_template_directory_uri().'/images/favicon_icon_ogp_schima/schima-logo.png'; //画像サイズは 600 x 60px の矩形
  $schimalogo_width = 300;
  $schimalogo_height = 78;

 ?>
<?php if ( is_single() ): ?>
<?php
  // image（画像）の指定のためにアイキャッチ画像の情報を取得します
  $thumbnail_id = get_post_thumbnail_id($post->ID); // アタッチメントIDの取得
  $image = wp_get_attachment_image_src( $thumbnail_id, 'large' ); // アイキャッチの情報を取得
if($image){
  $src = $image[0];    // URL
  $width = $image[1];  // 横幅
 $height = $image[2]; // 高さ
}else{
$src = get_template_directory_uri().'/images/favicon_icon_ogp_schima/noimage-schima.png'; //画像サイズは 600 x 60px の矩形
  $width = 1100;  // 横幅
 $height = 730; // 高さ
}
?>
<?php $postid =get_the_ID();?>
<?php $meta_description = get_post_custom_values('meta_description', $postid );?>

<?php if ($meta_description ):?>
<?php if($meta_description[0]): //カスタムディスクリプションあるなら?>
<?php $schima_description = esc_attr(trim($meta_description)); ?>
<?php endif;?>
<?php else: //カスタムディスクリプションないなら?>
<?php $schima_description = mb_substr(str_replace(array("\r\n", "\r", "\n", " ", "　","・・・","続きを読む","more"), '', strip_tags(get_the_excerpt())), 0, 120);?>
<?php endif;?>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage":{
      "@type":"WebPage",
      "@id":"<?php the_permalink(); ?>"
    },
    "headline": "<?php echo get_the_title(); ?>",
    "image": {
      "@type": "ImageObject",
      "url": "<?php echo $src; ?>",
      "height": <?php echo $height; ?>,
      "width": <?php echo $width; ?>
    },
    "datePublished": "<?php echo get_the_date(DATE_ISO8601); ?>",
    "dateModified": "<?php if ( get_the_date() != get_the_modified_time() ){ the_modified_date(DATE_ISO8601); } else { echo get_the_date(DATE_ISO8601); } ?>",
    "author": {
      "@type": "Organization",
      "name": "<?php bloginfo('name'); ?>"
    },
    "publisher": {
      "@type": "Organization",
      "name": "<?php bloginfo('name'); ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?php echo $schimalogo_url; ?>",
        "width": <?php echo $schimalogo_width; ?>,
        "height":<?php echo $schimalogo_height; ?>
      }
    },
    "description": "<?php echo $schima_description; ?>"
  }
</script>

<?php elseif ( is_front_page() && is_home() ) : ?>

<script type="application/ld+json">
{
    "@context" : "https://schema.org",
    "@type" : "Organization",
    "name" : "<?php bloginfo('name'); ?>",
    "description" : "<?php echo get_bloginfo( 'description' );?>",
    "url" : "<?php bloginfo('url'); ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?php echo $schimalogo_url; ?>",
        "width": <?php echo $schimalogo_width; ?>,
        "height":<?php echo $schimalogo_height; ?>
      },
    "telephone" : "075-415-3661",

 "address":{
  "@type":"PostalAddress",
  "streetAddress":"上京区下立売通小川東入",
  "addressLocality":"京都市",
  "addressRegion":"京都府",
  "postalCode":"602-8048",
  "addressCountry":"JP"
 },
    "contactPoint" :[
        { "@type" : "ContactPoint",
        "telephone" : "075-415-3661",
        "contactType" : "customer service"
        }
        ]}
 
}
</script>

<?php endif; ?>