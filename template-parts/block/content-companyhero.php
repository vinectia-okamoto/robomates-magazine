<?php
/**
 * Block Name: companyhero
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

<header <?php echo esc_attr( $anchor ); ?> class="roboCom-hero <?php echo esc_attr( $classes ); ?>">
<div class="txtArea">
<?php
		$thiscats = get_the_terms( $post->ID, 'robo-companies-category' );
if ( $thiscats ) {
	echo '<div class="roboCom-hero-cat">';
	foreach ( $thiscats as $thiscat ) {
		$thiscat_id   = $thiscat->term_id;
		$thiscat_url  = get_term_link( $thiscat_id );
		$thiscat_name = $thiscat->name;
		echo '<a href="' . esc_url( $thiscat__url ) . '">' . esc_html( $thiscat_name ) . '</a>';
	}
	echo '</div>';
}
?>
<h1 class="roboCom-hero-title"><?php the_title(); ?></h1>
<?php
if ( get_field( 'robocom-hero-read' ) ) {
	echo '<h2 class="roboCom-hero-read">' . esc_html( get_field( 'robocom-hero-read' ) ) . '</h2>';
}
?>
<?php
if ( get_field( 'robocom-hero-intro' ) ) {
	echo '<p class="roboCom-hero-intro">' . esc_html( get_field( 'robocom-hero-intro' ) ) . '</p>';
}
?>
</div>
<?php
$imgarea_template = array(
	array(
		'core/image',
		array(
			'sizeSlug'        => 'large',
			'linkDestination' => 'none',
			'alt'             => get_the_title(),
			'url'             => esc_url( get_template_directory_uri() . '/assets/images/common/noimage.png' ),
			'className'       => 'roboCom-hero-img',
		),
	),
);
$imgarea_template = wp_json_encode( $imgarea_template );
?>
<div class="imgArea">
<?php echo ' <InnerBlocks template="' . esc_attr( $imgarea_template ) . '" /> '; ?>
</div>
</header>
