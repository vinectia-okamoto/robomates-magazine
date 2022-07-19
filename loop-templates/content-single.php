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
<!-- .entry-header -->
<header class="entry-header">
<!-- .entry-title -->
<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
<!-- .entry-meta -->
<div class="entry-meta"><?php vinectia_entrymeta(); ?></div>
</header>
<!-- .entry-content -->
<div class="entry-content">
<div class="editor-styles-wrapper">
<?php the_content(); ?>
<?php
wp_link_pages(
	array(
		'before' => '<div class="page-links">' . __( 'Pages:' ),
		'after'  => '</div>',
	)
);
?>
</div>
</div>
</article>
