<?php
/**
 * コンテンツパーツ：Search
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article <?php post_class( 'searchCard' ); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header">
	<?php
		the_title(
			sprintf( '<h2 class="entry-title noteditor"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>
	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php vinectia_posted_on(); ?>
		</div><!-- .entry-meta -->
<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

				<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
