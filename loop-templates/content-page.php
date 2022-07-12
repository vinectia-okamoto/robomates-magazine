<?php
/**
 * コンテンツパーツ：Page
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="entry-content">
<div class="editor-styles-wrapper">
<?php the_content(); ?>
</div><!-- /.editor-styles-wrapper -->
<?php
	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . __( 'Pages:' ),
			'after'  => '</div>',
		)
	);
	?>
</div><!-- .entry-content -->
