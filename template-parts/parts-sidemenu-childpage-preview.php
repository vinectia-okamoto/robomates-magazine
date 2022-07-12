<?php
/**
* 子ページ表示用
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
  $args = array(
  'post_parent' =>$most_par_id,
  'post_type' => 'page',
  'order' => 'asc',
  'orderby' => 'menu_order',
  'posts_per_page' =>-1
  );
  $the_query = new WP_Query($args);
?>


<?php if ( $the_query ) : ?>
<?php if ( $the_query->have_posts() ) : ?>
<aside class="sideMenuBox">
	<h3><?php echo $most_par_title;?></h3>
	<ul class="sideChildPageList">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile;?>
	</ul>
</aside>
<?php endif; wp_reset_postdata(); ?>
<?php endif;?>