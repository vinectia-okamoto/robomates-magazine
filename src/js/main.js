import Common from "./module/common.js";
import Ukiyo from "ukiyojs";


/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
imageUkyo
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
const imageUkyo = document.querySelector('.imgparallax');
new Ukiyo(imageUkyo, {
   scale: 1.2, //スケール
   speed: 1.3, //スピード
   // willChange: true, //will-change付ける
   wrapperClass: "wrapper" //ラッパー要素のクラス名
})





/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
*スマホメニューボタン
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

function spToggleBtn_func() {
    //デバイス判定（タッチが有効か否か）
    var isTouchDevice = (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch);
    //デバイス判定によるイベントの決定
    var eventType = (isTouchDevice) ? 'touchend' : 'click';
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
    });

    //メニューの中クリックしたらとじる
    $('.spNavi a').on('click', function () {

        $("html").removeClass("spmenu-open");

    });
    // 表示したポップアップ以外の部分をクリックしたとき
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
  };

/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
*グローバル子メニュー
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
function globalMenu_func() {
$(".globalNavi-links li:has(ul)").each(function(i,e){
    $(e).addClass('menu-item-has-children');
	var windowWidth = window.innerWidth;
	var thisOffsetL =  $(e).offset().left;
	var nokoriWidth = windowWidth - thisOffsetL;
	if(nokoriWidth < 300){
		$(e).addClass('rightmode');
	}

    var linksurl = $(e).children("a").attr("href");
    var linkstxt = $(e).children("a").text();
    $(e).children("ul").addClass('globalNavi-child-links').wrap('<div class="globalNavi-child">');
    if(linksurl){
		$(e).find('.globalNavi-child').prepend('<p class="globalNavi-child-index"><a href="'+linksurl+'">'+linkstxt+'一覧</p>');
    }
});

};
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
        var  thisScrollTop = $(this).scrollTop(),
            scrollBottom = win.scrollTop() + win.height();
        if (thisScrollTop > 500) {
            back_to_top.addClass(showClass);
        } else {
            back_to_top.removeClass(showClass);
        }
    });
    var clickEventType = ((window.ontouchstart !== null) ? 'click' : 'touchstart');
    back_to_top.on(clickEventType, function () {
        $('body,html').animate({
            scrollTop: 0,
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
    if(agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1){

    $('.tel').each(function() {
    var str = $(this).html();
    if ($(this).children().is('img')) {
    $(this).html($('<a>').attr('href', 'tel:' + $(this).children().attr('alt').replace(/-/g, '')).append(str + '</a>'));
    } else {
    $(this).html($('<a>').attr('href', 'tel:' + $(this).text().replace(/-/g, '')).append(str + '</a>'));
    }
    });

    }
    };





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
                            delay: 50, //文字間のエフェクト間隔(ミリ秒)
                            easing: 'swing', //エフェクトのイージングパターン
                        });
                        $(this).addClass('textyle').removeClass('inview_textyle--now').dequeue();

                    });
                });
            }
        });
    }


}

window.addEventListener('load', function() {
//開くボタンを押した時には
const search_wrap = document.querySelector("#searchWrap");
const search_text = document.querySelector(".search-text");
const search_openbtn = document.querySelector(".header-search");
search_openbtn.addEventListener('click', function(){
	search_wrap.classList.add('panelactive');
	search_text.focus();
})

//閉じるボタンを押した時には
const search_closebtn = document.querySelector(".searchWrap-closeBtn");

search_closebtn.addEventListener('click', function(){
	search_wrap.classList.remove('panelactive')
})
})


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

})
