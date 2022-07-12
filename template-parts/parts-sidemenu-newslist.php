<?php
/**
 * サイドメニューお知らせ用
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php 
$most_par_post = get_most_parent_page();
$most_par_id = $most_par_post->ID;
$most_par_post = get_post($most_par_id);
$most_par_title = get_the_title($most_par_post);

if($most_par_id === 5){//親が宿泊施設
$targetCat = 9;
}elseif($most_par_id === 6){//親がレジャー
    $targetCat = 11;
}elseif($most_par_id === 7){//親がスポーツ
    $targetCat = 12;
}elseif($most_par_id === 7){//親がレストラン
    $targetCat = 13;
}else{
	$targetCat = NULL;
}

$args = array(
'category__in' => array($targetCat), 
 'orderby' => 'post_date',
 'order' => 'DESC',
 'post_type' => 'post',
 'post_status' => 'publish'
);
?>
<?php $the_query = new WP_Query($args);

if ( $the_query->have_posts() ) :?>
<aside class="side-area widget widget_block">
	<h3><?php echo $most_par_title;?>関連の<br>最近の記事</h3>
	<ul class="wp-block-latest-posts__list has-dates wp-block-latest-posts">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post();?>
		<?php 
     $thisPostID = get_the_ID();
     $thisPostType = get_post_type( $thisPostID );    
    ?>
		<li>
			<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			<div><time class="wp-block-latest-posts__post-date" datetime="<?php the_time('c'); ?>"><?php the_time('Y年n月j日'); ?></time></div>
		</li>
		<?php endwhile; ?>
	</ul>
</aside>
<?php endif; ?>
<?php wp_reset_postdata(); ?>