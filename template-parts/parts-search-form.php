<section class="searchArea">
	<div class="search-form">

<form method="get" action="<?php bloginfo( 'url' ); ?>">
<div class="search-form-row">
<fieldset class="search-form-col">
<legend>カテゴリ</legend>
<select id="cat-select" name="selectcats[]" multiple type="search"　readonly="readonly">
<?php
$set_cat_terms = get_terms( 'companies_category' );
if ( $set_cat_terms ) :
	foreach ( $set_cat_terms as $set_cat_term ) :
		?>
<option type="checkbox" value="<?php echo esc_attr( $set_cat_term->term_id ); ?>"><?php echo esc_attr( $set_cat_term->name ); ?></option>
		<?php
	endforeach;
endif;

?>
</select>
</fieldset>
<fieldset class="search-form-col">
<legend>エリア選択</legend>

<select id="area-select" name="selectareas[]" multiple type="search"　readonly="readonly">
<?php
$set_area_terms = get_terms( 'companies_area' );
if ( $set_cat_terms ) :
	foreach ( $set_area_terms as $set_area_term ) :
		?>
<option type="checkbox" value="<?php echo esc_attr( $set_area_term->term_id ); ?>"><?php echo esc_attr( $set_area_term->name ); ?></option>
		<?php
	endforeach;
endif;
?>
</select>


</fieldset>

</div>
<div class="search-form-row_btn_array">

<fieldset class="search-form-col">
<legend>キーワード</legend>
<input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="キーワードを入力">
</fieldset>
<fieldset class="search-form-col">
<input type="hidden" name="post_type" value="companies">
<input class="form-button" type="submit" value="検索する">
</fieldset>

</div>
</form>
</div>
</section>
