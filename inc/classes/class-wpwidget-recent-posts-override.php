<?php
/**
 * クラス：最近の投稿ウィジェットで記事タイトル→投稿日付となっているところを投稿日→記事タイトルにする Function
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
if ( ! class_exists( 'WP_Widget_Recent_Posts_Override' ) ) {



	class WP_Widget_Recent_Posts_Override extends WP_Widget_Recent_Posts {
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;}
			$title  = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
			$title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
			if ( ! $number ) {
				$number = 5;
			}
			$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
			$r         = new WP_Query(
				apply_filters(
					'widget_posts_args',
					array(
						'posts_per_page'      => $number,
						'no_found_rows'       => true,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
					)
				)
			);
			if ( $r->have_posts() ) :
				?>
				<?php echo $args['before_widget']; ?>
				<?php
				if ( $title ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}
				?>
<ul>
				<?php
				while ( $r->have_posts() ) :
					$r->the_post();
					?>
 <li>
					<?php if ( $show_date ) :  // aタグとspan.post-dateタグを下記のように入れ替える ?>
  <span class="post-date"><?php echo get_the_date(); ?></span>
  <?php endif; ?>
  <a href="<?php the_permalink(); ?>">
					<?php get_the_title() ? the_title() : the_ID(); ?>
  </a> </li>
	 <?php endwhile; ?>
</ul>
				<?php echo $args['after_widget']; ?>
				<?php
				wp_reset_postdata();
				endif;
		}

	}
				// 「最近の投稿」ウィジェットのオーバーライド
	function theme_wp_widget_override() {
		register_widget( 'WP_Widget_Recent_Posts_Override' );}
				add_action( 'widgets_init', 'theme_wp_widget_override' );

}
