const el = wp.element.createElement;
const categoryIcon = el('svg',
  {
    width: 24,
    height: 24,
    viewBox: '0 0 24 24'
  },
  el(
   'path', {
    fill: '#00a2b7',
    d: 'M9.54,15.26c0,.73-.59,1.32-1.32,1.32-.73,0-1.32-.59-1.32-1.32s.59-1.32,1.32-1.32,1.32,.59,1.32,1.32h0',
  },
  ),
  el(
  'path', {
    fill: '#00a2b7',
    d: 'M17.2,15.26c0,.73-.59,1.32-1.32,1.31s-1.32-.59-1.31-1.32c0-.73,.59-1.31,1.31-1.31,.73,0,1.32,.59,1.32,1.32h0',
  }
  ),
  el(
    'path', {
      fill: '#00a2b7',
      d: 'M4.5,10.38c-.59,.9-.99,1.9-1.2,2.96-.53,2.55,.08,5.21,1.67,7.27,.33,.44,.95,.52,1.38,.19,.44-.33,.52-.95,.19-1.38l-.02-.03c-1.4-1.82-1.81-4.22-1.1-6.41,.1-.31,.22-.61,.37-.89,1.11-2.2,3.3-3.65,5.76-3.81,.02-.71,.23-1.39,.61-1.99-3.09-.06-6,1.49-7.66,4.09m14.56-.59c-.26,.66-.68,1.23-1.24,1.67,1.03,1.62,1.35,3.59,.88,5.45-.15,.62-.4,1.22-.73,1.77-1.09,1.84-2.96,3.08-5.08,3.36-.54,.05-.94,.53-.89,1.08,.05,.54,.53,.94,1.08,.89,.02,0,.04,0,.05,0,2.59-.33,4.91-1.79,6.33-3.98,.59-.9,1.01-1.9,1.23-2.95,.55-2.55-.05-5.2-1.63-7.27',
    }
    ),
	el(
		'path', {
		  fill: '#302d2c',
		  d: 'M20.61,0h-2.21l-3.1,6c-1.32,.08-2.32,1.22-2.24,2.54,.08,1.32,1.22,2.32,2.54,2.24s2.32-1.22,2.24-2.54c-.04-.58-.28-1.13-.69-1.54L20.61,0Z',
		}
		),
);


wp.blocks.updateCategory('vinectia-original', {
icon: categoryIcon
});

/**
 * Remove squared button style
 *
 * @since vinectia 1.0
 */
/* global wp */

wp.blocks.registerBlockStyle("core/heading", {

  name: "kazarinashi",
  label: "飾りを消す"
});

wp.blocks.registerBlockStyle("core/list", {
  name: "flexList-4col",
  label: "4カラム"
});
wp.blocks.registerBlockStyle("core/list", {
  name: "flexList-3col",
  label: "3カラム",
});

wp.blocks.registerBlockStyle("core/list", {
  name: "flexList-2col",
  label: "2カラム"
});



wp.blocks.registerBlockStyle("core/list", {
  name: "flexList-auto",
  label: "なりゆき"
});

wp.blocks.registerBlockStyle("core/table", {
  name: "tbody-firstCellHead",
  label: "一番左側色付",
});
wp.blocks.registerBlockStyle("core/table", {
  name: "tbody-firstCellHead-nowrap",
  label: "一番左側色付改行なし",
});


wp.blocks.registerBlockStyle("core/columns", {
  name: "wp-block-column-sp-reverse",
  label: "スマホ時反転",
});


wp.blocks.registerBlockStyle("core/group", {
  name: "groupBorder",
  label: "枠線あり",
});


wp.blocks.registerBlockStyle("core/image", {
  name: "imgShadow",
  label: "影付き",
});


wp.blocks.registerBlockStyle("core/gallery", {
  name: "touitsu-gallery",
  label: "全同サイズ",
});
wp.blocks.registerBlockStyle("core/gallery", {
  name: "center-gallery",
  label: "中心揃え",
});
wp.blocks.registerBlockStyle("core/gallery", {
  name: "spmax-gallery",
  label: "全同サイズ・スマホ時100%",
});



/**
 * ギャラリーブロックのデフォルト中サイズに
 */
 wp.hooks.addFilter(
  'blocks.registerBlockType',
  'gallery-image-default',
  function (settings, name) {
      if (name !== 'core/gallery') {
          return settings;
      }
     settings.attributes.sizeSlug = {
      default: "medium",
     }
      return settings;
  }
);
