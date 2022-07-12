<?php
/**
 * OGP Function
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
/******************************************************************************************
 * OGPとファビコン設定
 ******************************************************************************************/
function my_meta_ogp() {
	;
	?>


<!-- for android/Chrome -->
<meta name="theme-color" content="<?php echo esc_attr( vinectia_get_color_for_area( 'content', 'primary' ) ); ?>">
<!-- for apple -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/apple-icon-180x180.png' ); ?>">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
<!-- for safari -->
<link rel="mask-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/safari-pinned-tab.svg' ); ?>"  color="<?php echo esc_attr( vinectia_get_color_for_area( 'content', 'primary' ) ); ?>">
<!-- favicon -->
<link rel="shortcut icon"  href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/favicon.ico' ); ?>" type="image/vnd.microsoft.icon">
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/favicon.ico' ); ?>" type="image/vnd.microsoft.icon">
<!-- 基本meta設定 -->
	<?php if ( is_singular() ) :// 記事＆固定ページ. ?>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<?php $postid = get_the_ID(); ?>
				<?php $meta_description = get_post_custom_values( 'meta_description', $postid ); ?>
				<?php if ( $meta_description ) : ?>
					<?php if ( $meta_description[0] ) : // カスタムディスクリプションあるなら. ?>
<meta name="description" content="<?php echo esc_attr( trim( $meta_description[0] ) ); ?>" >
	<?php endif; ?>
		<?php else : // カスタムディスクリプションないなら. ?>

<meta name="description" content="<?php echo esc_attr( mb_substr( str_replace( array( "\r\n", "\r", "\n", ' ', '　', '・・・', '続きを読む', 'more' ), '', wp_strip_all_tags( get_the_excerpt() ) ), 0, 120 ) );// 抜粋を表示. ?>">
		<?php endif; ?>

				<?php
	endwhile;
endif;
		?>
	<?php else : // 単一記事ページページ以外の場合（アーカイブページやホームなど）. ?>
<meta name="description" content="<?php bloginfo( 'description' ); // 「一般設定」管理画面で指定したブログの説明文を表示. ?>">
	<?php endif; ?>
<!-- facebookogp -->
	<?php

	$home_url      = home_url(); // ホームのURLを取得する.
	$pagepermalink = get_permalink(); // 記事のURLを取得.

	?>

	<?php // <meta property="fb:app_id" content="ここにappIDを入力">;. ?>
<meta property="og:locale" content="ja_JP" />
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
	<?php if ( is_singular() ) :// 記事＆固定ページ. ?>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<?php $postid = get_the_ID(); ?>
<meta property="og:title" content="<?php echo wp_title( '|', false, 'right' ) . esc_attr( get_bloginfo( 'name' ) );// 単一記事タイトルを表示. ?>">
				<?php $meta_description = get_post_custom_values( 'meta_description', $postid ); ?>
				<?php if ( $meta_description ) : ?>
					<?php if ( $meta_description[0] ) : // カスタムディスクリプションあるなら. ?>
<meta name="og:description" content="<?php echo esc_attr( trim( $meta_description[0] ) ); ?>" >
<?php endif; ?>
<?php else : // カスタムディスクリプションないなら. ?>
<meta name="og:description" content="<?php echo esc_attr( mb_substr( str_replace( array( "\r\n", "\r", "\n", ' ', '　', '・・・', '続きを読む', 'more' ), '', wp_strip_all_tags( get_the_excerpt() ) ), 0, 120 ) );// 抜粋を表示. ?>">
<?php endif; ?>
				<?php
endwhile;
endif;
		?>
<meta property="og:url" content="<?php echo esc_url( $pagepermalink ); ?>">
<?php else : // 単一記事ページページ以外の場合（アーカイブページやホームなど）. ?>
<meta property="og:title" content="<?php echo wp_title( '|', false, 'right' ) . esc_attr( get_bloginfo( 'name' ) ); // 「一般設定」管理画面で指定したブログのタイトルを表示. ?>">
<meta property="og:description" content="<?php bloginfo( 'description' ); // 「一般設定」管理画面で指定したブログの説明文を表示. ?>">
<meta property="og:url" content="<?php echo esc_url( $home_url ); ?>">
<?php endif; ?>
	<?php
	if ( empty( $post->post_content ) ) {
		$str = ''; } else {
		$str = $post->post_content;
		/* 本文がある場合の処理 */ };
		$search_pattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';// 投稿にイメージがあるか調べる.
		?>
	<?php
	if ( is_single() ) {// 単一記事ページの場合.
		if ( has_post_thumbnail() ) {// 投稿にサムネイルがある場合の処理.
			$image_id = get_post_thumbnail_id();
			$image    = wp_get_attachment_image_src( $image_id, 'full' );
			echo '<meta property="og:image" content="' . esc_attr( $image[0] ) . '">';
			echo "\n";
		} elseif ( preg_match( $search_pattern, $str, $imgurl ) && ! is_archive() ) {// 投稿にサムネイルは無いが画像がある場合の処理.
			echo '<meta property="og:image" content="' . esc_attr( $imgurl[2] ) . '">';
			echo "\n";
		} else { // 投稿にサムネイルも画像も無い場合は通常OGP画像.
			$ogp_image = get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/facebookogp-1200x630.png';
			echo '<meta property="og:image" content="' . esc_attr( $ogp_image ) . '">';
			echo "\n";
		}
	} else { // 単一記事ページページ以外の場合（アーカイブページやホームなど）.
		if ( get_header_image() ) {// ヘッダーイメージがある場合は、ヘッダーイメージを.
			echo '<meta property="og:image" content="' . esc_attr( get_header_image() ) . '">';
			echo "\n";
		} else { // ヘッダーイメージがない場合は、通常OGP画像.
			$ogp_image = get_template_directory_uri() . '/assets/images/favicon_icon_ogp_schima/facebookogp-1200x630.png';
			echo '<meta property="og:image" content="' . esc_attr( $ogp_image ) . '">';
			echo "\n";
		}
	}
	?>

	<?php
}
add_action( 'wp_head', 'my_meta_ogp' );// headにOGPを出力.

/**
 * カスタムディスクリプションのオリジナルメタボックス作成
 */
function add_description() {
	if ( ! function_exists( 'get_custum_post_types' ) ) :
		/**
		 * カスタム投稿データ取得
		 */
		function get_custum_post_types() {
			$args       = array(
				'public'   => true,
				'_builtin' => false,
			);
			$post_types = get_post_types( $args );
			return $post_types;
		}
endif;
	$get_custum_post_types = get_custum_post_types();

	// 固定ページ（page）にメタボックスを追加.
	add_meta_box( 'meta_info', 'ディスクリプション', 'meta_info_form', 'page', 'side', 'high' );
	// カスタム投稿ある場合.
	if ( $get_custum_post_types ) {
		add_meta_box( 'meta_info', 'ディスクリプション', 'meta_info_form', $get_custum_post_types, 'side', 'high' );
	}

}
add_action( 'add_meta_boxes', 'add_description' );

/**
 * メタボックス（カスタムフィールド）に表示する内容.
 */
function meta_info_form() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
	?>
<div id="meta_info">
<p><label>説明：このページの説明を入力してください。（60～120文字前後）<br />
入力がない場合ページに記事がある場合は自動で入りますが、細かく設定したい場合はこちらに入力してください。<br />※ただし、こちらを採用するかどうかはgoogle次第です。
</label><br />
<textarea name="meta_description" value="<?php echo esc_html( get_post_meta( $post->ID, 'meta_description', true ) ); ?>"  style="width:100%" /><?php echo esc_html( get_post_meta( $post->ID, 'meta_description', true ) ); ?></textarea>
</p>
</div>
	<?php
}

/**
 * カスタムフィールド（メタボックス）に入力された内容の更新などの処理.
 *
 * @param string $post_id  ポストID.
 */
function description_save( $post_id ) {
	global $post;
	if ( empty( $_POST['my_nonce'] ) ) {
		$my_nonce = null;
	} else {
		$my_nonce = wp_unslash( isset( $_POST['my_nonce'] ) );
	}

	if ( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id; }
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post_id; }
	// カスタム投稿もある場合.
	/**@ if($_POST['post_type'] == 'works'){ update_post_meta($post->ID, 'meta_description', $_POST['meta_description']);}*/
	$posttypecheck = isset( $_POST['post_type'] );
	if ( 'page' === $posttypecheck ) {
		$discriptioncheck = isset( $_POST['post_type'] );
		if ( $discriptioncheck ) {
			update_post_meta( $post->ID, 'meta_description', $discriptioncheck );
		}
	}
}
add_action( 'save_post', 'description_save' );
