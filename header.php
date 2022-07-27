<?php
/**
 * ヘッダーテンプレート
 *
 * @package    WordPress
 * @subpackage Robomates_Magezine
 * @since      2022
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<?php
	if ( function_exists( 'get_field' ) && get_field( 'custom_head_tag', 'option' ) ) {
		echo '<!-- CVTag Area -->';
		the_field( 'custom_head_tag', 'option' );
	}
	?>


</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link screen-reader-text" href="#contents">コンテンツへスキップ</a>
	<?php
	/**
	 * @ if ( is_front_page() && is_home() ) :
	 * get_template_part( 'template-parts/parts-splashLogo' );
	 */
	?>
	<!-- ******************** wrapper ******************** -->
	<div id="wrapper" class="inview--start">
		<!-- ******************** header ******************** -->
		<header id="header" class="header">
			<div class="header-inner">
				<div class="header-logoArea">
					<div class="header-logo">
						<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/common/site-logo.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></h1>
						<?php else : ?>
						<p class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/common/site-logo.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></p>
						<?php endif; ?>
						<p class="logo-copy"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/common/site-logo-copy.svg' ); ?>" alt="ロボットについての学びをサポートするオウンドメディア"></p>
					</div>
				</div>
				<div class="header-rightArea">
					<div class="header-rightArea-top">
						<div class="header-btnArea">
							<div class="header-loginBtn"><a href="">ロボメイツSTUDY ログイン</a></div>
						</div>
						<div class="header-search">
							<i class="fa-solid fa-magnifying-glass"></i>
						</div>
					</div>
					<div class="header-rightArea-bottom">
						<?php if ( has_nav_menu( 'globalNavi' ) ) : ?>
						<!-- ******************** globalNavi ******************** -->
						<nav class="globalNavi">
							<ul class="globalNavi-links">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'globalNavi',
										'items_wrap'     => '%3$s',
										'container'      => false,
										'depth'          => 2,
										'items_wrap'     => '%3$s',
									)
								);
								?>
							</ul>
						</nav>
						<?php endif; ?>
					</div>
					<div class="sp_btn"><span class="sp_btn-arrow"><span></span><span></span><span></span></span></div>
				</div>
		</header>

		<!-- ******************** spNavi ******************** -->
		<nav id="spNavi" class="spNavi">
			<div class="sp_btn"><span class="sp_btn-arrow"><span></span><span></span><span></span></span></div>
			<div class="spNavi-inner">
				<?php
				if ( has_nav_menu( 'spNavi' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'spNavi',
							'container'      => false,
							'items_wrap'     => '<ul class="spNavi-links">%3$s</ul>',
						)
					);
				endif;
				?>
			</div>
		</nav>
		<!-- ******************** searchWrap ******************** -->
		<?php get_template_part( 'template-parts/parts-search-wrap' ); ?>

		<!-- ******************** contents ******************** -->
		<?php
		if ( is_front_page() && is_home() ) {
			echo '<div id="contents" class="contents">';
		} else {
			echo '<main id="contents" class="contents">';
		}
		?>
