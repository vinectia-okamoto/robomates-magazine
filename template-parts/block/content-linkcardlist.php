<?php

$id = 'linkCardList-' . $block[ 'id' ];
// vars
$linkCardList = get_field( 'linkCardList' );
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
    $classes .= sprintf( ' align%s', $block['align'] );
}

?>


<?php if( get_field('linkCardList-select') == 'タイトル・画像・抜粋文を表示' ): ?>

<?php if ( $linkCardList ): //関連リンクチェックスタート?>

<ul id="<?php echo $id;?>" class="linkCardList noteditor <?php echo esc_attr($classes); ?>">
	<?php foreach( $linkCardList as $linkCard):?>

	<?php 
	$cardslug = $linkCard->post_name ;
	$cardID = $linkCard->ID;
	$cardPostType = $linkCard->post_type;
	?>
	<li class="linkCard">
		<a class="<?php echo esc_attr( $cardslug ); ?> noicon inview_fadeInUp" href="<?php echo get_permalink( $linkCard->ID ); ?>">
			<?php 
    $cardtitle = get_the_title( $cardID );
    $cardimg = get_the_post_thumbnail($cardID, 'custom_600x400', array('alt' => $cardtitle) ); 
    ?>
			<?php if( $cardimg ): ?>

			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><?php echo $cardimg; ?></div>
			<?php else: ?>
			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage-600x400.png" alt="<?php echo esc_attr( $cardtitle ); ?>"></div>
			<?php endif; ?>
			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php echo esc_html( $cardtitle ); ?></h4>

				<?php $cardtxt = apply_filters( 'get_the_excerpt', get_post_field( 'post_excerpt', $cardID ) );?>
				<?php if ( has_excerpt($cardID) ):?><p class="linkCard-txt"><?php echo  esc_html($cardtxt); ?></p><?php endif; ?>

			</div>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php endif; //関連リンクチェック?>


<?php elseif( get_field('linkCardList-select') == 'タイトル・画像を表示' ): ?>

<?php if ( $linkCardList ): //関連リンクチェックスタート?>
<ul id="<?php echo $id;?>" class="linkCardList noteditor">
	<?php foreach( $linkCardList as $linkCard):?>
	<?php $cardslug = $linkCard->post_name ; ?>
	<li class="linkCard">
		<a class="linkCard-a <?php echo esc_attr( $cardslug ); ?> noicon inview_fadeInUp" href="<?php echo get_permalink( $linkCard->ID ); ?>">
			<?php 
    $cardtitle = get_the_title( $linkCard->ID );
    $cardimg = get_the_post_thumbnail( $linkCard->ID, 'custom_600x400', array('alt' => $cardtitle) ); 
    ?>
			<?php if( $cardimg ): ?>
			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><?php echo $cardimg; ?></div>
			<?php else: ?>
			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage-600x400.png" alt="<?php echo esc_attr( $cardtitle ); ?>"></div>
			<?php endif; ?>
			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php echo esc_html( $cardtitle ); ?></h4>
			</div>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php endif; //関連リンクチェック?>

<?php elseif( get_field('linkCardList-select') == 'タイトル・画像（小サイズ）を表示' ): ?>
<?php if ( $linkCardList ): //関連リンクチェックスタート?>
<ul id="<?php echo $id;?>" class="miniLinkCardList noteditor">
	<?php foreach( $linkCardList as $linkCard):?>
	<?php setup_postdata($linkCard); ?>
	<?php $cardslug = $linkCard->post_name ; ?>
	<li class="linkCard">
		<a class="<?php echo esc_attr( $cardslug ); ?> noicon inview_fadeInUp" href="<?php echo get_permalink($linkCard->ID); ?>">
			<?php 
    $cardtitle = get_the_title( $linkCard->ID );
    $cardimg = get_the_post_thumbnail( $linkCard->ID, 'thumbnail', array('alt' => $cardtitle) ); 
    ?>
			<?php if( $cardimg ): ?>
			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><?php echo $cardimg; ?></div>
			<?php endif; ?>
			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php echo esc_html( $cardtitle ); ?></h4>

			</div>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php endif; //関連リンクチェック?>
<?php elseif( get_field('linkCardList-select') == 'タイトル・抜粋文を表示' ): ?>
<?php if ( $linkCardList ): //関連リンクチェックスタート?>
<ul id="<?php echo $id;?>" class="miniLinkCardList noteditor">
	<?php foreach( $linkCardList as $linkCard):?>
	<?php setup_postdata($linkCard); ?>
	<?php $cardslug = $linkCard->post_name ; 
$cardtitle = get_the_title( $linkCard->ID );
?>

	<li class="linkCard">
		<a class="<?php echo esc_attr( $cardslug );?> noicon inview_fadeIn" href="<?php echo get_permalink($linkCard->ID); ?>">
			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php echo esc_html( $cardtitle ); ?></h4>
				<?php $cardtxt = apply_filters( 'get_the_excerpt', get_post_field( 'post_excerpt', $linkCard->ID ) );?>
				<?php if ( has_excerpt($linkCard->ID) ):?><p class="linkCard-txt"><?php echo  esc_html($cardtxt); ?></p><?php endif; ?>
			</div>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php endif; //関連リンクチェック?>

<?php elseif( get_field('linkCardList-select') == 'タイトルのみ表示' ): ?>
<?php if ( $linkCardList ): //関連リンクチェックスタート?>
<ul id="<?php echo $id;?>" class="miniLinkCardList noteditor">
	<?php foreach( $linkCardList as $linkCard):?>
	<?php setup_postdata($linkCard); ?>
	<?php $cardslug = $linkCard->post_name ; 

    $cardtitle = get_the_title( $linkCard->ID );

    ?>

	<li class="linkCard">
		<a class="<?php echo esc_attr( $cardslug ); ?> noicon inview_fadeIn" href="<?php echo get_permalink($linkCard->ID); ?>">
			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php echo esc_html( $cardtitle ); ?></h4>
			</div>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php endif; //関連リンクチェック?>

<?php elseif( get_field('linkCardList-select') == '自動で子ページのタイトル・抜粋文を表示' ): ?>
<?php
  $linkCardListSelectPage = get_field('linkCardList-selectPage');
  if( $linkCardListSelectPage ){
    $thispageid = $linkCardListSelectPage->ID;//選択ページ
  }else{
    $thispageid = my_acf_post_id();//オリジナル関数ACF
  }
?>
<?php $args = array(
    'post_parent' =>$thispageid,
    'post_type' => 'page',
    'order' => 'asc',
	'orderby' => 'menu_order',
	'post_status' => 'publish',
	'posts_per_page' =>-1
    );
$the_query = new WP_Query($args);?>

<?php if ( $the_query->have_posts() ) : ?>

<ul id="<?php echo $id;?>" class="miniLinkCardList noteditor">

	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<li class="linkCard">
		<a href="<?php the_permalink(); ?>" class="noicon inview_fadeIn">
			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php the_title(); ?></h4>

				<?php $cardtxt = apply_filters( 'get_the_excerpt', get_post_field( 'post_excerpt' ) );?>
				<?php if ( has_excerpt() ):?><p class="linkCard-txt"><?php echo  esc_html($cardtxt); ?></p><?php endif; ?>
			</div>
		</a>
	</li>
	<?php endwhile;?>

</ul>
<?php endif; wp_reset_postdata(); ?>

<?php elseif( get_field('linkCardList-select') == '自動で子ページのタイトル・抜粋文・アイキャッチを表示' ): ?>
<?php
  $linkCardListSelectPage = get_field('linkCardList-selectPage');
  if( $linkCardListSelectPage ){
    $thispageid = $linkCardListSelectPage->ID;//選択ページ
  }else{
    $thispageid = my_acf_post_id();//オリジナル関数ACF
  }
?>
<?php $args = array(
    'post_parent' =>$thispageid,
    'post_type' => 'page',
    'order' => 'asc',
	'orderby' => 'menu_order',
	'post_status' => 'publish',
	'posts_per_page' =>-1
    );
$the_query = new WP_Query($args);?>

<?php if ( $the_query->have_posts() ) : ?>

<ul id="<?php echo $id;?>" class="linkCardList noteditor">

	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<li class="linkCard">
		<a href="<?php the_permalink(); ?>" class="noicon inview_fadeIn">

			<?php if (has_post_thumbnail()): $post_title = get_the_title();?>

			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><?php the_post_thumbnail('custom_600x400', array( 'class' => 'hover','alt' => esc_attr($post_title))); ?></div>

			<?php else: ?>

			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage-600x400.png" alt="<?php echo esc_attr( $post_title ); ?>"></div>

			<?php endif; ?>

			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php the_title(); ?></h4>

				<?php $cardtxt = apply_filters( 'get_the_excerpt', get_post_field( 'post_excerpt' ) );?>
				<?php if ( has_excerpt() ):?><p class="linkCard-txt"><?php echo  esc_html($cardtxt); ?></p><?php endif; ?>
			</div>
		</a>
	</li>
	<?php endwhile;?>

</ul>
<?php endif; wp_reset_postdata(); ?>

<?php elseif( get_field('linkCardList-select') == '自動で子ページのタイトル・アイキャッチを表示' ): ?>
<?php
  $linkCardListSelectPage = get_field('linkCardList-selectPage');
  if( $linkCardListSelectPage ){
    $thispageid = $linkCardListSelectPage->ID;//選択ページ
  }else{
    $thispageid = my_acf_post_id();//オリジナル関数ACF
  }
?>
<?php $args = array(
    'post_parent' =>$thispageid,
    'post_type' => 'page',
    'order' => 'asc',
	'orderby' => 'menu_order',
	'post_status' => 'publish',
	'posts_per_page' =>-1
    );
$the_query = new WP_Query($args);?>

<?php if ( $the_query->have_posts() ) : ?>

<ul id="<?php echo $id;?>" class="linkCardList noteditor">

	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<li class="linkCard">
		<a href="<?php the_permalink(); ?>" class="noicon inview_fadeIn">

			<?php if (has_post_thumbnail()): $post_title = get_the_title();?>

			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><?php the_post_thumbnail('custom_600x400', array( 'class' => 'hover','alt' => esc_attr($post_title))); ?></div>

			<?php else: ?>

			<div class="linkCard-imgArea" data-mh="linkCard-imgArea"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/noimage-600x400.png" alt="<?php echo esc_attr( $post_title ); ?>"></div>

			<?php endif; ?>

			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php the_title(); ?></h4>
			</div>
		</a>
	</li>
	<?php endwhile;?>

</ul>
<?php endif; wp_reset_postdata(); ?>

<?php else: ?>
<?php
  $linkCardListSelectPage = get_field('linkCardList-selectPage');
  if( $linkCardListSelectPage ){
    $thispageid = $linkCardListSelectPage->ID;//選択ページ
  }else{
    $thispageid = my_acf_post_id();//オリジナル関数ACF
  }
?>
<?php $args = array(
    'post_parent' =>$thispageid,
    'post_type' => 'page',
    'order' => 'asc',
	'orderby' => 'menu_order',
	'post_status' => 'publish',
	'posts_per_page' =>-1
    );
$the_query = new WP_Query($args);?>

<?php if ( $the_query->have_posts() ) : ?>

<ul id="<?php echo $id;?>" class="miniLinkCardList noteditor">

	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<li class="linkCard">
		<a href="<?php the_permalink(); ?>" class="noicon inview_fadeIn">
			<div class="linkCard-txtArea" data-mh="linkCard-txtArea">
				<h4 class="linkCard-title noteditor iconuse-this"><?php the_title(); ?></h4>
			</div>
		</a>
	</li>
	<?php endwhile;?>

</ul>
<?php endif; wp_reset_postdata(); ?>

<?php endif; ?>