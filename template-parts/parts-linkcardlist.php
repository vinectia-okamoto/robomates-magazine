<?php 
global $post;
 if ( is_page() && $post->post_parent == 0 ) :?>
		
<?php $post_id = $post->ID;
$args = array(
    'post_parent' =>$post_id,
    'post_type' => 'page',
    'order' => 'asc',
	'orderby' => 'menu_order',
	'posts_per_page' =>-1
    );
$the_query = new WP_Query($args);?>

<?php if ( $the_query->have_posts() ) : ?>
<div class="editor-styles-wrapper">
<ul class="miniLinkCardList noteditor">
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<li class="linkCard">
<a href="<?php the_permalink(); ?>" class="noicon inview_fadeIn">
<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
<h4 class="linkCard-title noteditor iconuse-this"><?php the_title(); ?></h4>
<?php $cardtxt = apply_filters( 'get_the_excerpt', get_post_field( 'post_excerpt' ) );?>
<?php if ( has_excerpt() ):?><p class="linkCard-txt"><?php echo  esc_html($cardtxt); ?></p><?php endif; ?>
</div>
</a>
</li>
<?php endwhile;?>
</ul>
</div>
<?php endif; wp_reset_postdata(); ?>
<?php endif;?>