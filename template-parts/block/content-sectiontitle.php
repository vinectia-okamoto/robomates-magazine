<?php
/**
 * Block Name: sectiontitle
 *
 * @package robomates-magazine
 */

?>

<?php
$classes = '';
if ( ! empty( $block['className'] ) ) {
	$classes .= sprintf( ' %s', $block['className'] );
}
if ( ! empty( $block['align'] ) ) {
	$classes .= sprintf( ' align%s', $block['align'] );
}
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = ' id="' . sanitize_title( $block['anchor'] ) . '"';
}
?>
<?php
$sectiontitle = get_field( 'sectiontitle' );
if ( $sectiontitle ) :
	$sectiontitle_ja = $sectiontitle['sectiontitle-ja'];
	$sectiontitle_en = $sectiontitle['sectiontitle-en'];
	?>
<h2 <?php echo esc_attr( $anchor ); ?> class="sectionTitle <?php echo esc_attr( $classes ); ?>">
	<?php if ( $sectiontitle_en ) { ?>
		<?php if ( preg_match( '/^[a-zA-Z0-9]+$/', $sectiontitle_en ) ) { ?>
			<span class="en"><?php echo esc_html( $sectiontitle_en ); ?></span>
	<?php } else { ?>
		<span class="en">エラー：半角数字以外があります</span>
	<?php } ?>
	<span class="en"><?php echo esc_html( $sectiontitle_en ); ?></span>
	<?php } else { ?>
<span class="en">英文入力してください</span>
<?php } ?>
	<?php if ( $sectiontitle_ja ) { ?>
<span class="ja"><?php echo esc_html( $sectiontitle_ja ); ?></span>
<?php } else { ?>
<span class="en">日文入力してください</span>
<?php } ?>
</h2>
<?php else : ?>

<?php endif; ?>
