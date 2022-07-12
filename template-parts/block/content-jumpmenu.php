<?php
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
    $classes .= sprintf( ' align%s', $block['align'] );
}
$colClass = '';
if( get_field('jumpmenu-columnSelect')) {
    $jumpmenuColumnSelect = get_field('jumpmenu-columnSelect');
    $colClass = $jumpmenuColumnSelect;
}
?>
<?php if( have_rows('jumpmenu') ):?>
<ul class="jumpmenu noteditor mt20 mb20 <?php echo $colClass;?> <?php echo esc_attr($classes); ?>">
	<?php while ( have_rows('jumpmenu') ) : the_row();?>
	<?php $anchor = get_sub_field('jumpmenu-anchor'); $title = get_sub_field('jumpmenu-title');?>
	<?php if( $anchor && $title ):?>
	<li><a href="<?php echo esc_attr('#'.$anchor);?>">
			<div data-mh="jumpmenu"><span><?php echo esc_html($title);?></span></div>
		</a></li>
	<?php endif;?>
	<?php endwhile;?>
</ul>
<?php endif;?>