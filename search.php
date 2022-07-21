<?php
/*** ページテンプレート ***/
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;}
?>
<?php get_header(); ?>

<!-- ▼▼#pageHero▼ -->


<header id="pageHero">
	<div class="pageHero-inner container">
		<div class="pageHero-titleWrap">
			<?php if ( have_posts() ) : ?>
				<?php if ( ! $_GET['s'] ) { ?>
			<h1 class="pageHero-title"><span>検索キーワードが未入力です</span></h1>
			<?php } else { ?>
			<h1 class="pageHero-title">
				<span>
					「<?php echo esc_html( $_GET['s'] ); ?>」の検索結果：<?php echo $wp_query->found_posts; ?>件
				</span>
			</h1>
			<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</header>
<!-- ▲▲#pageHero▲▲ -->

<?php get_template_part( 'template-parts/parts-breadcrumbs' ); ?>

<div class="container">
	<!-- ▼▼.contentrow▼▼ -->
	<div class="contentRow">
		<!-- ▼▼.contentMain▼▼ -->
		<div class="contentMain">
			<main class="site-main" id="main">
				<?php if ( have_posts() ) : ?>
				<ul class="newsListCard mb30">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<?php get_template_part( 'loop-templates/content', 'search' ); ?>
					<?php endwhile; // end of the loop. ?>
				</ul>
				<?php endif; ?>
			</main>
			<!-- #main -->
		</div>
		<!-- ▲▲.content-main▲▲ -->
		<?php get_sidebar(); ?>
		<!-- ▲▲.content-row▲▲ -->
	</div>
	<!-- /.conainer-large -->


	<?php get_footer(); ?>
