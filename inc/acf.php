<?php
/**
 * ACF Function
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
add_action( 'acf/init', 'my_acf_init' );
if ( ! function_exists( 'my_acf_post_id' ) ) {
	/******************************************************************
	 * ブロックテンプレート内で動作するヘルパー。IDを取得したいからです。
	 ******************************************************************/
	function my_acf_post_id() {
		if ( is_admin() && function_exists( 'acf_maybe_get_POST' ) ) {
			if ( intval( acf_maybe_get_POST( 'post_id' ) !== null ) ) {
				return intval( acf_maybe_get_POST( 'post_id' ) );
			} else {
				global $post;
				return $post->ID;
			}
		} else {
			global $post;
			return $post->ID;
		}
	}
}

/************************************************
 * コンテンツからからACFのデータ引っこ抜き用function
 * 例） $metaData = get_acfblock_data($post, $block_name = 'acf/staffhero', $field_name = "staffData_staffData-metaData").
 *
 * @param string $post ポスト.
 * @param string $block_name ブロック名.
 * @param string $field_name フィールド名 .
 ***********************************************/
function get_acfblock_data( $post, $block_name, $field_name ) {
	$content = '';
	if ( has_blocks( $post->post_content ) && ! empty( $field_name ) ) {
		$blocks = parse_blocks( $post->post_content );
		foreach ( $blocks as $block ) {
			if ( $block['blockName'] === $block_name ) {
				if ( isset( $block['attrs']['data'][ $field_name ] ) ) {
					$content = $block['attrs']['data'][ $field_name ];
				}
			}
		}
	}
	return $content;
}


/******************************************************************
 * ACF関連　ブロックエディターのカテゴリを追加
 *
 * @param string $categories .
 ******************************************************************/
function add_block_categories( $categories ) {
	$add_categories = array(
		array(
			'slug'  => 'vinectia-original',
			'title' => 'オリジナル',
		),
	);
	$categories     = array_merge( $add_categories, $categories );
	return $categories;
}
add_filter( 'block_categories_all', 'add_block_categories' );


/******************************************************************
 * ブロックエディターのACFプラグイン設定
 ******************************************************************/
function my_acf_init() {
	if ( function_exists( 'acf_register_block' ) ) {
		global $post_type;
		acf_register_block(
			array(
				'name'            => 'companydata', // 英数字で記入.
				'title'           => '企業情報', // ブロック名.
				'description'     => 'ロボット関連企業の情報', // ブロックの説明.
				'render_callback' => 'acf_block_load', // （※注）
				'category'        => 'vinectia-original',
				'icon'            => 'admin-links',
				'mode'            => 'auto',
				'keywords'        => array( '企業', '企業紹介', '企業情報', 'ロボット関連企業紹介' ),
				'supports'        => array(
					'anchor'  => true,
					'align'   => true,
					'spacing' => array(
						'margin'  => array( 'top', 'bottom' ),
						'padding' => true,
					),
				),
			)
		);
		acf_register_block(
			array(
				'name'            => 'sectiontitle', // 英数字で記入.
				'title'           => 'セクションタイトル', // ブロック名.
				'description'     => 'セクションなどのタイトル', // ブロックの説明.
				'render_callback' => 'acf_block_load', // （※注）
				'category'        => 'vinectia-original',
				'icon'            => 'admin-links',
				'mode'            => 'auto',
				'keywords'        => array( 'セクション', 'タイトル', '見出し', 'ロボット関連企業紹介' ),
				'supports'        => array(
					'anchor'  => true,
					'align'   => true,
					'spacing' => array(
						'margin'  => array( 'top', 'bottom' ),
						'padding' => true,
					),
				),
			)
		);
		acf_register_block(
			array(
				'name'            => 'companyhero', // 英数字で記入.
				'title'           => 'ロボット関連企業ヒーロー画像', // ブロック名.
				'description'     => 'ロボット関連企業ヒーロー画像', // ブロックの説明.
				'render_callback' => 'acf_block_load', // （※注）
				'category'        => 'vinectia-original',
				'icon'            => 'admin-links',
				'mode'            => 'auto',
				'keywords'        => array( 'ヒーロー', '企業紹介', 'ロボット関連企業紹介' ),
				'supports'        => array(
					'anchor'  => true,
					'align'   => true,
					'spacing' => array(
						'margin'  => array( 'top', 'bottom' ),
						'padding' => true,
					),
				),
			)
		);
	}
}


/******************************************************************
 * （※注）で指定した文字列と表示用PHPファイルの関連付け
 *
 *  @param string $block 上で設定したブロック.
 ******************************************************************/
function acf_block_load( $block ) {
	$slug = str_replace( 'acf/', '', $block['name'] );
	if ( file_exists( get_theme_file_path( "/template-parts/block/content-{$slug}.php" ) ) ) {
		include get_theme_file_path( "/template-parts/block/content-{$slug}.php" );
	}
}



/**
 * ACFオプションページ.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => 'トップページ設定',
			'menu_title' => 'トップページ・その他設定',
			'menu_slug'  => 'theme-options',
			'capability' => 'edit_posts',
			'position'   => false,
			'redirect'   => false,
		)
	);
}

/************************************************************
 * ACF画像にsrcset属性（レスポンシブイメージ）をつける
 * $acf_img_id = get_field('acf_img')
 * <img <?php awesome_acf_responsive_image($acf_img_id,'medium','728px'); ?> class="xxx" >
 ************************************************************/
/************************************************
 * ACF画像にsrcset属性（レスポンシブイメージ）をつける
 * $acf_img_id = get_field('acf_img')
 * <img <?php awesome_acf_responsive_image($acf_img_id,'medium','728px'); ?> class="xxx">
 *
 * @param string $image_id id.
 * @param string $image_size 引数は（画像ID, サイズ{full,large,medium,thumbnail}, 表示最大幅）.
 * @param string $max_width ピクセルでサイズ指定.
 ***********************************************/
function awesome_acf_responsive_image( $image_id, $image_size, $max_width ) {
	if ( '' !== $image_id ) {
		/* set the default src image size */
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );
		/* set the srcset with various image sizes */
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		/* generate the markup for the responsive image */
		echo 'src="' . esc_url( $image_src ) . '" srcset="' . esc_url( $image_srcset ) . '" sizes="(max-width: ' . esc_attr( $max_width ) . ') 100vw, ' . esc_attr( $max_width ) . '"';
	}
}
/******************************
 * Set the max image width.
 ******************************/
function awesome_acf_max_srcset_image_width() {
	return 1800;
}
add_filter( 'max_srcset_image_width', 'awesome_acf_max_srcset_image_width', 10, 2 );



if ( ! function_exists( 'acf_img' ) ) {
	/************************************************
	 * Acf_img.
	 *
	 * @param tring  $str 値.
	 * @param string $size_name WPのサイズ.
	 * @param string $type WPのサイズ.
	 * @param string $row ROW.
	 **********************************************/
	function acf_img( $str, $size_name = 'full', $type = 'photo', $row = '' ) {
		/* 空入力を有効に */
		if ( '' === $type ) {
			$type = 'photo';
		}
		/* rowを第2因数以降でも有効に */
		if ( 'row' === $size_name || 'row' === $type ) {
			$row  = 'row';
			$type = 'photo';
			if ( 'row' === $size_name ) {
				$size_name = 'full';
			}
		}

		/* rowの処理 */
		if ( 'row' !== $row ) {
			$image = get_field( $str );
		} else {
			/* 繰り返し（repeater）の画像呼び出し */
			$image = get_sub_field( $str );
		}

		/* 画像情報の読み込み */
		if ( ! empty( $image ) ) {
			// vars.
			$url     = $image['url'];
			$alt     = $image['alt'];
			$title   = $image['title'];
			$caption = $image['caption'];

			// Resize.
			if ( ( '' !== $size_name ) && ( 'full' !== $size_name ) ) {
				$thumb = $image['sizes'][ $size_name ];
			} else {
				$thumb = $url;
			}

			switch ( $type ) {
				case 'photo':
					$photo = '<img src="' . $thumb . '" alt="' . $alt . '" />';
					break;
				case 'url':
					$photo = $thumb;
					break;
				case 'alt':
					$photo = $image['alt'];
					break;
				case 'title':
					$photo = $image['title'];
					break;
				case 'caption':
					$photo = $image['caption'];
					break;
			}

			echo wp_kses_post( $photo );
		}
	}
}
