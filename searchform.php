<form id="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
	<input class="form-text" type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力" id="s">
	<button class="search-btn" type="submit" id="s"><i class="fas fa-search"></i></button>
</form>