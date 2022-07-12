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
/*!**************************************!*\
  !*** ./src/js/function-adminonly.js ***!
  \**************************************/
/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "jquery");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

/************************************************
* userAgent.js//管理画面でもブラウザ判別（フォントなど）
************************************************/
jQuery(function ($) {
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

jQuery(function ($) {
  jQuery('.linkCard a').matchHeight();
});
}();
/******/ })()
;
//# sourceMappingURL=function-adminonly.js.map