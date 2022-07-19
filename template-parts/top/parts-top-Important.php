<?php
/**
 * Parts Top Important
 *
 * @package robomates-magazine
 */

?>
<?php if ( function_exists( 'get_field' ) ) : ?>
	<?php $groupname = 'repeat_important'; ?>
	<?php if ( have_rows( $groupname, 'option' ) ) : ?>
		<?php
		$link_data              = '';
		$preview_check_flag     = '';
		$preview_check          = get_field( $groupname, 'option' );
		$preview_check_data_all = array_column( $preview_check, 'important_check' );
		?>
		<?php if ( in_array( true, $preview_check_data_all, true ) ) : ?>
<!-- ▼▼#topImportant▼ -->
<section id="topImportant" class="topImportant">
	<div class="container">
		<ul class="topImportantList">

			<?php
			while ( have_rows( $groupname, 'option' ) ) :
				the_row();
				?>
				<?php if ( get_sub_field( 'important_check', 'option' ) === 'visible' ) : ?>
					<?php if ( get_sub_field( 'important_title', 'option' ) ) : ?>
			<li>
				<div class="topImportantCard inview_fadeIn">
					<div class="topImportantCard-txtArea">
						<p class="topImportantCard-txtArea__icon"><i class="fas fa-exclamation-circle"></i></p>
						<?php
						$link_data = get_sub_field( 'important_url', 'option' );
						if ( $link_data ) :
							?>
							<?php
							$link_url    = $link_data['url'];
							$link_title  = $link_data['title'];
							$link_target = $link_data['target'] ? $link_data['target'] : '_self';
							?>
						<p class="topImportantCard-txtArea__txt"><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php the_sub_field( 'important_title', 'option' ); ?></a></p>
						<?php else : ?>
						<p class="topImportantCard-txtArea__txt"><span><?php the_sub_field( 'important_title', 'option' ); ?></span></p>
						<?php endif; ?>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php endif; ?>
			<?php endwhile; ?>
		</ul>
	</div>
</section>
<!-- ▲▲#topImportant▲▲ -->
	<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
