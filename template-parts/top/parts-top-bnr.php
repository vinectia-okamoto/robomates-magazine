<?php
/**
 * Parts Top Bnr
 *
 * @package robomates-magazine
 */

?>
<?php if ( function_exists( 'get_field' ) ) : ?>
	<?php if ( have_rows( 'repeat_bnr', 'option' ) ) : ?>
<!-- ******************** topBnr ******************** -->
<section id="topBnr" class="topBnr">
<div class="topBnr-inner container-xl">
<ul class="bnrList">
		<?php
		while ( have_rows( 'repeat_bnr', 'option' ) ) :
			the_row();
			?>
			<?php
			$bnrimg_id = get_sub_field( 'bnr_img' );

			$bnrimg_data = wp_get_attachment_image_src( $bnrimg_id, 'medium' );
			$bnrimg_url  = $bnrimg_data[0];
			$bnrlink     = get_sub_field( 'bnr_link' );
			$link_url    = '';
			$link_title  = '';
			$link_target = '';
			if ( $bnrlink ) {
				$link_url    = $bnrlink['url'];
				$link_title  = $bnrlink['title'];
				$link_target = $bnrlink['target'] ? $bnrlink['target'] : '_self';
			}
			if ( $bnrlink ) :
				?>
<li>
<a class="" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo '<img src="' . esc_url( $bnrimg_url ) . '" alt="' . esc_attr( $link_title ) . '" />'; ?>
</a>
</li>
		<?php endif; ?>
	<?php endwhile; ?>
</ul>
</div>
</section>
	<?php endif; ?>
<?php endif; ?>
