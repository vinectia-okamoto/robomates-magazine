<?php
/**
 * Block Name: companydata
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

<table <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $classes ); ?>">
<tbody>
<tr>
<th>会社名</th>
<td>
<?php the_title(); ?>
</td>
</tr>
<?php if ( get_field( 'company-address' ) ) : ?>
<tr>
<th>所在地</th>
<td>
	<?php echo esc_attr( get_field( 'company-address' ) ); ?>
</td>
</tr>
<?php endif; ?>
<?php if ( get_field( 'company-dials' ) ) : ?>
<tr>
<th>連絡先</th>
<td>
	<?php echo esc_attr( get_field( 'company-dials' ) ); ?>
</td>
</tr>
<?php endif; ?>
<?php if ( get_field( 'company-url' ) ) : ?>
<tr>
<th>URL</th>
<td>
	<?php the_field( 'company-url' ); ?>
</td>
</tr>
<?php endif; ?>
<?php if ( get_field( 'company-business' ) ) : ?>
<tr>
<th>事業内容</th>
<td>
	<?php echo esc_attr( get_field( 'company-business' ) ); ?>
</td>
</tr>
<?php endif; ?>
<?php
$company_internship = get_field( 'company-internship' );
if ( $company_internship ) {
	$internship_value = $company_internship['value'];
	$internship_label = $company_internship['label'];
	echo '<tr>';
	echo '<th>事業内容</th>';
	echo '<td>';
	echo '<span style="text-bold; margin-right:1em">' . esc_attr( $internship_label ) . '</span>';
	if ( get_field( 'company-internship-data' ) ) {
		the_field( 'company-internship-data' );// あり.
	}
	echo '</span>';
	echo '</tr>';
}
?>
<tbody>
<table>
