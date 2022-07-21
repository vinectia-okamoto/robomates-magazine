<?php
/**
 * Footer
 *
 * @package robomates-magazine
 */

?>
<?php
if ( is_front_page() && is_home() ) {
	echo '</div>';
} else {
	echo '</main>';
}
?>
<footer id="footer" class="footer">
			<div class="footer-inner container-xxl">
				<div class="footer-row">
					<div class="footer-leftArea">
						<h4 class="footer-logo"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/common/site-logo-w.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></h4>
						<div class="footer-address">
							<p clas="companyname"><span>運営企業：</span><span>株式会社エアグラウンド</span></p>
							<p class="address"><span>〒661-0033</span> <span>兵庫県尼崎市南武庫之荘2丁目 2-7</span> <span>新井ビル2F</span></p>
						</div>

						<p class="footer-tel"><span class="tel">TEL:06-6435-9992</span><span>FAX:06-6435-9982</span></p>
						<p class="footer-tel-hosoku">電話受付：8:30〜17:30／土日・祝日・年末年始除く</p>
					</div>
					<div class="footer-rightArea">
						<div class="footer-btnArea">
							<p class="txt"><span>ロボメイツに関する</span><span>お問い合わせは、</span><span>メールフォームから</span><span>お願い致します。</span></p>
							<p class="btn"><a href="<?php echo esc_url( get_page_link( 109 ) ); ?>"><i class="fa-solid fa-envelope"></i> お問い合わせフォームへ</a></p>
						</div>
						<?php if ( has_nav_menu( 'footerNavi' ) ) : ?>
							<nav class="footerNavi">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footerNavi',
									'container'      => false,
									'items_wrap'     => '<ul class="footerNavi-links">%3$s</ul>',
								)
							);
							?>
							</nav>
						<?php endif; ?>
					</div>
				</div>

				<div class="footer-copyArea">
					<p class="footer-copy"><small>Copyright © AIR GROUND all rights reserved.</small></p>
				</div>
			</div>

		</footer>



		<div id="pagetop" class="pagetop backtotop"><i aria-hidden="true"></i></div>
	</div>
	<?php wp_footer(); ?>
</body>

</html>
