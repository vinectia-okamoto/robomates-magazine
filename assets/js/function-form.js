/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ (function(module) {

"use strict";
module.exports = jQuery;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!*********************************!*\
  !*** ./src/js/function-form.js ***!
  \*********************************/
/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "jquery");
jQuery(function ($) {
  if ($('.mw_wp_form_confirm, .mw_wp_form_complete').length) {
    $('body').addClass('preview-form_confirm');
  } else {
    $('body').addClass('preview-form_input');
  }
});
jQuery(function ($) {
  var changeFlg = false;
  $(window).on('beforeunload', function () {
    //変更がある場合のみ警告をだす
    if (changeFlg) {
      return "ページを閉じようとしています。入力した情報が失われますがよろしいですか？";
    }
  }); //フォームの内容が変更されたらフラグを立てる

  $("form input, form textarea, form select").change(function () {
    changeFlg = true;
  }); //特定のボタンが押された場合はフラグを落とす

  $("input[type=submit]").click(function () {
    changeFlg = false;
  });
});
jQuery(function ($) {
  if ($('.mw_wp_form .error')[0]) {
    $('.mw_wp_form').addClass('mw_wp_form_error');
  }
});
}();
/******/ })()
;
//# sourceMappingURL=function-form.js.map