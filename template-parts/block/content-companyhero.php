<?php

/**
 * Block Name: companyhero
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
} else {
	$classes .= 'alignwide';
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

<header <?php echo esc_attr($anchor); ?> class="roboCom-hero <?php echo esc_attr($classes); ?>" style="<?php echo esc_attr($inlineStyles); ?>">
	<div class="txtArea">
		<?php
		$thiscats = get_the_terms($post->ID, 'companies_category');
		if ($thiscats) {
			echo '<div class="roboCom-hero-cat">';
			foreach ($thiscats as $thiscat) {
				$thiscat_id   = $thiscat->term_id;
				$thiscat_url  = get_term_link($thiscat_id);
				$thiscat_name = $thiscat->name;
				echo '<a href="' . esc_url($thiscat_url) . '">' . esc_html($thiscat_name) . '</a>';
			}
			echo '</div>';
		}
		?>
		<h1 class="roboCom-hero-title"><?php the_title(); ?></h1>
		<?php
		if (get_field('robocom-hero-read')) {
			echo '<h2 class="roboCom-hero-read noteditor">' . esc_html(get_field('robocom-hero-read')) . '</h2>';
		}
		?>
		<?php
		if (get_field('robocom-hero-intro')) {
			echo '<p class="roboCom-hero-intro">' . esc_html(get_field('robocom-hero-intro')) . '</p>';
		}
		?>
	</div>

	<div class="imgArea">

		<?php
		$hero_image = get_field('robocom-hero-img');
		if (!empty($hero_image)) :
			$hero_image_size = 'large';
			$hero_image_id = $hero_image['ID'];
			$image_url = wp_get_attachment_image_src($hero_image_id, $size);
			$image_url = $image_url[0];
		?>

		<?php else : ?>
			<?php $image_url = get_template_directory_uri() . '/assets/images/common/noimage.png'; ?>
		<?php endif; ?>
		<div class="imgBox">
			<img class="" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
		</div>
	</div>
</header>
