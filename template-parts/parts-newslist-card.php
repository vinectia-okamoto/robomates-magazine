<?php
/**
 * お知らせ用
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( have_posts() ) : ?>
<ul class="newsListCard mb30">
	<?php while ( have_posts() ) : the_post();?>
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
 $image_url_thumb = wp_get_attachment_image_src( $image_id, 'thumbnail');
if($image_url_thumb){$firstimage_url = $image_url_thumb[0];}
}
?>
					<?php if(has_post_thumbnail()):?>
					<?php $image_id = get_post_thumbnail_id ();
$image_data = wp_get_attachment_image_src ($image_id, 'thumbnail');
$image_url = $image_data[0];
?>
					<img class="news-img" src="<?php echo $image_url; ?>" alt="<?php echo esc_attr( $cardtitle ); ?>">
					<?php elseif($firstimage_url):?>
					<img class="news-img" src="<?php echo $firstimage_url; ?>" alt="<?php echo esc_attr( $cardtitle ); ?>">
					<?php else:?>
					<?php $noimage = get_template_directory_uri().'/assets/images/common/noimage-thumb.png';?>
					<img class="news-img" src="<?php echo $noimage; ?>" alt="<?php echo esc_attr( $cardtitle ); ?>">
					<?php endif; ?>
				</a>
			</div>
			<div class="news-txtArea">
				<div class="news-head">
					<div class="news-date"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time></div>
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
  responsive_pagination($wp_query->max_num_pages//通常は$additional_loop
  );
} ?>
<?php else : ?>
<p>申し訳ありません。記事が見つかりませんでした。</p>
<?php endif; ?>



<?php wp_reset_postdata(); ?>