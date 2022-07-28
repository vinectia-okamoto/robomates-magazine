<?php
/**
 * カスタムウォーカー Function
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php

if ( ! class_exists( 'Custom_Walker' ) ) {
	/**
	 * Custom_Walker
	 *
	 * @since 1
	 * @var string
	 *
	 * @see Walker::$tree_type
	 */
	class Custom_Walker extends Walker_Nav_Menu {
		/**
		 * 階層の開始.

		 * @see Walker::start_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
// phpcs:ignore -- curItemは変えてはいけないのでエラーを拒否
			$cur_item       = $this->curItem;
			$cur_item_title = $cur_item->title;
			$cur_item_url   = $cur_item->url;
			$parent_check   = $cur_item->menu_item_parent;
			$indent         = str_repeat( "\t", $depth );

			if ( ! $parent_check ) {
				$output .= '<div class="globalNavi-child">' . "\n";
				$output .= '<p class="globalNavi-child-index">' . "\n";
				$output .= '<a href="' . $cur_item_url . '">' . $cur_item_title . '</a>' . "\n";
				$output .= '</p>' . "\n";
				$output .= '<ul class="sub-menu">' . "\n";

			} else {
				$output .= '<ul class="sub-menu">' . "\n";
			}

		}

		/**
		 * 階層の終わり.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {

			$parent_check = $args->walker->curItem->current;

			if ( ! $parent_check ) {
				$output .= '</ul>' . "\n";
				$output .= '</div>' . "\n";
			} else {
				$output .= "</ul>\n";

			}
		}

		/**
		 *
		 * アイテムの開始.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::start_el()
		 * @param string   $output            Used to append additional content (passed by reference).
		 * @param string   $item      アイテム.
		 * @param int      $depth             Depth of menu item. Used for padding.
		 * @param stdClass $args              An object of wp_nav_menu() arguments.
		 * @param string   $id      ID.
		 */
		public function start_el( &$output, $item, $depth = array(), $args = array(), $id = 0 ) {

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = '' . $item->ID;

			$args = apply_filters( 'custom_nav_menu_item_args', $args, $item, $depth );

			$class_names = join( ' ', apply_filters( 'custom_nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'custom_nav_menu_item_id', '' . $item->ID, $item, $args, $depth );

			$thisid          = $item->object_id;
			$thisname        = $item->post_title;
			$thisdata        = get_post( $thisid );
			$mostparentcheck = $item->menu_item_parent;

			// var_dump( $mostparentcheck );
			if ( in_array( 'menu-item-has-children', $item->classes, true ) && 0 === $depth && '0' === $mostparentcheck ) {
				$drop_class = ' class="menu-item-has-children"';
			} else {
				$drop_class = '';
			}

			$output .= '<li' . $drop_class . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';

			$atts = apply_filters( 'custom_nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';

			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$urlget = apply_filters( 'custom_the_title', $item->url, $item->ID );
			$title  = apply_filters( 'custom_the_title', $item->title, $item->ID );
			$title  = apply_filters( 'custom_nav_menu_item_title', $title, $item, $args, $depth );

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . $title . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			// phpcs:ignore -- 情報をいれて上のレベルに渡す. phpcs
			$this->curItem = $item;

			$output .= apply_filters( 'custom_walker_nav_menu_start_el', $item_output, $item, $depth, $args );

			apply_filters( 'walker_nav_menu_end_lvl', $item_output, $item, $depth, $args );

		}

		/**
		 * アイテムの終わり
		 *
		 * @see Walker::end_el()
		 *
		 * @param string   $output      Used to append additional content (passed by reference).
		 * @param string   $item      アイテム.
		 * @param int      $depth       Depth of page. Not Used.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		public function end_el( &$output, $item, $depth = array(), $args = array() ) {
			$output .= "</li>\n";
		}

	}
}
