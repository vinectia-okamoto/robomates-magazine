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
$args = array(
 'orderby' => 'modified',
 'order' => 'DESC',
 'post_type' => 'post',
 'post_status' => 'publish',
  'paged' => $paged,
  'category__not_in' => array(1)
);


?>
<?php $the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :?>
<ul class="newsListCard mb30">
	<?php while ( $the_query->have_posts() ) : $the_query->the_post();?>

	<li class="inview_fadeInUp">
		<div class="newsListCard-row">
			<?php $cardtitle = get_the_title();?>
			<div class="news-imgArea">
				<a href="<?php the_permalink(); ?>">
					<?php
$firstimage_get = preg_match_all( '/<img.+class=[\'"].*wp-image-([0-9]+).*[\'"].*>/i', $post->post_content, $matches );
$firstimage_url ="";
if($firstimage_get){$image_id = $matches[1][0];} else{ $image_id = $matches[0];}
if($image_id){
 $image_url_thumb = wp_get_attachment_image_src( $image_id, 'custom_600x400');
if($image_url_thumb){$firstimage_url = $image_url_thumb[0];}
}
?>
					<?php $date = "Y年n月j日";
		$postdate = get_post_time( $date );
		$update = get_post_modified_time( $date );
		$update_md = get_post_modified_time( "n月j日" );
		$update_md_time = get_post_modified_time( "c" );
		if( !($postdate == $update) ){
		$koushinTxt = '<time itemprop="dateModified" datetime="'.$update_md_time.'"><span>（'.$update_md.'更新）</span></time>';
			}
			?>

					<?php if(has_post_thumbnail()):?>
					<?php $image_id = get_post_thumbnail_id ();
$image_data = wp_get_attachment_image_src ($image_id, 'custom_600x400');
$image_url = $image_data[0];
?>
					<img class="news-img" src="<?php echo $image_url; ?>" alt="<?php echo esc_attr( $cardtitle ); ?>">
					<?php elseif($firstimage_url):?>
					<img class="news-img" src="<?php echo $firstimage_url; ?>" alt="<?php echo esc_attr( $cardtitle ); ?>">
					<?php else:?>
					<?php $noimage = get_template_directory_uri().'/assets/images/common/noimage-600x400.png';?>
					<img class="news-img" src="<?php echo $noimage; ?>" alt="<?php echo esc_attr( $cardtitle ); ?>">
					<?php endif; ?>
				</a>
			</div>
			<div class="news-txtArea">
				<div class="news-head">

					<div class="news-date"><time datetime="<?php the_time('c'); ?>"><?php the_time('Y.m.d'); ?><?php echo $koushinTxt;?></time></div>

					<?php if (is_post_type_archive()){ $taxonomies = get_taxonomies(); $cats = get_the_terms($post->ID,$taxonomies);}else{$cats = get_the_category(); }
 if($cats){
    echo '<div class="news-cat">';
    foreach($cats as $cat) {
        $category_link = get_term_link( $cat->term_id );
        $labelcolor = get_category_color();
        if($labelcolor){$labelstyle = 'background-color:'.$labelcolor;}else{$labelstyle = NULL;}
       $category_name = $cat->name;
       echo '<a href="'.$category_link.'"><span style="'.$labelstyle.'">'.$category_name.'</span></a>';
    }
    echo '</div>';
}
?>
				</div>
				<p class="news-title">
					<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
				</p>
				<?php if (get_the_excerpt()):?><p class="news-txt"><?php echo get_the_excerpt(); ?></p><?php endif; ?>
				<p class="news-btn"><a href="<?php the_permalink() ?>">続きを読む</a></p>
			</div>
		</div>
	</li>

	<?php endwhile; ?>
</ul>


<?php if (function_exists('responsive_pagination')) {
	echo '<div>'
  responsive_pagination($the_query->max_num_pages//上を見て$the_queryか$wp_queryどっちで書いているか確認
  );} ?>


<?php else : ?>
<p>申し訳ありません。お知らせは見つかりませんでした。</p>
<?php endif; ?>
