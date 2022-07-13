<?php

/**
 * ロボット関連企業ブロック
 */
return array(
	'title'      => 'ロボット関連企業テンプレ',
	'categories' => array('original'),
	'blockTypes' => '',
	'content'    => '
	<!-- wp:acf/companyhero {"name":"acf/companyhero","data":{"robocom-hero-read":"リード文を入れてください","_robocom-hero-read":"field_62c40c0e9c099","robocom-hero-intro":"紹介文を入れてください","_robocom-hero-intro":"field_62c40b3a598ee","robocom-hero-img":89,"_robocom-hero-img":"field_62ce3b206d202"},"align":"wide","mode":"auto","style":{"spacing":{"margin":{"bottom":"50px"}}}} -->
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"roboCom-hero-img"} -->
<figure class="wp-block-image size-large roboCom-hero-img"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt=""/></figure>
<!-- /wp:image -->
<!-- /wp:acf/companyhero -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"50px","bottom":"50px"}}},"backgroundColor":"subtle","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull has-subtle-background-color has-background" style="padding-top:50px;padding-bottom:50px"><!-- wp:acf/sectiontitle {"id":"block_62ce48a9ad9d0","name":"acf/sectiontitle","data":{"sectiontitle_sectiontitle-en":"FEATURE","_sectiontitle_sectiontitle-en":"field_62c3f589ad34e","sectiontitle_sectiontitle-ja":"企業の理念・特徴","_sectiontitle_sectiontitle-ja":"field_62c3f544ad34d","sectiontitle":"","_sectiontitle":"field_62c3f611ad350"},"align":"center","mode":"auto"} /-->

	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"id":89,"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89"/></figure>
			<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3,"className":"is-style-kazarinashi"} -->
			<h3 class="is-style-kazarinashi">見出しを入力してください。</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>テキストを入力してください。</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>今テキストを入力してください。</p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"50px","bottom":"50px"}}}} -->
<div class="wp-block-group" style="padding-top:50px;padding-bottom:50px"><!-- wp:acf/sectiontitle {"id":"block_62ce4e78070e0","name":"acf/sectiontitle","data":{"sectiontitle_sectiontitle-en":"ROBOT INTRODUCTION","_sectiontitle_sectiontitle-en":"field_62c3f589ad34e","sectiontitle_sectiontitle-ja":"ロボット紹介","_sectiontitle_sectiontitle-ja":"field_62c3f544ad34d","sectiontitle":"","_sectiontitle":"field_62c3f611ad350"},"align":"","mode":"auto"} /-->

	<!-- wp:columns -->
	<div class="wp-block-columns"><!-- wp:column {"width":"50%"} -->
		<div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading {"level":3,"className":"is-style-kazarinashi"} -->
			<h3 class="is-style-kazarinashi">ロボットの名前を入力してください。</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>テキストを入力してください。</p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%">
	<!-- wp:image {"id":89,"sizeSlug":"full","linkDestination":"none"} -->
	<figure class="wp-block-image size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
	<!-- /wp:image -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"padding":{"top":"20px","right":"20px","bottom":"20px","left":"20px"}}},"backgroundColor":"secondary"} -->
<div class="wp-block-columns has-secondary-background-color has-background" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px">
	<!-- wp:column {"width":"33.33%"} -->
	<div class="wp-block-column" style="flex-basis:33.33%">
		<!-- wp:image {"id":89,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%"} -->
	<div class="wp-block-column" style="flex-basis:66.66%">
		<!-- wp:heading {"level":6,"style":{"spacing":{"margin":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"className":"is-style-kazarinashi"} -->
		<h6 class="is-style-kazarinashi" style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px">肩書を入力してください。</h6>
		<!-- /wp:heading -->

		<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0px","right":"0px","bottom":"15px"}}},"className":"is-style-kazarinashi"} -->
		<h3 class="is-style-kazarinashi" style="margin-top:0px;margin-right:0px;margin-bottom:15px"><strong>尼崎　太郎 さん</strong></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>このロボットでどのような作業をしているのかなど紹介文を入力してください。</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"50px","bottom":"50px"}}},"backgroundColor":"subtle"} -->
<div class="wp-block-group alignfull has-subtle-background-color has-background" style="padding-top:50px;padding-bottom:50px">
	<!-- wp:group {"layout":{"inherit":true}} -->
	<div class="wp-block-group">
		<!-- wp:acf/sectiontitle {"id":"block_62ce516c629b1","name":"acf/sectiontitle","data":{"sectiontitle_sectiontitle-en":"FLOW","_sectiontitle_sectiontitle-en":"field_62c3f589ad34e","sectiontitle_sectiontitle-ja":"ものづくりの流れ","_sectiontitle_sectiontitle-ja":"field_62c3f544ad34d","sectiontitle":"","_sectiontitle":"field_62c3f611ad350"},"align":"","mode":"auto"} /-->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"backgroundColor":"background"} -->
		<div class="wp-block-group has-background-background-color has-background" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
			<!-- wp:heading {"fontSize":"medium-large"} -->
			<h2 class="has-medium-large-font-size"><strong>STEP1</strong></h2>
			<!-- /wp:heading -->

			<!-- wp:columns -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"60%"} -->
				<div class="wp-block-column" style="flex-basis:60%">
					<!-- wp:heading {"level":5} -->
					<h5>タイトル入力</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"placeholder":"コンテンツ…","fontSize":"medium"} -->
					<p class="has-medium-font-size">作業についての説明を入力。</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"top","width":"40%"} -->
				<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:40%">
					<!-- wp:image {"align":"center","id":89,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"align":"center","id":127,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/arrow-bottom.svg" alt="次へ" class="wp-image-127" /></figure>
		<!-- /wp:image -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"backgroundColor":"background"} -->
		<div class="wp-block-group has-background-background-color has-background" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
			<!-- wp:heading {"fontSize":"medium-large"} -->
			<h2 class="has-medium-large-font-size"><strong>STEP2</strong></h2>
			<!-- /wp:heading -->

			<!-- wp:columns -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"60%"} -->
				<div class="wp-block-column" style="flex-basis:60%">
					<!-- wp:heading {"level":5} -->
					<h5>タイトル入力</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"placeholder":"コンテンツ…","fontSize":"medium"} -->
					<p class="has-medium-font-size">作業についての説明を入力。</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"top","width":"40%"} -->
				<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:40%">
					<!-- wp:image {"align":"center","id":89,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"align":"center","id":127,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/arrow-bottom.svg" alt="次へ" class="wp-image-127" /></figure>
		<!-- /wp:image -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"backgroundColor":"background"} -->
		<div class="wp-block-group has-background-background-color has-background" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
			<!-- wp:heading {"fontSize":"medium-large"} -->
			<h2 class="has-medium-large-font-size"><strong>STEP3</strong></h2>
			<!-- /wp:heading -->

			<!-- wp:columns -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"60%"} -->
				<div class="wp-block-column" style="flex-basis:60%">
					<!-- wp:heading {"level":5} -->
					<h5>タイトル入力</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"placeholder":"コンテンツ…","fontSize":"medium"} -->
					<p class="has-medium-font-size">作業についての説明を入力。</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"top","width":"40%"} -->
				<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:40%">
					<!-- wp:image {"align":"center","id":89,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"align":"center","id":127,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/arrow-bottom.svg" alt="次へ" class="wp-image-127" /></figure>
		<!-- /wp:image -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"backgroundColor":"background"} -->
		<div class="wp-block-group has-background-background-color has-background" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
			<!-- wp:heading {"fontSize":"medium-large"} -->
			<h2 class="has-medium-large-font-size"><strong>STEP4</strong></h2>
			<!-- /wp:heading -->

			<!-- wp:columns -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"60%"} -->
				<div class="wp-block-column" style="flex-basis:60%">
					<!-- wp:heading {"level":5} -->
					<h5>タイトル入力</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"placeholder":"コンテンツ…","fontSize":"medium"} -->
					<p class="has-medium-font-size">作業についての説明を入力。</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"top","width":"40%"} -->
				<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:40%">
					<!-- wp:image {"align":"center","id":89,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"align":"center","id":127,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/arrow-bottom.svg" alt="次へ" class="wp-image-127" /></figure>
		<!-- /wp:image -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"backgroundColor":"background"} -->
		<div class="wp-block-group has-background-background-color has-background" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
			<!-- wp:heading {"fontSize":"medium-large"} -->
			<h2 class="has-medium-large-font-size"><strong>STEP5</strong></h2>
			<!-- /wp:heading -->

			<!-- wp:columns -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"60%"} -->
				<div class="wp-block-column" style="flex-basis:60%">
					<!-- wp:heading {"level":5} -->
					<h5>タイトル入力</h5>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"placeholder":"コンテンツ…","fontSize":"medium"} -->
					<p class="has-medium-font-size">作業についての説明を入力。</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"top","width":"40%"} -->
				<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:40%">
					<!-- wp:image {"align":"center","id":89,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"align":"center","id":127,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/arrow-bottom.svg" alt="次へ" class="wp-image-127" /></figure>
		<!-- /wp:image -->

		<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"backgroundColor":"background"} -->
		<div class="wp-block-group has-background-background-color has-background" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
			<!-- wp:paragraph {"align":"center","fontSize":"medium-large"} -->
			<p class="has-text-align-center has-medium-large-font-size"><strong>完成したのは、●●●●●●●などで使われるロボットの先端部分に取り付けられる部品です。</strong></p>
			<!-- /wp:paragraph -->

			<!-- wp:image {"id":89,"sizeSlug":"large","linkDestination":"none"} -->
			<figure class="wp-block-image size-large"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" /></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"50px","bottom":"50px"}}}} -->
<div class="wp-block-group" style="padding-top:50px;padding-bottom:50px">
	<!-- wp:acf/sectiontitle {"name":"acf/sectiontitle","data":{"sectiontitle_sectiontitle-en":"INFORMATION","_sectiontitle_sectiontitle-en":"field_62c3f589ad34e","sectiontitle_sectiontitle-ja":"企業情報","_sectiontitle_sectiontitle-ja":"field_62c3f544ad34d","sectiontitle":"","_sectiontitle":"field_62c3f611ad350"},"align":"","mode":"auto"} /-->

	<!-- wp:acf/companydata {"name":"acf/companydata","data":{"company-address":"兵庫県●●市●●●●丁目","_company-address":"field_62c3afe558bd1","company-dials":"TEL:078-000-0000　FAX:000-000-0000","_company-dials":"field_62c3c6a0c1c3e","company-url":"http://test-site.com","_company-url":"field_62c3c736c1c3f","company-business":"あああああああああああああああああああああああああああああああああああ","_company-business":"field_62c3c74ac1c40","company-internship":"yes","_company-internship":"field_62c3c75cc1c41","company-internship-data":"ああああああああああああああ","_company-internship-data":"field_62c3c78ac1c42"},"align":"","mode":"auto"} /-->
</div>
<!-- /wp:group -->

<!-- wp:acf/sectiontitle {"name":"acf/sectiontitle","data":{"sectiontitle_sectiontitle-en":"ALUBUM","_sectiontitle_sectiontitle-en":"field_62c3f589ad34e","sectiontitle_sectiontitle-ja":"会社アルバム","_sectiontitle_sectiontitle-ja":"field_62c3f544ad34d","sectiontitle":"","_sectiontitle":"field_62c3f611ad350"},"align":"","mode":"auto"} /-->

<!-- wp:gallery {"imageCrop":false,"linkTo":"none"} -->
<figure class="wp-block-gallery has-nested-images columns-default">
	<!-- wp:image {"id":89,"sizeSlug":"medium","linkDestination":"none"} -->
	<figure class="wp-block-image size-medium"><img src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/noimage-full.png" alt="noimage" class="wp-image-89" />
		<figcaption>ああああああああ</figcaption>
	</figure>
	<!-- /wp:image -->

	<!-- wp:image {"id":61,"sizeSlug":"medium","linkDestination":"none"} -->
	<figure class="wp-block-image size-medium"><img src="https://robomates-magazine.vinectia.jp/cms/wp-content/uploads/2022/07/uploadtest.png" alt="" class="wp-image-61" />
		<figcaption>ああああああああ</figcaption>
	</figure>
	<!-- /wp:image -->
</figure>
<!-- /wp:gallery -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->

'
);