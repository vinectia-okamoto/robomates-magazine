<?php
/**
 * Parts Top Bnr
 *
 * @package robomates-magazine
 */

?>
<?php
if ( function_exists( 'get_field' ) ) :
	;
	?>
	<?php
	if ( have_rows( 'repeat_bnr', 'option' ) ) :
		$bnrdatas_all = get_field( 'repeat_bnr', 'option' );
		?>
<!-- ******************** topBnr ******************** -->
<section id="topBnr" class="topBnr">
<div class="topBnr-inner container-xl">
		<?php
		$bnrdatas = array_filter(
			$bnrdatas_all,
			function( $val ) {
				return '支援企業' === $val['bnr_cat'];
			}
		);
		?>
		<?php if ( $bnrdatas ) : ?>

<h3 class="topBnr-title">支援企業</h3>
<ul class="bnrList">

			<?php
			foreach ( $bnrdatas as $bnrdata ) :
				?>
				<?php
				$bnrimg = $bnrdata['bnr_img'];

				$bnrimg_id   = $bnrimg['ID'];
				$bnrimg_data = wp_get_attachment_image_src( $bnrimg_id, 'medium' );

				$bnrimg_url = $bnrimg_data[0];
				$bnrlink    = $bnrdata['bnr_link'];
				if ( $bnrlink && $bnrimg_url ) :
					$link_url    = $bnrlink['url'];
					$link_title  = $bnrlink['title'];
					$link_target = $bnrlink['target'] ? $bnrlink['target'] : '_self';
					?>
<li>
<a class="" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
					<?php echo '<img src="' . esc_url( $bnrimg_url ) . '" alt="' . esc_attr( $link_title ) . '"/> '; ?>
</a>
</li>
			<?php elseif ( $bnrimg_url ) : ?>
<li><span><?php echo ' <img src="' . esc_url( $bnrimg_url ) . '" alt="' . esc_attr( $link_title ) . '"/> '; ?></span>
</li>
	<?php endif; ?>
	<?php endforeach; ?>
</ul>
		<?php endif; ?>
		<?php
		$bnrdatas = array_filter(
			$bnrdatas_all,
			function( $val ) {
				return 'ロボメイツ協力団体' === $val['bnr_cat'];
			}
		);
		?>

		<?php if ( $bnrdatas ) : ?>
			<h3 class="topBnr-title">ロボメイツ協力団体</h3>
<ul class="bnrList">
			<?php
			foreach ( $bnrdatas as $bnrdata ) :
				$bnrimg      = $bnrdata['bnr_img'];
				$bnrimg_id   = $bnrimg['ID'];
				$bnrimg_data = wp_get_attachment_image_src( $bnrimg_id, 'medium' );

				$bnrimg_url = $bnrimg_data[0];
				$bnrlink    = $bnrdata['bnr_link'];
				if ( $bnrlink && $bnrimg_url ) :
					$link_url    = $bnrlink['url'];
					$link_title  = $bnrlink['title'];
					$link_target = $bnrlink['target'] ? $bnrlink['target'] : '_self';
					?>
<li>
<a class="" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo '<img src="' . esc_url( $bnrimg_url ) . '" alt="' . esc_attr( $link_title ) . '"/> '; ?></a>
</li>
	<?php elseif ( $bnrimg_url ) : ?>
<li><span><?php echo ' <img src="' . esc_url( $bnrimg_url ) . '" alt="' . esc_attr( $link_title ) . '"/> '; ?></span></li>
	<?php endif; ?>

	<?php endforeach; ?>
</ul>
	<?php endif; ?>
</div>
</section>
<?php endif; ?>
<?php endif; ?>
