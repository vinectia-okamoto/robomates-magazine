import Ukiyo from "ukiyojs";

import gsap from "gsap";
import ScrollTrigger from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);
import smoothScroll from 'smooth-scroll';
import Choices from 'choices.js';

/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
gsap
イージングはhttps://greensock.com/docs/v3/Easing
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
gsap.config({
nullTargetWarn: false,
});

//インビューエフェクト
gsap.set(".inview_fadeInUp", {
y: 100,
opacity: 0
});
gsap.set(".inview_fadeIn", {
opacity: 0
});


ScrollTrigger.batch(".inview_fadeInUp", {
onEnter: batch => gsap.to(batch, {
ease: "back",
opacity: 1,
y: 0,
stagger: 0.05,
overwrite: true,

}),
onEnterBack: batch => gsap.to(batch, {
ease: "back",
opacity: 1,
y: 0,
stagger: 0.05,
overwrite: true,

}),
once: true
});
ScrollTrigger.addEventListener("refreshInit", () => gsap.set(".inview_fadeInUp", {
y: 0
}));

ScrollTrigger.batch(".inview_fadeIn", {
onEnter: batch => gsap.to(batch, {
ease: "power1",
opacity: 1,

stagger: 0.05,
overwrite: true,

}),
onEnterBack: batch => gsap.to(batch, {
ease: "power1",
opacity: 1,
stagger: 0.05,
overwrite: true,
}),
once: true
});
ScrollTrigger.addEventListener("refreshInit", () => gsap.set(".inview_fadeIn", {
opacity: 0
}));


const inview_events = document.querySelectorAll('.inview_event');
inview_events.forEach((inview_event, i) => {

	gsap.to(inview_event,{
		scrollTrigger: {
			trigger:inview_event,
			start: 'center bottom',//要素の基準値とブラウザの画面値
		end: 'bottom top',
		}
	}),
	ScrollTrigger.create({

		trigger: inview_event,
		start: 'center bottom',//要素の基準値とブラウザの画面値
		end: 'bottom top',
		id: inview_event+1,
		once: true,
		toggleClass: {
		  targets: inview_event,
		  className: 'event-on',
		}
	  })
});


const ttl__clips = document.querySelectorAll('.sectionTitle');

ttl__clips.forEach((ttl__clip, index) => {
  gsap.to(ttl__clip, {
    scrollTrigger: {
      trigger: ttl__clip,
      start: 'top-=100 center+=100',
      end: 'top top-=100',
    }
  });

  ScrollTrigger.create({
    trigger:ttl__clip,
    id: index+1,
    start: 'top center+=300',
    end: 'top top-=100',
    once: true,
    toggleClass: {
      targets: ttl__clip,
      className: 'slid__open',
    },
  });
});




/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
検索の部分
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
document.addEventListener('DOMContentLoaded', function() {
		//カテゴリ選択選択
	const search_area = document.querySelectorAll(".searchArea");
	if( search_area !== null){
		const cat_select_elem = document.getElementById('cat-select');
    cat_select_elem.choices = new Choices(
		cat_select_elem,
      {allowHTML: true,
		editItems: false,
		placeholder: true,
		placeholderValue: 'カテゴリを選択してください',
		searchPlaceholderValue: null,
        removeItemButton: true,
		noChoicesText: '選択されていません',
    itemSelectText: '選択してください',
	shouldSort: false,
      },
    );

	//エリア選択
    var area_select_elem = document.getElementById('area-select');
    area_select_elem.choices = new Choices(
		area_select_elem,
      {allowHTML: true,
		editItems: false,
		placeholder: true,
		placeholderValue: 'エリアを選択してください',
		searchPlaceholderValue: null,
        removeItemButton: true,
		noChoicesText: '選択されていません',
    itemSelectText: '選択してください',
	shouldSort: false,
      },
    );






const choices = document.querySelectorAll('.choices__input');

choices.forEach(elem => {
	elem.readOnly = true ;
});

}
});



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

document.addEventListener('DOMContentLoaded', function () {

	document.querySelector('.sp_btn').addEventListener('click', function () {
	document.documentElement.classList.toggle('spmenu-open');
	});
	//メニューの中クリックしたらとじる
	document.querySelector('.spNavi .sp_btn').addEventListener('click', function () {
	document.documentElement.classList.remove("spmenu-open")
	});

	//メニューの中クリックしたらとじる
	document.addEventListener("click", (event) => {
		if (document.documentElement.classList.contains('spmenu-open') == true) {
			if (!$(event.target).closest(".spNavi").length && !$(event.target).closest(".header").length) {
			document.documentElement.classList.remove("spmenu-open");
			}
		}
	})
})



/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
*グローバル子メニュー
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

const gnavilinks = document.querySelectorAll(".globalNavi-links");

gnavilinks.forEach(function(element) {
let ulElements = element.getElementsByTagName("ul");
Array.prototype.forEach.call(ulElements, function (element) {
let thisParent = element.parentNode;
if(thisParent){
thisParent.classList.add("menu-item-has-children");
let　linksurl = thisParent.querySelector("a").href;
let linkstxt = thisParent.querySelector("a").textContent;

let elementWidth = thisParent.clientWidth;
let elementPositionLeft = thisParent.getBoundingClientRect().left;
let windowWidth = document.documentElement.clientWidth;

console.log(elementPositionLeft);
console.log(windowWidth);
if(elementPositionLeft + 400 >windowWidth ){
	thisParent.classList.add("rightmode");
}
if (linksurl) {
element.outerHTML = '<div class="globalNavi-child"><p class="globalNavi-child-index"><a href="' + linksurl + '">' + linkstxt + '一覧</p>' + element.outerHTML + '</div>';
}else{
element.outerHTML = '<div class="globalNavi-child">' + element.outerHTML + '</div>';
}
}

});
});



/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
* back_to_top
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
const pagetop = document.querySelector('.backtotop');
const yws_pagetop = function () {
if (window.pageYOffset > 400) {
pagetop.classList.add("backtotop-visible")
} else {
pagetop.classList.remove("backtotop-visible")
}
};
window.addEventListener("load", yws_pagetop);
window.addEventListener("scroll", yws_pagetop);
pagetop.addEventListener('click', (e) => {
e.preventDefault();
window.scroll({
top: 0,
behavior: 'smooth'
})
});


/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
* smooth-scroll function
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
let smoothScrollOptions = {
	speed: 300,//1000px進むスピード
	easing: 'easeInOutCubic',//イージング
	offset: 0,//停止位置
	updateURL: false
  };

  let scroll = new smoothScroll('a[href*="#"]', smoothScrollOptions);


/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
スマホのみTEL有効
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/

var agent = navigator.userAgent;
if (agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1) {
window.addEventListener('DOMContentLoaded', function(){
if (!isPhone())
return;
const actionTarget = document.querySelectorAll('span[data-action=call]');
for (let i = 0; i < actionTarget .length; i++){
actionTarget [i].outerHTML = '<a href="tel:' + actionTarget [i].dataset.tel + '">' + actionTarget [i].outerHTML + '</a>';
}
});
function isPhone() {
return (navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('Android') > 0);
}
}


/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
ヘッダーのサーチ
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
window.addEventListener('load', function () {
//開くボタンを押した時には
const search_wrap = document.querySelector("#searchWrap");
const search_text = document.querySelector(".search-text");
const search_openbtn = document.querySelector(".header-search");
search_openbtn.addEventListener('click', function () {
search_wrap.classList.add('panelactive');
search_text.focus();
})

//閉じるボタンを押した時には
const search_closebtn = document.querySelector(".searchWrap-closeBtn");

search_closebtn.addEventListener('click', function () {
search_wrap.classList.remove('panelactive')
})
})

/**ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
SPメニューのアコーディオン
ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー**/
/* slideUp, slideDown, slideToggle関数を定義 */
// 要素をスライドしながら非表示にする関数(jQueryのslideUpと同じ)
const slideUp = (el, duration = 300) => {
el.style.height = el.offsetHeight + "px";
el.offsetHeight;
el.style.transitionProperty = "height, margin, padding";
el.style.transitionDuration = duration + "ms";
el.style.transitionTimingFunction = "ease";
el.style.overflow = "hidden";
el.style.height = 0;
el.style.paddingTop = 0;
el.style.paddingBottom = 0;
el.style.marginTop = 0;
el.style.marginBottom = 0;
setTimeout(() => {
el.style.display = "none";
el.style.removeProperty("height");
el.style.removeProperty("padding-top");
el.style.removeProperty("padding-bottom");
el.style.removeProperty("margin-top");
el.style.removeProperty("margin-bottom");
el.style.removeProperty("overflow");
el.style.removeProperty("transition-duration");
el.style.removeProperty("transition-property");
el.style.removeProperty("transition-timing-function");
el.classList.remove("is-open");
}, duration);
};

// 要素をスライドしながら表示する関数(jQueryのslideDownと同じ)
const slideDown = (el, duration = 300) => {
el.classList.add("is-open");
el.style.removeProperty("display");
let display = window.getComputedStyle(el).display;
if (display === "none") {
display = "block";
}
el.style.display = display;
let height = el.offsetHeight;
el.style.overflow = "hidden";
el.style.height = 0;
el.style.paddingTop = 0;
el.style.paddingBottom = 0;
el.style.marginTop = 0;
el.style.marginBottom = 0;
el.offsetHeight;
el.style.transitionProperty = "height, margin, padding";
el.style.transitionDuration = duration + "ms";
el.style.transitionTimingFunction = "ease";
el.style.height = height + "px";
el.style.removeProperty("padding-top");
el.style.removeProperty("padding-bottom");
el.style.removeProperty("margin-top");
el.style.removeProperty("margin-bottom");
setTimeout(() => {
el.style.removeProperty("height");
el.style.removeProperty("overflow");
el.style.removeProperty("transition-duration");
el.style.removeProperty("transition-property");
el.style.removeProperty("transition-timing-function");
}, duration);
};

// 要素をスライドしながら交互に表示/非表示にする関数(jQueryのslideToggleと同じ)
const slideToggle = (el, duration = 300) => {
if (window.getComputedStyle(el).display === "none") {
return slideDown(el, duration);
} else {
return slideUp(el, duration);
}
};

/*  DOM操作  *********************/

// アコーディオンを全て取得
const accordions = document.querySelectorAll(".spNavi-links");
// 取得したアコーディオンをArrayに変換(IE対策)
const accordionsArr = Array.prototype.slice.call(accordions);

accordions.forEach(function(element) {
let ulElements = element.getElementsByTagName("ul");
Array.prototype.forEach.call(ulElements, function (element) {
element.parentNode.classList.add("menu-item-has-children");


element.previousElementSibling.insertAdjacentHTML('afterend','<span class="accordionBtn"><i class="fa-solid fa-plus"></i></span>');

});
});



accordionsArr.forEach((accordion) => {
// Triggerを全て取得
const accordionTriggers = accordion.querySelectorAll(".menu-item-has-children");
// TriggerをArrayに変換(IE対策)
const accordionTriggersArr = Array.prototype.slice.call(accordionTriggers);

accordionTriggersArr.forEach((trigger) => {
// <i>アイコンでは反応しないように
trigger.querySelector("i").style.pointerEvents =   "none";
//accordionBtnクリックイベントを付与
trigger.querySelector(".accordionBtn").addEventListener("click", (e) => {
accordionTriggersArr.forEach((trigger) => {
// クリックしたアコーディオン以外を全て閉じる
if (trigger !== e.target.parentElement) {
trigger.classList.remove("open");
const openedContent = trigger.querySelector("ul");
slideUp(openedContent);
}
});

// '.open'クラスを付与or削除
trigger.classList.toggle("open");
// 開閉させる要素を取得
const content = trigger.querySelector("ul");
// 要素を展開or閉じる
slideToggle(content);
},false);
});
});
