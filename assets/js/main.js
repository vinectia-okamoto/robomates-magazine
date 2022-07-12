/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/module/common.js":
/*!*********************************!*\
  !*** ./src/js/module/common.js ***!
  \*********************************/
/***/ (function(module, exports, __webpack_require__) {

/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "jquery");
/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "jquery");
var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

/************************************************
* userAgent.js
************************************************/
$(function () {
  var ua = navigator.userAgent.toLowerCase();
  var ver = navigator.appVersion.toLowerCase();
  var isMSIE = ua.indexOf('msie') > -1 && ua.indexOf('opera') == -1;
  var isIE6 = isMSIE && ver.indexOf('msie 6.') > -1;
  var isIE7 = isMSIE && ver.indexOf('msie 7.') > -1;
  var isIE8 = isMSIE && ver.indexOf('msie 8.') > -1;
  var isIE9 = isMSIE && ver.indexOf('msie 9.') > -1;
  var isIE10 = isMSIE && ver.indexOf('msie 10.') > -1;
  var isIE11 = ua.indexOf('trident/7') > -1;
  var isIE = isMSIE || isIE11;
  var isEdge = ua.indexOf('edge') > -1;
  var isChrome = ua.indexOf('chrome') > -1 && ua.indexOf('edge') == -1;
  var isFirefox = ua.indexOf('firefox') > -1;
  var isSafari = ua.indexOf('safari') > -1 && ua.indexOf('chrome') == -1;
  var isOpera = ua.indexOf('opera') > -1;
  $(function () {
    if (isOpera) {
      $("body").addClass("js_isOpera");
    } else if (isIE) {
      $("body").addClass("js_isIe");
    } else if (isChrome) {
      $("body").addClass("js_isChrome");
    } else if (isSafari) {
      $("body").addClass("js_isSafari");
    } else if (isEdge) {
      $("body").addClass("js_isEdge");
    } else if (isFirefox) {
      $("body").addClass("js_isFirefox");
    } else {
      return false;
    }
  });

  var _ua = function (u) {
    return {
      Tablet: u.indexOf("windows") != -1 && u.indexOf("touch") != -1 && u.indexOf("tablet pc") == -1 || u.indexOf("ipad") != -1 || u.indexOf("android") != -1 && u.indexOf("mobile") == -1 || u.indexOf("firefox") != -1 && u.indexOf("tablet") != -1 || u.indexOf("kindle") != -1 || u.indexOf("silk") != -1 || u.indexOf("playbook") != -1,
      Mobile: u.indexOf("windows") != -1 && u.indexOf("phone") != -1 || u.indexOf("iphone") != -1 || u.indexOf("ipod") != -1 || u.indexOf("android") != -1 && u.indexOf("mobile") != -1 || u.indexOf("firefox") != -1 && u.indexOf("mobile") != -1 || u.indexOf("blackberry") != -1
    };
  }(window.navigator.userAgent.toLowerCase());

  $(function () {
    if (_ua.Mobile) {
      $('body').addClass("js_isMobile");
    } else if (_ua.Tablet) {
      $('body').addClass("js_isTablet");
    } else {
      $('body').addClass("js_isPc");
    }
  });

  if (navigator.platform.indexOf("Win") != -1) {
    $('body').addClass('js_isWin');
  } else {
    $('body').addClass('js_isNotWin');
  }

  $(function () {
    var ua = navigator.userAgent;

    if (ua.indexOf('iPhone') > 0) {
      $('body').addClass('iPhone');
    } else if (ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
      $('body').addClass('Android');
    } else if (ua.indexOf('iPad') > 0) {
      $('body').addClass('iPad');
    }
  });
});
/************************************************
* jquery.matchHeight-min.js master
* http://brm.io/jquery-match-height/
* License: MIT
************************************************/

(function (c) {
  var n = -1,
      f = -1,
      g = function g(a) {
    return parseFloat(a) || 0;
  },
      r = function r(a) {
    var b = null,
        d = [];
    c(a).each(function () {
      var a = c(this),
          k = a.offset().top - g(a.css("margin-top")),
          l = 0 < d.length ? d[d.length - 1] : null;
      null === l ? d.push(a) : 1 >= Math.floor(Math.abs(b - k)) ? d[d.length - 1] = l.add(a) : d.push(a);
      b = k;
    });
    return d;
  },
      p = function p(a) {
    var b = {
      byRow: !0,
      property: "height",
      target: null,
      remove: !1
    };
    if ("object" === _typeof(a)) return c.extend(b, a);
    "boolean" === typeof a ? b.byRow = a : "remove" === a && (b.remove = !0);
    return b;
  },
      b = c.fn.matchHeight = function (a) {
    a = p(a);

    if (a.remove) {
      var e = this;
      this.css(a.property, "");
      c.each(b._groups, function (a, b) {
        b.elements = b.elements.not(e);
      });
      return this;
    }

    if (1 >= this.length && !a.target) return this;

    b._groups.push({
      elements: this,
      options: a
    });

    b._apply(this, a);

    return this;
  };

  b._groups = [];
  b._throttle = 80;
  b._maintainScroll = !1;
  b._beforeUpdate = null;
  b._afterUpdate = null;

  b._apply = function (a, e) {
    var d = p(e),
        h = c(a),
        k = [h],
        l = c(window).scrollTop(),
        f = c("html").outerHeight(!0),
        m = h.parents().filter(":hidden");
    m.each(function () {
      var a = c(this);
      a.data("style-cache", a.attr("style"));
    });
    m.css("display", "block");
    d.byRow && !d.target && (h.each(function () {
      var a = c(this),
          b = a.css("display");
      "inline-block" !== b && "inline-flex" !== b && (b = "block");
      a.data("style-cache", a.attr("style"));
      a.css({
        display: b,
        "padding-top": "0",
        "padding-bottom": "0",
        "margin-top": "0",
        "margin-bottom": "0",
        "border-top-width": "0",
        "border-bottom-width": "0",
        height: "100px"
      });
    }), k = r(h), h.each(function () {
      var a = c(this);
      a.attr("style", a.data("style-cache") || "");
    }));
    c.each(k, function (a, b) {
      var e = c(b),
          f = 0;
      if (d.target) f = d.target.outerHeight(!1);else {
        if (d.byRow && 1 >= e.length) {
          e.css(d.property, "");
          return;
        }

        e.each(function () {
          var a = c(this),
              b = a.css("display");
          "inline-block" !== b && "inline-flex" !== b && (b = "block");
          b = {
            display: b
          };
          b[d.property] = "";
          a.css(b);
          a.outerHeight(!1) > f && (f = a.outerHeight(!1));
          a.css("display", "");
        });
      }
      e.each(function () {
        var a = c(this),
            b = 0;
        d.target && a.is(d.target) || ("border-box" !== a.css("box-sizing") && (b += g(a.css("border-top-width")) + g(a.css("border-bottom-width")), b += g(a.css("padding-top")) + g(a.css("padding-bottom"))), a.css(d.property, f - b + "px"));
      });
    });
    m.each(function () {
      var a = c(this);
      a.attr("style", a.data("style-cache") || null);
    });
    b._maintainScroll && c(window).scrollTop(l / f * c("html").outerHeight(!0));
    return this;
  };

  b._applyDataApi = function () {
    var a = {};
    c("[data-match-height], [data-mh]").each(function () {
      var b = c(this),
          d = b.attr("data-mh") || b.attr("data-match-height");
      a[d] = d in a ? a[d].add(b) : b;
    });
    c.each(a, function () {
      this.matchHeight(!0);
    });
  };

  var q = function q(a) {
    b._beforeUpdate && b._beforeUpdate(a, b._groups);
    c.each(b._groups, function () {
      b._apply(this.elements, this.options);
    });
    b._afterUpdate && b._afterUpdate(a, b._groups);
  };

  b._update = function (a, e) {
    if (e && "resize" === e.type) {
      var d = c(window).width();
      if (d === n) return;
      n = d;
    }

    a ? -1 === f && (f = setTimeout(function () {
      q(e);
      f = -1;
    }, b._throttle)) : q(e);
  };

  c(b._applyDataApi);
  c(window).bind("load", function (a) {
    b._update(!1, a);
  });
  c(window).bind("resize orientationchange", function (a) {
    b._update(!0, a);
  });
})(jQuery);
/************************************************
 * author Christopher Blum
 *    - based on the idea of Remy Sharp, http://remysharp.com/2009/01/26/element-in-view-event-plugin/
 *    - forked from http://github.com/zuk/jquery.inview/
************************************************/


!function (a) {
   true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "jquery")], __WEBPACK_AMD_DEFINE_FACTORY__ = (a),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : 0;
}(function (a) {
  function i() {
    var b,
        c,
        d = {
      height: f.innerHeight,
      width: f.innerWidth
    };
    return d.height || (b = e.compatMode, (b || !a.support.boxModel) && (c = "CSS1Compat" === b ? g : e.body, d = {
      height: c.clientHeight,
      width: c.clientWidth
    })), d;
  }

  function j() {
    return {
      top: f.pageYOffset || g.scrollTop || e.body.scrollTop,
      left: f.pageXOffset || g.scrollLeft || e.body.scrollLeft
    };
  }

  function k() {
    if (b.length) {
      var e = 0,
          f = a.map(b, function (a) {
        var b = a.data.selector,
            c = a.$element;
        return b ? c.find(b) : c;
      });

      for (c = c || i(), d = d || j(); e < b.length; e++) {
        if (a.contains(g, f[e][0])) {
          var h = a(f[e]),
              k = {
            height: h[0].offsetHeight,
            width: h[0].offsetWidth
          },
              l = h.offset(),
              m = h.data("inview");
          if (!d || !c) return;
          l.top + k.height > d.top && l.top < d.top + c.height && l.left + k.width > d.left && l.left < d.left + c.width ? m || h.data("inview", !0).trigger("inview", [!0]) : m && h.data("inview", !1).trigger("inview", [!1]);
        }
      }
    }
  }

  var c,
      d,
      h,
      b = [],
      e = document,
      f = window,
      g = e.documentElement;
  a.event.special.inview = {
    add: function add(c) {
      b.push({
        data: c,
        $element: a(this),
        element: this
      }), !h && b.length && (h = setInterval(k, 250));
    },
    remove: function remove(a) {
      for (var c = 0; c < b.length; c++) {
        var d = b[c];

        if (d.element === this && d.data.guid === a.guid) {
          b.splice(c, 1);
          break;
        }
      }

      b.length || (clearInterval(h), h = null);
    }
  }, a(f).on("scroll resize scrollstop", function () {
    c = d = null;
  }), !g.addEventListener && g.attachEvent && g.attachEvent("onfocusin", function () {
    d = null;
  });
});
/************************************************
 * Textyle.js - v2.0
 * https://github.com/mycreatesite/Textyle.js
 * MIT licensed
 * Copyright (C) 2019 ma-ya's CREATE
 * https://myscreate.com
************************************************/

(function (a) {
  a.fn.textyle = function (b) {
    var g = this;
    var d = g.contents();
    var f = {
      duration: 400,
      delay: 100,
      easing: "swing",
      callback: null
    };
    var c = a.extend(f, b);
    d.each(function () {
      var h = a(this);

      if (this.nodeType === 3) {
        e(h);
      }
    });

    function e(h) {
      h.replaceWith(h.text().replace(/(\S)/g, "<span>$1</span>"));
    }

    return this.each(function () {
      var h = g.children().length;
      g.css("opacity", 1);

      for (var j = 0; j < h; j++) {
        g.children("span:eq(" + j + ")").delay(c.delay * j).animate({
          opacity: 1,
          top: 0,
          left: 0
        }, c.duration, c.easing, c.callback);
      }
    });
  };
})(jQuery);

/***/ }),

/***/ "./node_modules/ukiyojs/dist/ukiyo.min.js":
/*!************************************************!*\
  !*** ./node_modules/ukiyojs/dist/ukiyo.min.js ***!
  \************************************************/
/***/ (function(module) {

!function(t,e){ true?module.exports=e():0}(this,(function(){"use strict";var t=function(t,e){var i=this;if(void 0===e&&(e={}),t&&(s="undefined"!=typeof Promise&&-1!==Promise.toString().indexOf("[native code]"),r=Element.prototype.closest,s&&r&&"IntersectionObserver"in window)){var s,r;this.element=t,this.wrapper=document.createElement("div"),this.isIMGtag="img"===t.tagName.toLowerCase(),this.overflow=null,this.timer=null,this.resizeEvent=this.resize.bind(this),this.observer=null,this.requestId=null,this.isInit=!1;this.options=Object.assign({},{scale:1.5,speed:1.5,wrapperClass:null,willChange:!1},e);var n,o=t.getAttribute("data-u-scale"),l=t.getAttribute("data-u-speed"),a=t.getAttribute("data-u-willchange");if(null!==o&&(this.options.scale=o),null!==l&&(this.options.speed=l),null!==a&&(this.options.willChange=!0),this.isIMGtag){var h=this.element.getAttribute("src");(n=h,new Promise((function(t,e){var i=new Image;i.onload=function(){return t(i)},i.onerror=function(t){return e(t)},i.src=n}))).then((function(){i._init()}))}else this._init()}};return t.prototype._init=function(){this.isInit||(this._setupElements(),this._observer(),this._addEvent(),this.isInit=!0)},t.prototype._setupElements=function(){this._setStyles(!0);var t=this.element.getAttribute("data-u-wrapper-class"),e=this.element.closest("picture");if(this.options.wrapperClass||t){var i=t||this.options.wrapperClass;this.wrapper.classList.add(i)}null!==e?(e.parentNode.insertBefore(this.wrapper,e),this.wrapper.appendChild(e)):(this.element.parentNode.insertBefore(this.wrapper,this.element),this.wrapper.appendChild(this.element))},t.prototype._setStyles=function(t){var e=this.element.clientHeight,i=this.element.clientWidth,s=document.defaultView.getComputedStyle(this.element),r="absolute"===s.position;this.overflow=e-e*this.options.scale,"absolute"===s.position&&"0px"!==s.marginRight&&"0px"!==s.marginLeft&&s.marginLeft===s.marginRight&&(this.wrapper.style.margin="auto"),"0px"===s.marginTop&&"0px"===s.marginBottom||(this.wrapper.style.marginTop=s.marginTop,this.wrapper.style.marginBottom=s.marginBottom,this.element.style.marginTop="0",this.element.style.marginBottom="0"),"auto"!==s.inset&&(this.wrapper.style.top=s.top,this.wrapper.style.right=s.right,this.wrapper.style.bottom=s.bottom,this.wrapper.style.left=s.left,this.element.style.top="0",this.element.style.right="0",this.element.style.bottom="0",this.element.style.left="0"),"none"!==s.transform&&(this.wrapper.style.transform=s.transform),"auto"!==s.zIndex&&(this.wrapper.style.zIndex=s.zIndex),this.wrapper.style.position=r?"absolute":"relative","auto"!==s.gridArea&&"auto / auto / auto / auto"!==s.gridArea&&(this.wrapper.style.gridArea=s.gridArea,this.element.style.gridArea="auto"),t&&(this.wrapper.style.width="100%",this.wrapper.style.overflow="hidden",this.element.style.display="block",this.element.style.overflow="hidden",this.element.style.backfaceVisibility="hidden","0px"!==s.padding&&(this.element.style.padding="0"),this.isIMGtag?this.element.style.objectFit="cover":this.element.style.backgroundPosition="center"),r&&(this.wrapper.style.width=i+"px",this.element.style.width="100%"),"none"!==s.maxHeight&&(this.wrapper.style.maxHeight=s.maxHeight,this.element.style.maxHeight="none"),"0px"!==s.minHeight&&(this.wrapper.style.minHeight=s.minHeight,this.element.style.minHeight="none"),this.wrapper.style.height=e+"px",this.element.style.height=e*this.options.scale+"px"},t.prototype._observer=function(){this.observer=new IntersectionObserver(this._observerCallback.bind(this),{root:null,rootMargin:"0px",threshold:0}),this.observer.observe(this.wrapper)},t.prototype._observerCallback=function(t){var e=this;t.forEach((function(t){t.isIntersecting?(e.isVisible=!0,e._update()):(e.isVisible=!1,e._cancel())}))},t.prototype._update=function(){this._setPosition(),this.requestId=window.requestAnimationFrame(this._update.bind(this))},t.prototype._setPosition=function(){this.options.willChange&&"transform"!==this.element.style.willChange&&(this.element.style.willChange="transform"),this.element.style.transform="translate3d(0 , "+this._getTranslate()+"px , 0)"},t.prototype._getTranslate=function(){var t=Math.abs(this.overflow),e=this._getProgress()/100,i=this.overflow+t*e*this.options.speed;return Math.round(i)},t.prototype._getProgress=function(){var t=window.innerHeight,e=this.wrapper.offsetHeight,i=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop||0,s=(i+t-(this.wrapper.getBoundingClientRect().top+i))/((t+e)/100);return Math.min(100,Math.max(0,s))},t.prototype._cancel=function(){this.requestId&&(this.options.willChange&&(this.element.style.willChange="auto"),window.cancelAnimationFrame(this.requestId))},t.prototype._addEvent=function(){navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)?window.addEventListener("orientationchange",this.resizeEvent):window.addEventListener("resize",this.resizeEvent)},t.prototype.resize=function(){clearTimeout(this.timer),this.timer=setTimeout(this.reset.bind(this),450)},t.prototype.reset=function(){this.wrapper.style.width="",this.wrapper.style.position="",this.element.style.width="",this.isIMGtag&&"absolute"===this.wrapper.style.position?this.wrapper.style.height="100%":this.wrapper.style.height="",""===this.wrapper.style.gridArea?this.element.style.height="":this.element.style.height="100%","0px"!==this.wrapper.style.margin&&(this.wrapper.style.margin="",this.element.style.margin=""),"auto"!==this.wrapper.style.inset&&(this.wrapper.style.top="",this.wrapper.style.right="",this.wrapper.style.bottom="",this.wrapper.style.left="",this.element.style.top="",this.element.style.right="",this.element.style.bottom="",this.element.style.left=""),"none"!==this.wrapper.style.transform&&(this.wrapper.style.transform="",this.element.style.transform=""),"auto"!==this.wrapper.style.zIndex&&(this.wrapper.style.zIndex=""),this._setStyles(),this._setPosition()},t.prototype.destroy=function(){var t;this._cancel(),this.observer.disconnect(),this.wrapper.removeAttribute("style"),this.element.removeAttribute("style"),(t=this.wrapper).replaceWith.apply(t,this.wrapper.childNodes),window.removeEventListener("resize",this.resizeEvent),window.removeEventListener("orientationchange",this.resizeEvent),this.isInit=!1},t}));


/***/ }),

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
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_common_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/common.js */ "./src/js/module/common.js");
/* harmony import */ var _module_common_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_module_common_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var ukiyojs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ukiyojs */ "./node_modules/ukiyojs/dist/ukiyo.min.js");
/* harmony import */ var ukiyojs__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(ukiyojs__WEBPACK_IMPORTED_MODULE_1__);
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "jquery");


/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
imageUkyo
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

var imageUkyo = document.querySelector('.imgparallax');
new (ukiyojs__WEBPACK_IMPORTED_MODULE_1___default())(imageUkyo, {
  scale: 1.2,
  //スケール
  speed: 1.3,
  //スピード
  // willChange: true, //will-change付ける
  wrapperClass: "wrapper" //ラッパー要素のクラス名

});
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
*スマホメニューボタン
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

function spToggleBtn_func() {
  //デバイス判定（タッチが有効か否か）
  var isTouchDevice = 'ontouchstart' in window || window.DocumentTouch && document instanceof DocumentTouch; //デバイス判定によるイベントの決定

  var eventType = isTouchDevice ? 'touchend' : 'click';
  $(".sp_btn").on("click", function () {
    $("html").toggleClass("spmenu-open");
  });
  var window_width = window.innerWidth;
  var timer = false;
  $(window).on('orientationchange', function () {
    var resize_width = window.innerWidth;

    if (window_width != resize_width) {
      if (timer !== false) {
        clearTimeout(timer);
      }

      timer = setTimeout(function () {
        $("html").removeClass("spmenu-open");
        window_width = resize_width;
      }, 100);
    }
  }); //メニューの中クリックしたらとじる

  $('.spNavi a').on('click', function () {
    $("html").removeClass("spmenu-open");
  }); // 表示したポップアップ以外の部分をクリックしたとき

  $(document).on('click touchend', function (event) {
    if ($("html").hasClass("spmenu-open")) {
      if (!$(event.target).closest(".spNavi").length && !$(event.target).closest(".header").length) {
        $("html").removeClass("spmenu-open");
      }
    }
  });
}
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
*スマホアコーディオンメニュー
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/


function spMenu_func() {
  $(".spNavi-links li:has(ul)").addClass('menu-item-has-children');
  $(".spNavi-links .menu-item-has-children > a").after('<span class="accordionBtn"><i class="fa-solid fa-plus"></i></span>');
  $('.spNavi-links .accordionBtn').on('click', function () {
    var parent = $(this).parent('li');

    if (parent.hasClass('open')) {
      parent.find(".open").removeClass("open");
      parent.removeClass("open");
      parent.find("ul").slideUp("fast");
    } else {
      parent.addClass("open");
      parent.children("ul").slideDown("fast");
      parent.siblings("li").removeClass("open").find("ul").slideUp("fast");
    }
  });
}

;
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
*グローバル子メニュー
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

function globalMenu_func() {
  $(".globalNavi-links li:has(ul)").each(function (i, e) {
    $(e).addClass('menu-item-has-children');
    var windowWidth = window.innerWidth;
    var thisOffsetL = $(e).offset().left;
    var nokoriWidth = windowWidth - thisOffsetL;

    if (nokoriWidth < 300) {
      $(e).addClass('rightmode');
    }

    var linksurl = $(e).children("a").attr("href");
    var linkstxt = $(e).children("a").text();
    $(e).children("ul").addClass('globalNavi-child-links').wrap('<div class="globalNavi-child">');

    if (linksurl) {
      $(e).find('.globalNavi-child').prepend('<p class="globalNavi-child-index"><a href="' + linksurl + '">' + linkstxt + '一覧</p>');
    }
  });
}

;
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
* back_to_top
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

function backtotop_func() {
  "use strict";

  var win = $(window),
      back_to_top = $('.backtotop'),
      showClass = 'backtotop-visible',
      scroll_top_duration = 700;
  win.on('load scroll', function () {
    var thisScrollTop = $(this).scrollTop(),
        scrollBottom = win.scrollTop() + win.height();

    if (thisScrollTop > 500) {
      back_to_top.addClass(showClass);
    } else {
      back_to_top.removeClass(showClass);
    }
  });
  var clickEventType = window.ontouchstart !== null ? 'click' : 'touchstart';
  back_to_top.on(clickEventType, function () {
    $('body,html').animate({
      scrollTop: 0
    }, scroll_top_duration);
  });
}
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
* smooth scroll
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/


function smooth_scroll_func() {
  var headerHeight = 100;
  var urlHash = location.hash;

  if (urlHash) {
    $("body,html").stop().scrollTop(0);
    setTimeout(function () {
      var target = $(urlHash);
      var position = target.offset().top - headerHeight;
      $("body,html").stop().animate({
        scrollTop: position
      }, 0);
    }, 100);
    return false;
  }

  $('a[href^="#"]').on("click", function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top - headerHeight;
    $("body,html").stop().animate({
      scrollTop: position
    }, 500, "swing");
    return false;
  });
}
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
スマホのみTEL有効
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/


function telLink_func() {
  var agent = navigator.userAgent;

  if (agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1) {
    $('.tel').each(function () {
      var str = $(this).html();

      if ($(this).children().is('img')) {
        $(this).html($('<a>').attr('href', 'tel:' + $(this).children().attr('alt').replace(/-/g, '')).append(str + '</a>'));
      } else {
        $(this).html($('<a>').attr('href', 'tel:' + $(this).text().replace(/-/g, '')).append(str + '</a>'));
      }
    });
  }
}

;
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
 * inview
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー*/

function inview_func() {
  var inviewDeferred = $.Deferred();

  if ($('body').hasClass('inview--use')) {
    inviewDeferred.resolve();
  }

  inviewDeferred.done(function () {
    inview_curtain(); //隠したいアイテムをspanやdivでくくりそこにclass名（inview_curtain）

    inview_fadeInZoom(); //フェードインclass名（inview_fadeIn）

    inview_fadeIn(); //フェードインclass名（inview_fadeIn）

    inview_fadeInUp(); //フェードインclass名（inview_fadeInUp）

    inview_zoomIn();
    inview_textyle(); //テキストエフェクトclass名（inview_textyle）

    effectFlug(); //inviewでフラグ立てたいとき用class名（effectFlug）をつけたものに（effect_start）クラスがつく
  });

  function effectFlug() {
    $('.effectFlug').one('inview', function (event, isInView) {
      $(this).addClass('effectFlug--now');

      if (isInView) {
        $('.effectFlug--now').each(function (i) {
          $(this).delay(i * 200).queue(function () {
            $(this).addClass('animated animate__effectFlug').removeClass('effectFlug--now effectFlug').dequeue();
          });
        });
      }
    });
  }

  function inview_fadeInZoom() {
    $('.inview_fadeInZoom').one('inview', function (event, isInView) {
      $(this).addClass('inview_fadeInZoom--now');

      if (isInView) {
        $('.inview_fadeInZoom--now').each(function (i) {
          $(this).delay(i * 100).queue(function () {
            $(this).addClass('animated animate__fadeInZoom').removeClass('inview_fadeInZoom--now inview_fadeInZoom').dequeue();
          });
        });
      }
    });
  }

  function inview_fadeIn() {
    $('.inview_fadeIn').one('inview', function (event, isInView) {
      $(this).addClass('inview_fadeIn--now');

      if (isInView) {
        $('.inview_fadeIn--now').each(function (i) {
          $(this).delay(i * 100).queue(function () {
            $(this).addClass('animated animate__fadeIn').removeClass('inview_fadeIn--now inview_fadeIn').dequeue();
          });
        });
      }
    });
  }

  function inview_fadeInUp() {
    $('.inview_fadeInUp').one('inview', function (event, isInView) {
      $(this).addClass('inview_fadeInUp--now');

      if (isInView) {
        $('.inview_fadeInUp--now').each(function (i) {
          $(this).delay(i * 100).queue(function () {
            $(this).addClass('animated animate__fadeInUp').removeClass('inview_fadeInUp--now inview_fadeInUp').dequeue();
          });
        });
      }
    });
  }

  function inview_zoomIn() {
    $('.inview_zoomIn').one('inview', function (event, isInView) {
      $(this).addClass('inview_zoomIn--now');

      if (isInView) {
        $('.inview_zoomIn--now').each(function (i) {
          $(this).delay(i * 100).queue(function () {
            $(this).addClass('animated animate__zoomIn').removeClass('inview_zoomIn--now inview_zoomIn').dequeue();
          });
        });
      }
    });
  }

  function inview_curtain() {
    $('.inview_curtain').one('inview', function (event, isInView) {
      $(this).addClass('inview_curtain--now');

      if (isInView) {
        $('.inview_curtain--now').each(function (i) {
          $(this).delay(i * 200).queue(function () {
            $(this).addClass('curtain-start').removeClass('inview_curtain--now').dequeue();
          });
        });
      }
    });
  }

  function inview_textyle() {
    $('.inview_textyle').one('inview', function (event, isInView) {
      $(this).addClass('inview_textyle--now');

      if (isInView) {
        $('.inview_textyle--now').each(function (i) {
          $(this).delay(i * 150).queue(function () {
            $(this).textyle({
              // duration : 400, //エフェクト時間(ミリ秒)
              delay: 50,
              //文字間のエフェクト間隔(ミリ秒)
              easing: 'swing' //エフェクトのイージングパターン

            });
            $(this).addClass('textyle').removeClass('inview_textyle--now').dequeue();
          });
        });
      }
    });
  }
}

window.addEventListener('load', function () {
  //開くボタンを押した時には
  var search_wrap = document.querySelector("#searchWrap");
  var search_text = document.querySelector(".search-text");
  var search_openbtn = document.querySelector(".header-search");
  search_openbtn.addEventListener('click', function () {
    search_wrap.classList.add('panelactive');
    search_text.focus();
  }); //閉じるボタンを押した時には

  var search_closebtn = document.querySelector(".searchWrap-closeBtn");
  search_closebtn.addEventListener('click', function () {
    search_wrap.classList.remove('panelactive');
  });
});
/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
呼び出し
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

$(function () {
  inview_func();
  backtotop_func();
  spToggleBtn_func();
  globalMenu_func();
  spMenu_func();
  telLink_func();
  smooth_scroll_func();
});
}();
/******/ })()
;
//# sourceMappingURL=main.js.map