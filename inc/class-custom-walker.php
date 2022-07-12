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
	/**
	 * ファイル名の警告対策
	 */
class Custom_Walker extends Walker_Nav_Menu {

}
?>


<?php
if ( ! class_exists( 'PC_Custom_Walker' ) ) {
	/**
	 * PC_Custom_Walker
	 */
	class PC_Custom_Walker extends Walker_Nav_Menu {

		/**
		 * Unique id for dropdowns
		 *
		 * @var ?
		 */
		public $submenu_unique_id = '';

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			$curItem      = $this->curItem;
			$curItemTitle = $curItem->title;
			$curItemUrl   = $curItem->url;
			$parentCheck  = $curItem->menu_item_parent;

			$before_start_lvl  = '<div class="megaMenu">' . "\n";
			$before_start_lvl .= $indent . '<div class="container-large">' . "\n";
			$before_start_lvl .= $indent . '<div class="row">' . "\n";
			$before_start_lvl .= $indent . '<div class="col-3 align-self-center">' . "\n";
			$before_start_lvl .= $indent . '<h3 class="megaMenu-title">' . $curItemTitle . '</h3>' . "\n";
			$before_start_lvl .= $indent . '<p><a class="megaMenu-mainLinkBtn" href="' . $curItemUrl . '">View More</a></p>' . "\n";
			$before_start_lvl .= $indent . '</div><!--/.col-->' . "\n";
			$before_start_lvl .= $indent . '<div class="col-9">' . "\n";

			if ( $depth == 0 ) {
				$output .= "{$n}{$indent}{$before_start_lvl}<ul id=\"$this->submenu_unique_id\" class=\" menu-child\">{$n}";
			} else {
				$output .= "{$n}{$indent}<ul id=\"$this->submenu_unique_id\" class=\"menu-grandChild\">{$n}";
			}

		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent         = str_repeat( $t, $depth );
			$after_end_lvl  = '</div><!--/.col-9-->' . "\n";
			$after_end_lvl .= '</div><!--/.row-->' . "\n";
			$after_end_lvl .= '</div><!--/.container-->' . "\n";
			$after_end_lvl .= '</div>' . "\n";

			if ( $depth == 0 ) {
				$output .= "$indent</ul>{$after_end_lvl}{$n}";
			} else {
				$output .= "$indent</ul>{$n}";
			}

		}

		/**
		 * @see Walker::start_el()
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			// set active class for current nav menu item
			if ( $item->current == 1 ) {
				$classes[] = 'active';
			}

			// set active class for current nav menu item parent
			if ( in_array( 'current-menu-parent', $classes ) ) {
				$classes[] = 'active';
			}

			/**
			 * 単一のナビゲーションメニュー項目の引数をフィルタリングします。
			 */
			$args            = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
			$class_names     = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$mostparentcheck = $item->menu_item_parent;
			$dropdownClass   = 'dropdown';
			if ( in_array( 'menu-item-has-children', $item->classes ) && $depth == 0 && $mostparentcheck == 0 ) {
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . ' ' . $dropdownClass . '"' : ' class="' . $dropdownClass . '"';
			} else {
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			}

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['class']  = '';

				$atts['href']  = ! empty( $item->url ) ? $item->url : '';
				$atts['class'] = '';

			$atts['class'] .= 'menu-link ';

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {

					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';

			$item_output .= $args->link_before . $title . $args->link_after;

			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

			$this->curItem = $item;// 情報をいれて上のレベルに渡す
		}

		/**
		 * Ends the element output, if needed.
		 */
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$output .= "</li>{$n}";
		}


	}
}
