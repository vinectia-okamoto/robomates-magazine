<?php

/**
 * Block Name: sectiontitle
 *
 * @package robomates-magazine
 */

?>

<?php
$classes = '';
if (!empty($block['className'])) {
	$classes .= sprintf(' %s', $block['className']);
}
if (!empty($block['align'])) {
	$classes .= sprintf(' align%s', $block['align']);
}
$anchor = '';
if (!empty($block['anchor'])) {
	$anchor = ' id="' . sanitize_title($block['anchor']) . '"';
}
$inlineStyles = '';
if (!empty($block['style']['spacing']['padding']['top'])) {
	$inlineStyles .= 'padding-top:' . $block['style']['spacing']['padding']['top'] . ';';
}
if (!empty($block['style']['spacing']['padding']['right'])) {
	$inlineStyles .= 'padding-right:' . $block['style']['spacing']['padding']['right'] . ';';
}
if (!empty($block['style']['spacing']['padding']['bottom'])) {
	$inlineStyles .= 'padding-bottom:' . $block['style']['spacing']['padding']['bottom'] . ';';
}
if (!empty($block['style']['spacing']['padding']['left'])) {
	$inlineStyles .= 'padding-left:' . $block['style']['spacing']['padding']['left'] . ';';
}
if (!empty($block['style']['spacing']['margin']['top'])) {
	$inlineStyles .= 'margin-top:' . $block['style']['spacing']['margin']['bottom'] . ';';
}
if (!empty($block['style']['spacing']['margin']['bottom'])) {
	$inlineStyles .= 'margin-bottom:' . $block['style']['spacing']['margin']['bottom'] . ';';
}
?>
<?php
$sectiontitle = get_field('sectiontitle');
if ($sectiontitle) :
	$sectiontitle_ja = $sectiontitle['sectiontitle-ja'];
	$sectiontitle_en = $sectiontitle['sectiontitle-en'];
?>
<h2 <?php echo esc_attr($anchor); ?> class="sectionTitle noteditor <?php echo esc_attr($classes); ?>" style="<?php echo esc_attr($inlineStyles); ?>">
	<?php if ($sectiontitle_en) { ?>
	<span class="en"><?php echo esc_html($sectiontitle_en); ?></span>
	<?php } else { ?>
	<span class="en">英文入力してください</span>
	<?php } ?>
	<?php if ($sectiontitle_ja) { ?>
	<span class="ja"><?php echo esc_html($sectiontitle_ja); ?></span>
	<?php } else { ?>
	<span class="en">日文入力してください</span>
	<?php } ?>
</h2>
<?php else : ?>

<?php endif; ?>