<?php
// @codingStandardsIgnoreFile
/**
 * 投稿更新日カスタマイズフィールド Function
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
// ---------------------------------------------------------------------------
// 記事投稿(編集)画面に更新レベルのボックス追加
// ---------------------------------------------------------------------------

/* ボックス追加 */
if ( function_exists( 'thk_post_update_level' ) === false ) :
	function thk_post_update_level() {
		add_meta_box( 'update_level', '更新方法', 'post_update_level_box', 'post', 'side', 'default' );
		add_meta_box( 'update_level', '更新方法', 'post_update_level_box', 'page', 'side', 'default' );
		add_meta_box( 'update_level', '更新方法', 'post_update_level_box', 'hanadayori', 'side', 'default' );
	}
	add_action( 'admin_menu', 'thk_post_update_level' );
endif;

/* メインフォーム */
if ( function_exists( 'post_update_level_box' ) === false ) :
	function post_update_level_box() {
		global $post_type;
		?>
		<?php if ( 'post' === $post_type ) : ?>
			<div style="padding-top: 5px; overflow: hidden;">
				<div style="padding:5px 0"><input name="update_level" type="radio" value="high" />通常更新</div>
				<div style="padding: 5px 0"><input name="update_level" type="radio" value="low" checked="checked" />修正のみ(更新日時を変更せず記事更新)</div>
				<div style="padding: 5px 0"><input name="update_level" type="radio" value="del" />更新日時消去(公開日時と同じにする)</div>
				<div style="padding: 5px 0; margin-bottom: 10px"><input id="update_level_edit" name="update_level" type="radio" value="edit" />更新日時を手動で変更</div>
			<?php elseif ( 'posthanadayori' === $post_type ) : ?>
				<div style="padding-top: 5px; overflow: hidden;">
					<div style="padding:5px 0"><input name="update_level" type="radio" value="high" checked="checked" />通常更新</div>
					<div style="padding: 5px 0"><input name="update_level" type="radio" value="low" />修正のみ(更新日時を変更せず記事更新)</div>
					<div style="padding: 5px 0"><input name="update_level" type="radio" value="del" />更新日時消去(公開日時と同じにする)</div>
					<div style="padding: 5px 0; margin-bottom: 10px"><input id="update_level_edit" name="update_level" type="radio" value="edit" />更新日時を手動で変更</div>
				<?php else : ?>

					<div style="padding-top: 5px; overflow: hidden;">
						<div style="padding:5px 0"><input name="update_level" type="radio" value="high" checked="checked" />通常更新</div>
						<div style="padding: 5px 0"><input name="update_level" type="radio" value="low" />修正のみ(更新日時を変更せず記事更新)</div>
						<div style="padding: 5px 0"><input name="update_level" type="radio" value="del" />更新日時消去(公開日時と同じにする)</div>
						<div style="padding: 5px 0; margin-bottom: 10px"><input id="update_level_edit" name="update_level" type="radio" value="edit" />更新日時を手動で変更</div>
					<?php endif; ?>
					<?php
					if ( get_the_modified_date( 'c' ) ) {
						$stamp = '更新日時: <span style="font-weight:bold">' . get_the_modified_date( __( 'M j, Y @ H:i' ) ) . '</span>';
					} else {
						$stamp = '更新日時: <span style="font-weight:bold">未更新</span>';
					}
					$date = date_i18n( get_option( 'date_format' ) . ' @ ' . get_option( 'time_format' ), strtotime( $post->post_modified ) );
					?>
					<style>
						.modtime {
							padding: 2px 0 1px 0;
							display: inline !important;
							height: auto !important;
						}


						#timestamp_mod_div {
							padding-top: 5px;
							line-height: 23px;
						}

						#timestamp_mod_div p {
							margin: 8px 0 6px;
						}

						#timestamp_mod_div input {
							border-width: 1px;
							border-style: solid;
						}

						#timestamp_mod_div select {
							height: 21px;
							line-height: 14px;
							padding: 0;
							vertical-align: top;
							font-size: 12px;
							width: 4em;
						}

						#aa_mod,
						#jj_mod,
						#hh_mod,
						#mn_mod {
							padding: 1px;
							font-size: 12px;
						}

						#jj_mod,
						#hh_mod,
						#mn_mod {
							width: 2em;
						}

						#aa_mod {
							width: 3.4em;
						}
					</style>
					<span class="modtime"><?php printf( $stamp, $date ); ?></span>
					<div id="timestamp_mod_div" onkeydown="document.getElementById('update_level_edit').checked=true" onclick="document.getElementById('update_level_edit').checked=true">
						<?php thk_time_mod_form(); ?>
					</div>
					</div>
			<?php
	}
	endif;

	/* 更新日時変更の入力フォーム */
if ( function_exists( 'thk_time_mod_form' ) === false ) :
	function thk_time_mod_form() {
		global $wp_locale, $post;

		$tab_index           = 0;
		$tab_index_attribute = '';
		if ( (int) $tab_index > 0 ) {
			$tab_index_attribute = ' tabindex="' . $tab_index . '"';
		}

		$jj_mod = mysql2date( 'd', $post->post_modified, false );
		$mm_mod = mysql2date( 'm', $post->post_modified, false );
		$aa_mod = mysql2date( 'Y', $post->post_modified, false );
		$hh_mod = mysql2date( 'H', $post->post_modified, false );
		$mn_mod = mysql2date( 'i', $post->post_modified, false );
		$ss_mod = mysql2date( 's', $post->post_modified, false );

		$year = '<label for="aa_mod" class="screen-reader-text">年' .
			'</label><input type="text" id="aa_mod" name="aa_mod" value="' .
			$aa_mod . '" size="4" maxlength="4"' . $tab_index_attribute . ' autocomplete="off" />年';

		$month = '<label for="mm_mod" class="screen-reader-text">月' .
			'</label><select id="mm_mod" name="mm_mod"' . $tab_index_attribute . '>n';
		for ( $i = 1; $i < 13; $i = $i + 1 ) {
			$monthnum = zeroise( $i, 2 );
			$month   .= 'ttt' . '<option value="' . $monthnum . '" ' . selected( $monthnum, $mm_mod, false ) . '>';
			$month   .= $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) );
			$month   .= '</option>n';
		}
		$month .= '</select>';

		$day    = '<label for="jj_mod" class="screen-reader-text">日' .
			'</label><input type="text" id="jj_mod" name="jj_mod" value="' .
			$jj_mod . '" size="2" maxlength="2"' . $tab_index_attribute . ' autocomplete="off" />日';
		$hour   = '<label for="hh_mod" class="screen-reader-text">時' .
			'</label><input type="text" id="hh_mod" name="hh_mod" value="' . $hh_mod .
			'" size="2" maxlength="2"' . $tab_index_attribute . ' autocomplete="off" />';
		$minute = '<label for="mn_mod" class="screen-reader-text">分' .
			'</label><input type="text" id="mn_mod" name="mn_mod" value="' . $mn_mod .
			'" size="2" maxlength="2"' . $tab_index_attribute . ' autocomplete="off" />';

		printf( '%1$s %2$s %3$s <br>@ %4$s : %5$s', $year, $month, $day, $hour, $minute );
		echo '<input type="hidden" id="ss_mod" name="ss_mod" value="' . $ss_mod . '" />';
	}
	endif;

	/* 「修正のみ」は更新しない。それ以外は、それぞれの更新日時に変更する */
if ( function_exists( 'thk_insert_post_data' ) === false ) :
	function thk_insert_post_data( $data, $postarr ) {
		$mydata = isset( $_POST['update_level'] ) ? $_POST['update_level'] : null;

		if ( $mydata === 'low' ) {
			if ( get_post_status( $post_id ) == 'publish' || get_post_status( $post_id ) == 'future' || get_post_status( $post_id ) == 'private' ) {
				if ( empty( get_post_meta( $post_id, '_publish_date', true ) ) ) {
					$data['post_modified']     = $data['post_date'];
					$data['post_modified_gmt'] = $data['post_modified_gmt'];
				}
			} else {
				unset( $data['post_modified'] );
				unset( $data['post_modified_gmt'] );
			}
		} elseif ( $mydata === 'edit' ) {
			$aa_mod        = $_POST['aa_mod'] <= 0 ? date( 'Y' ) : $_POST['aa_mod'];
			$mm_mod        = $_POST['mm_mod'] <= 0 ? date( 'n' ) : $_POST['mm_mod'];
			$jj_mod        = $_POST['jj_mod'] > 31 ? 31 : $_POST['jj_mod'];
			$jj_mod        = $jj_mod <= 0 ? date( 'j' ) : $jj_mod;
			$hh_mod        = $_POST['hh_mod'] > 23 ? $_POST['hh_mod'] - 24 : $_POST['hh_mod'];
			$mn_mod        = $_POST['mn_mod'] > 59 ? $_POST['mn_mod'] - 60 : $_POST['mn_mod'];
			$ss_mod        = $_POST['ss_mod'] > 59 ? $_POST['ss_mod'] - 60 : $_POST['ss_mod'];
			$modified_date = sprintf( '%04d-%02d-%02d %02d:%02d:%02d', $aa_mod, $mm_mod, $jj_mod, $hh_mod, $mn_mod, $ss_mod );
			if ( ! wp_checkdate( $mm_mod, $jj_mod, $aa_mod, $modified_date ) ) {
				unset( $data['post_modified'] );
				unset( $data['post_modified_gmt'] );
				return $data;
			}
			$data['post_modified']     = $modified_date;
			$data['post_modified_gmt'] = get_gmt_from_date( $modified_date );
		} elseif ( $mydata === 'del' ) {
			$data['post_modified']     = $data['post_date'];
			$data['post_modified_gmt'] = $data['post_modified_gmt'];
		}

		return $data;
	}
	add_filter( 'wp_insert_post_data', 'thk_insert_post_data', 10, 2 );
	endif;
