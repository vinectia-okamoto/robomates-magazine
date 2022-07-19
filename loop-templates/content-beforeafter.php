<?php
/**
 * コンテンツパーツ：Single
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">
		<div class="editor-styles-wrapper">aaaa
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
