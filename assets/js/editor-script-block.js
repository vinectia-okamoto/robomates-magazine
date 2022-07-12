/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./src/js/editor-script-block.js ***!
  \***************************************/
var el = wp.element.createElement;
var categoryIcon = el('svg', {
  width: 24,
  height: 24,
  viewBox: '0 0 24 24'
}, el('path', {
  fill: '#053a86',
  d: 'M9.75,3.85A3.86,3.86,0,1,1,5.89,0h0A3.86,3.86,0,0,1,9.75,3.85h0'
}), el('path', {
  fill: '#053a86',
  d: 'M22.09,3.85A3.86,3.86,0,1,1,18.23,0h0a3.86,3.86,0,0,1,3.86,3.85'
}), el('path', {
  fill: '#053a86',
  d: 'M20.69,8.22H3.44a2,2,0,0,0-2,2V22a2,2,0,0,0,2,2h6.71V21.4H6.41a1,1,0,0,1-1.06-1,1.05,1.05,0,0,1,1-1.05h3.77v-7a1.92,1.92,0,0,1,3.83,0v7h3.74a1,1,0,0,1,0,2.08H14V24h6.71a2,2,0,0,0,2-2V10.19a2,2,0,0,0-2-2'
}));
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
  label: "3カラム"
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
  label: "一番左側色付"
});
wp.blocks.registerBlockStyle("core/table", {
  name: "tbody-firstCellHead-nowrap",
  label: "一番左側色付改行なし"
});
wp.blocks.registerBlockStyle("core/columns", {
  name: "wp-block-column-sp-reverse",
  label: "スマホ時反転"
});
wp.blocks.registerBlockStyle("core/group", {
  name: "groupBorder",
  label: "枠線あり"
});
wp.blocks.registerBlockStyle("core/image", {
  name: "imgShadow",
  label: "影付き"
});
wp.blocks.registerBlockStyle("core/gallery", {
  name: "touitsu-gallery",
  label: "全同サイズ"
});
wp.blocks.registerBlockStyle("core/gallery", {
  name: "center-gallery",
  label: "中心揃え"
});
wp.blocks.registerBlockStyle("core/gallery", {
  name: "spmax-gallery",
  label: "全同サイズ・スマホ時100%"
});
/**
 * ギャラリーブロックのデフォルト中サイズに
 */

wp.hooks.addFilter('blocks.registerBlockType', 'gallery-image-default', function (settings, name) {
  if (name !== 'core/gallery') {
    return settings;
  }

  settings.attributes.sizeSlug = {
    default: "medium"
  };
  return settings;
});
/******/ })()
;
//# sourceMappingURL=editor-script-block.js.map