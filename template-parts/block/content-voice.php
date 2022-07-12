<?php
/**
 * Block Name: voice
 *
 */
// Create class attribute allowing for custom "className" and "align" values.
$classes = '';
if( !empty($block['className']) ) {
		$classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
		$classes .= sprintf( ' align%s', $block['align'] );
}
?><?php

$paged  = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$posts_par_page = 4;


$args = array(
'posts_per_page'   => $posts_par_page, //表示件数
'order' => 'DESC',
'orderby' => 'date menu_order',
'post_type' => 'voice',
'paged' => $paged
);
    
$the_query = new WP_Query($args);

?>
<?php if ($the_query->have_posts()) : ?>

<div id="ajax-list" class="voiceCardWrap">
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>


	<div class="voiceCard animated animate__fadeIn">



		<?php if(has_post_thumbnail()):?>
		<?php $image_id = get_post_thumbnail_id ();
$image_data = wp_get_attachment_image_src ($image_id, 'medium');
$image_url = $image_data[0];
$cardtitle = get_the_title();
?>
		<div class="row">
			<div class="col-12 col-md-7 col-lg-8 mb10">
				<h3 class="card-title"><?php the_title(); ?></h3>
				<div class="card-cont"><?php the_content(); ?></div>
			</div><!-- /col -->
			<div class="col-12 col-md-5 col-lg-4">
				<div class="card-facearea tac"><img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr( $cardtitle ); ?>"></div>
			</div><!-- /col -->
		</div><!-- /row -->
		<?php else://画像ないなら?>
		<h3 class="card-title"><?php the_title(); ?></h3>
		<div class="card-cont mb20"><?php the_content(); ?></div>
		<?php endif;?>
	</div><!-- /card -->


	<?php endwhile;?>

</div>
<!--/cardWrap-->
<?php
$maxpage =  $the_query->max_num_pages;
?>

<div id="voiceNext" data-maxpagenum="<?php echo $maxpage; ?>">
	<a href="<?php echo next_posts(0, false); ?>">次の記事を表示する</a>
	<div id="ajaxloading" class="svg-loader">
		<svg class="svg-container" height="50" width="50" viewBox="0 0 50 50">
			<circle class="loader-svg bg" cx="25" cy="25" r="20"></circle>
			<circle class="loader-svg loading-animate" cx="25" cy="25" r="20"></circle>
		</svg>
	</div>
</div>




<?php else:?>

<p class="tac">お客様の声は現在準備中です。</p>

<?php endif; wp_reset_postdata();?>
</div>