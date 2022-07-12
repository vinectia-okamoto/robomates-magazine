<?php
/**
 * Block Name: q_and_a
 *
 * よくある質問
 */

?>


<?php 
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
    $classes .= sprintf( ' align%s', $block['align'] );
}
$groupname = "QA-section" ;?>

<?php if( have_rows($groupname) ): ?>
<!--▼section-box▼-->
<section class="section-box sec-QA <?php echo esc_attr($classes); ?>">
	<?php  while ( have_rows($groupname) ) : the_row();?>
	<?php if(get_sub_field("QA-section_title")): ?>
	<h3><?php the_sub_field('QA-section_title');?></h3>
	<?php endif;?>

	<?php $repeatqa = "repeat-QA" ;?>

	<?php  if( have_rows($repeatqa) ): ?>


	<div class="qaBox">

		<?php  while ( have_rows($repeatqa) ) : the_row();?>
		<dl class="qalist">
			<dt>
				<div class="q-wrap">
					<div class="q-icon">Q</div>
					<div class="q-title">
						<p><?php the_sub_field('QA-question');?></p>
					</div>
					<p class="qa-toggle"><span></span><span></span></p>
				</div>
			</dt>
			<dd>
				<div class="a-wrap">
					<div class="a-icon">A</div>
					<div class="a-title">
						<p><?php the_sub_field('QA-answer');?></p>
						<?php
$urls = get_sub_field('QA-link');
if( $urls ): $count = 0;?>
						<div class="question-link">
							<p>関連リンク：
								<?php foreach( (array)$urls as $url): ?>
								<?php if($count > 0){echo ", ";}?>
								<span class="mb5"><a href="<?php echo esc_url( $url ); ?>">
										<?php echo get_the_title(url_to_postid($url)); ?>
									</a></span>
								<?php $count = $count + 1; ?>
								<?php endforeach; ?>
							</p>
						</div>
						<?php wp_reset_postdata();?>
						<?php endif;?>
					</div>
				</div>
			</dd>
		</dl>

		<?php endwhile;?>

	</div>


	<!--▲section-box▲-->
	<?php endif;?>

	<?php endwhile;?>
</section>
<?php endif;?>