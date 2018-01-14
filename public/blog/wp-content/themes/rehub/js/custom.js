/*
	Author: Igor Sunzharovskyi.
	Author URI: http://sizam-design.com/
*/


/****** Helper JS *****/

/* hover Intent r7 */
(function($){$.fn.hoverIntent=function(handlerIn,handlerOut,selector){var cfg={interval:100,sensitivity:7,timeout:0};if(typeof handlerIn==="object"){cfg=$.extend(cfg,handlerIn)}else if($.isFunction(handlerOut)){cfg=$.extend(cfg,{over:handlerIn,out:handlerOut,selector:selector})}else{cfg=$.extend(cfg,{over:handlerIn,out:handlerIn,selector:handlerOut})}var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).off("mousemove.hoverIntent",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).on("mousemove.hoverIntent",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).off("mousemove.hoverIntent",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover},cfg.selector)}})(jQuery);
/* equalHeightColumns.js 1.2, https://github.com/PaulSpr/jQuery-Equal-Height-Columns */
(function(e){e.fn.equalHeightColumns=function(t){defaults={minWidth:-1,maxWidth:99999,setHeightOn:"min-height",defaultVal:0,equalizeRows:false,checkHeight:"height"};var n=e(this);t=e.extend({},defaults,t);var r=function(){var r=e(window).width();var i=Array();if(t.minWidth<r&&t.maxWidth>r){var s=0;var o=0;var u=0;n.css(t.setHeightOn,t.defaultVal);n.each(function(){if(t.equalizeRows){var n=e(this).position().top;if(n!=u){if(i.length>0){e(i).css(t.setHeightOn,o);o=0;i=[]}u=e(this).position().top}i.push(this)}s=e(this)[t.checkHeight]();if(s>o){o=s}});if(!t.equalizeRows){n.css(t.setHeightOn,o)}else{e(i).css(t.setHeightOn,o)}}else{n.css(t.setHeightOn,t.defaultVal)}};r();e(window).resize(r);n.find("img").load(r);if(typeof t.afterLoading!=="undefined"){n.find(t.afterLoading).load(r)}if(typeof t.afterTimeout!=="undefined"){setTimeout(function(){r();if(typeof t.afterLoading!=="undefined"){n.find(t.afterLoading).load(r)}},t.afterTimeout)}}})(jQuery);
!function(t){function e(){var e,i,n={height:a.innerHeight,width:a.innerWidth};return n.height||(e=r.compatMode,(e||!t.support.boxModel)&&(i="CSS1Compat"===e?f:r.body,n={height:i.clientHeight,width:i.clientWidth})),n}function i(){return{top:a.pageYOffset||f.scrollTop||r.body.scrollTop,left:a.pageXOffset||f.scrollLeft||r.body.scrollLeft}}function n(){var n,l=t(),r=0;if(t.each(d,function(t,e){var i=e.data.selector,n=e.$element;l=l.add(i?n.find(i):n)}),n=l.length)for(o=o||e(),h=h||i();n>r;r++)if(t.contains(f,l[r])){var a,c,p,s=t(l[r]),u={height:s.height(),width:s.width()},g=s.offset(),v=s.data("inview");if(!h||!o)return;g.top+u.height>h.top&&g.top<h.top+o.height&&g.left+u.width>h.left&&g.left<h.left+o.width?(a=h.left>g.left?"right":h.left+o.width<g.left+u.width?"left":"both",c=h.top>g.top?"bottom":h.top+o.height<g.top+u.height?"top":"both",p=a+"-"+c,v&&v===p||s.data("inview",p).trigger("inview",[!0,a,c])):v&&s.data("inview",!1).trigger("inview",[!1])}}var o,h,l,d={},r=document,a=window,f=r.documentElement,c=t.expando;t.event.special.inview={add:function(e){d[e.guid+"-"+this[c]]={data:e,$element:t(this)},l||t.isEmptyObject(d)||(l=setInterval(n,250))},remove:function(e){try{delete d[e.guid+"-"+this[c]]}catch(i){}t.isEmptyObject(d)&&(clearInterval(l),l=null)}},t(a).bind("scroll resize scrollstop",function(){o=h=null}),!f.addEventListener&&f.attachEvent&&f.attachEvent("onfocusin",function(){h=null})}(jQuery);
/**
 * jquery.dlmenu.js v1.0.1
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
(function($,window,undefined){'use strict';var Modernizr=window.Modernizr,$body=$('body');$.DLMenu=function(options,element){this.$el=$(element);this._init(options)};$.DLMenu.defaults={animationClasses:{classin:'dl-animate-in-5',classout:'dl-animate-out-5'},onLevelClick:function(el,name){return false},onLinkClick:function(el,ev){return false}};$.DLMenu.prototype={_init:function(options){this.options=$.extend(true,{},$.DLMenu.defaults,options);this._config();var animEndEventNames={'WebkitAnimation':'webkitAnimationEnd','OAnimation':'oAnimationEnd','msAnimation':'MSAnimationEnd','animation':'animationend'},transEndEventNames={'WebkitTransition':'webkitTransitionEnd','MozTransition':'transitionend','OTransition':'oTransitionEnd','msTransition':'MSTransitionEnd','transition':'transitionend'};this.animEndEventName=animEndEventNames[Modernizr.prefixed('animation')]+'.dlmenu';this.transEndEventName=transEndEventNames[Modernizr.prefixed('transition')]+'.dlmenu',this.supportAnimations=Modernizr.cssanimations,this.supportTransitions=Modernizr.csstransitions;this._initEvents()},_config:function(){this.open=false;this.$trigger=this.$el.children('.dl-trigger');this.$menu=this.$el.children('ul.dl-menu');this.$menuitems=this.$menu.find('li:not(.dl-back)');this.$el.find('ul.dl-submenu').prepend('<li class="dl-back"><a href="#">'+translation.back+'</a></li>');this.$back=this.$menu.find('li.dl-back')},_initEvents:function(){var self=this;this.$trigger.on('click.dlmenu',function(){if(self.open){self._closeMenu()}else{self._openMenu()}return false});this.$menuitems.on('click.dlmenu',function(event){event.stopPropagation();var $item=$(this),$submenu=$item.children('ul.dl-submenu');if($submenu.length>0){var $flyin=$submenu.clone().css('opacity',0).insertAfter(self.$menu),onAnimationEndFn=function(){self.$menu.off(self.animEndEventName).removeClass(self.options.animationClasses.classout).addClass('dl-subview');$item.addClass('dl-subviewopen').parents('.dl-subviewopen:first').removeClass('dl-subviewopen').addClass('dl-subview');$flyin.remove()};setTimeout(function(){$flyin.addClass(self.options.animationClasses.classin);self.$menu.addClass(self.options.animationClasses.classout);if(self.supportAnimations){self.$menu.on(self.animEndEventName,onAnimationEndFn)}else{onAnimationEndFn.call()}self.options.onLevelClick($item,$item.children('a:first').text())});return false}else{self.options.onLinkClick($item,event)}});this.$back.on('click.dlmenu',function(event){var $this=$(this),$submenu=$this.parents('ul.dl-submenu:first'),$item=$submenu.parent(),$flyin=$submenu.clone().insertAfter(self.$menu);var onAnimationEndFn=function(){self.$menu.off(self.animEndEventName).removeClass(self.options.animationClasses.classin);$flyin.remove()};setTimeout(function(){$flyin.addClass(self.options.animationClasses.classout);self.$menu.addClass(self.options.animationClasses.classin);if(self.supportAnimations){self.$menu.on(self.animEndEventName,onAnimationEndFn)}else{onAnimationEndFn.call()}$item.removeClass('dl-subviewopen');var $subview=$this.parents('.dl-subview:first');if($subview.is('li')){$subview.addClass('dl-subviewopen')}$subview.removeClass('dl-subview')});return false})},closeMenu:function(){if(this.open){this._closeMenu()}},_closeMenu:function(){var self=this,onTransitionEndFn=function(){self.$menu.off(self.transEndEventName);self._resetMenu()};this.$menu.removeClass('dl-menuopen');this.$menu.addClass('dl-menu-toggle');this.$trigger.removeClass('dl-active');if(this.supportTransitions){this.$menu.on(this.transEndEventName,onTransitionEndFn)}else{onTransitionEndFn.call()}this.open=false},openMenu:function(){if(!this.open){this._openMenu()}},_openMenu:function(){var self=this;$body.off('click').on('click.dlmenu',function(){self._closeMenu()});this.$menu.addClass('dl-menuopen dl-menu-toggle').on(this.transEndEventName,function(){$(this).removeClass('dl-menu-toggle')});this.$trigger.addClass('dl-active');this.open=true},_resetMenu:function(){this.$menu.removeClass('dl-subview');this.$menuitems.removeClass('dl-subview dl-subviewopen')}};var logError=function(message){if(window.console){window.console.error(message)}};$.fn.dlmenu=function(options){if(typeof options==='string'){var args=Array.prototype.slice.call(arguments,1);this.each(function(){var instance=$.data(this,'dlmenu');if(!instance){logError("cannot call methods on dlmenu prior to initialization; "+"attempted to call method '"+options+"'");return}if(!$.isFunction(instance[options])||options.charAt(0)==="_"){logError("no such method '"+options+"' for dlmenu instance");return}instance[options].apply(instance,args)})}else{this.each(function(){var instance=$.data(this,'dlmenu');if(instance){instance._init()}else{instance=$.data(this,'dlmenu',new $.DLMenu(options,this))}})}return this}})(jQuery,window);
/**
 * PgwModal - Version 2.0
 *
 * Copyright 2014, Jonathan M. Piat
 * http://pgwjs.com - http://pagawa.com
 * 
 * Released under the GNU GPLv3 license - http://opensource.org/licenses/gpl-3.0
 */
(function(a){a.pgwModal=function(i){var c={};var g={mainClassName:"pgwModal",backdropClassName:"pgwModalBackdrop",maxWidth:500,titleBar:true,closable:true,closeOnEscape:true,closeOnBackgroundClick:true,closeContent:'<span class="pm-icon"></span>',loadingContent:"Loading in progress...",errorContent:"An error has occured. Please try again in a few moments."};if(typeof window.pgwModalObject!="undefined"){c=window.pgwModalObject}if((typeof i=="object")&&(!i.pushContent)){if(!i.url&&!i.target&&!i.content){throw new Error('PgwModal - There is no content to display, please provide a config parameter : "url", "target" or "content"')}c.config={};c.config=a.extend({},g,i);window.pgwModalObject=c}var k=function(){var o='<div id="pgwModalBackdrop"></div><div id="pgwModal"><div class="pm-container"><div class="pm-body"><span class="pm-close"></span><div class="pm-title"></div><div class="pm-content"></div></div></div></div>';a("body").append(o);a(document).trigger("PgwModal::Create");return true};var l=function(){a("#pgwModal .pm-title, #pgwModal .pm-content").html("");a("#pgwModal .pm-close").html("").unbind("click");return true};var f=function(){angular.element('body').injector().invoke(function($compile){var scope=angular.element($('#pgwModal .pm-content')).scope();$compile($('#pgwModal .pm-content'))(scope);scope.$digest()});return true};var d=function(o){a("#pgwModal .pm-content").html(o);if(c.config.angular){f()}m();a(document).trigger("PgwModal::PushContent");return true};var m=function(){a("#pgwModal, #pgwModalBackdrop").show();var q=a(window).height();var o=a("#pgwModal .pm-body").height();var p=Math.round((q-o)/3);if(p<=0){p=0}a("#pgwModal .pm-body").css("margin-top",p);return true};var h=function(){return c.config.modalData};var e=function(){var o=a('<div style="width:50px;height:50px;overflow:auto"><div></div></div>').appendTo("body");var q=o.children();if(typeof q.innerWidth!="function"){return 0}var p=q.innerWidth()-q.height(90).innerWidth();o.remove();return p};var b=function(){return a("body").hasClass("pgwModalOpen")};var n=function(){a("#pgwModal, #pgwModalBackdrop").removeClass().hide();a("body").css("padding-right","").removeClass("pgwModalOpen");l();a(window).unbind("resize.PgwModal");a(document).unbind("keyup.PgwModal");a("#pgwModal").unbind("click.PgwModalBackdrop");try{delete window.pgwModalObject}catch(o){window.pgwModalObject=undefined}a(document).trigger("PgwModal::Close");return true};var j=function(){if(a("#pgwModal").length==0){k()}else{l()}a("#pgwModal").removeClass().addClass(c.config.mainClassName);a("#pgwModalBackdrop").removeClass().addClass(c.config.backdropClassName);if(!c.config.closable){a("#pgwModal .pm-close").html("").unbind("click").hide()}else{a("#pgwModal .pm-close").html(c.config.closeContent).click(function(){n()}).show()}if(!c.config.titleBar){a("#pgwModal .pm-title").hide()}else{a("#pgwModal .pm-title").show()}if(c.config.title){a("#pgwModal .pm-title").text(c.config.title)}if(c.config.maxWidth){a("#pgwModal .pm-body").css("max-width",c.config.maxWidth)}if(c.config.url){if(c.config.loadingContent){a("#pgwModal .pm-content").html(c.config.loadingContent)}var o={url:i.url,success:function(q){d(q)},error:function(){a("#pgwModal .pm-content").html(c.config.errorContent)}};if(c.config.ajaxOptions){o=a.extend({},o,c.config.ajaxOptions)}a.ajax(o)}else{if(c.config.target){d(a(c.config.target).html())}else{if(c.config.content){d(c.config.content)}}}if(c.config.closeOnEscape&&c.config.closable){a(document).bind("keyup.PgwModal",function(q){if(q.keyCode==27){n()}})}if(c.config.closeOnBackgroundClick&&c.config.closable){a("#pgwModal").bind("click.PgwModalBackdrop",function(s){var r=a(s.target).hasClass("pm-container");var q=a(s.target).attr("id");if(r||q=="pgwModal"){n()}})}a("body").addClass("pgwModalOpen");var p=e();if(p>0){a("body").css("padding-right",p)}a(window).bind("resize.PgwModal",function(){m()});a(document).trigger("PgwModal::Open");return true};if((typeof i=="string")&&(i=="close")){return n()}else{if((typeof i=="string")&&(i=="reposition")){return m()}else{if((typeof i=="string")&&(i=="getData")){return h()}else{if((typeof i=="string")&&(i=="isOpen")){return b()}else{if((typeof i=="object")&&(i.pushContent)){return d(i.pushContent)}else{if(typeof i=="object"){return j()}}}}}}}})(window.Zepto||window.jQuery);
/*Fitvid http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/ */
(function(e){"use strict";e.fn.fitVids=function(t){var n={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var r=document.head||document.getElementsByTagName("head")[0];var i=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";var s=document.createElement("div");s.innerHTML='<p>x</p><style id="fit-vids-style">'+i+"</style>";r.appendChild(s.childNodes[1])}if(t){e.extend(n,t)}return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=".fitvidsignore";if(n.ignore){r=r+", "+n.ignore}var i=e(this).find(t.join(","));i=i.not("object object");i=i.not(r);i.each(function(){var t=e(this);if(t.parents(r).length>0){return}if(this.tagName.toLowerCase()==="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}if(!t.css("height")&&!t.css("width")&&(isNaN(t.attr("height"))||isNaN(t.attr("width")))){t.attr("height",9);t.attr("width",16)}var n=this.tagName.toLowerCase()==="object"||t.attr("height")&&!isNaN(parseInt(t.attr("height"),10))?parseInt(t.attr("height"),10):t.height(),i=!isNaN(parseInt(t.attr("width"),10))?parseInt(t.attr("width"),10):t.width(),s=n/i;if(!t.attr("id")){var o="fitvid"+Math.floor(Math.random()*999999);t.attr("id",o)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",s*100+"%");t.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto)


/***** BASIC CUSTOM JS *****/


jQuery(document).ready(function($) {
   'use strict';

   var res_nav = $("header .top_menu").html();
   $("header .responsive_nav_wrap").append(res_nav);
   $( 'header .responsive_nav_wrap ul.menu' ).wrap(function() {
      return "<div id='dl-menu' class='dl-menuwrapper'></div>";
   });
   $( 'header .responsive_nav_wrap ul.menu' ).attr('class', 'dl-menu');
   $( "header .responsive_nav_wrap #dl-menu" ).prepend( "<button class='dl-trigger'><i class='fa fa-bars'></i></button>" );
   $( "header .responsive_nav_wrap #dl-menu" ).find('.sub-menu').attr('class', 'dl-submenu');

   /* responsive menu init */
   $( '#dl-menu' ).dlmenu();

   /* gallery hover */
	$(".gallery-pics li").hover(function(){
      $(this).children('.gp-overlay').stop(true, true).fadeIn(500);
   }, function(){
      $(this).children('.gp-overlay').stop(true, true).fadeOut(500);
   });

   /* scroll to # */
   $('a[href^="#"].rehub_scroll, #c_menu a').bind('click.smoothscroll',function (e) {
      e.preventDefault();
      var target = this.hash,
      $target = $(target);
      $('html, body').stop().animate({
         'scrollTop': $target.offset().top
      }, 500, 'swing', function () {
         window.location.hash = target;
      });
   });
  
   /* custom inputs */
   if ($("div,p").hasClass("input_styled")) {
      $(".input_styled input").customInput();
   } 	
	
   /* tabs */
   $('.tabs-menu').delegate('li:not(.current)', 'click', function() {
      $(this).addClass('current').siblings().removeClass('current').parents('.tabs').find('.tabs-item').hide().eq($(this).index()).fadeIn(700);
   })
   $('.tabs-menu li:first-child').trigger('click');

   $('.wpsm-tabs').each(function(){
      $(this).tabs();
   }); 

   /*bar*/  
   $('.wpsm-bar').each(function(){
      $(this).find('.wpsm-bar-bar').animate({ width: $(this).attr('data-percent') }, 1500 );
   });   

   /* accordition */
   $(".wpsm-accordion").each(function(){
      $(this).accordion({heightStyle: "content" });
   });

   /* toggle */
   $("h3.wpsm-toggle-trigger").click(function(){
      $(this).toggleClass("active").next().slideToggle("fast");return false;
   });

   

   /* review woo tabs */
   $('.rehub_woo_tabs_menu').delegate('li:not(.current)', 'click', function() {
      $(this).addClass('current').siblings().removeClass('current').parents('.rehub_woo_review').find('.rehub_woo_review_tabs').hide().eq($(this).index()).fadeIn(700);
   })
   $('.rehub_woo_tabs_menu li:first-child').trigger('click');
   $('.btn_offer_block.choose_offer_woo').click(function(event){		
		event.preventDefault();
		$('.rehub_woo_tabs_menu li.woo_deals_tab').trigger('click');
	});
    
  	/* widget dropdown */
  	$('.cat_widget_custom .children').parent().find('a').append('<span class="drop_list">&nbsp; +</span>');  
	   $('.tabs-item .drop_list').click(function() {
       $(this).parent().parent().find('.children').slideToggle();
        return false
    });	

    /* offer archive dropdown */  
   $('.r_offer_details #r_show_hide').click(function() {
      $(this).parent().find('p').slideToggle();
      return false
    });     	

   // Coupon Modal
   $( '.rehub_offer_coupon.masked_coupon:not(.expired_coupon)' ).live("click", function(e){
      var $this = $(this);
      var codeid = $this.data('codeid');
      var couponpage = window.location.pathname + "?codeid=" + codeid;
      var couponcode = $this.data('clipboard-text'); 
      var destination = $this.data('dest'); 
      if( destination != "" || destination != "#" ){
         window.location.href= destination;
      }
      window.open(couponpage);
   });

   function GetURLParameter(sParam){
      var sPageURL = window.location.search.substring(1);
      var sURLVariables = sPageURL.split('&');
      for (var i = 0; i < sURLVariables.length; i++) 
      {
         var sParameterName = sURLVariables[i].split('=');
         if (sParameterName[0] == sParam) 
         {
            return sParameterName[1];
         }
      }
   }  

   var coupontrigger = GetURLParameter("codeid");
   if(coupontrigger){
      var $change_code = $(".rehub_offer_coupon.masked_coupon:not(.expired_coupon)[data-codeid='" + coupontrigger +"']");
      var couponcode = $change_code.data('clipboard-text'); 
      $change_code.removeClass('masked_coupon').addClass('not_masked_coupon').html( '<i class="fa fa-scissors fa-rotate-180"></i><span class="coupon_text">'+ couponcode +'</span>' );                
      $.pgwModal({
         url: translation.ajax_url + "?action=ajax_code&codeid=" + coupontrigger,
         titleBar: false,
         ajaxOptions : {
            success : function(response) {
               if (response) {
                  $.pgwModal({ pushContent: response });
               } else {
                  $.pgwModal({ pushContent: 'An error has occured' });
               }
            }
         }
      });
   };

  //Coupons copy code function
  $('.rehub_offer_coupon:not(.expired_coupon)').each(function(){
    ZeroClipboard.config( { swfPath: translation.templateurl+"/js/zeroclipboard/ZeroClipboard.swf" } );
    var $this = $(this);
    var couponcode = $this.data('clipboard-text');    
    var client = new ZeroClipboard( $this );
    client.on( 'ready', function(event) {
      //console.log( 'movie is loaded' );
      client.on( 'copy', function(event) {
        event.clipboardData.setData('text/plain', couponcode);
      });  
      client.on( 'aftercopy', function(event) {
        $this.find('i.fa').replaceWith( '<i class="fa fa-check-square"></i>' );
        $this.find('i.fa').fadeOut( 2500, function() {
          $this.find('i.fa').replaceWith( '<i class="fa fa-scissors fa-rotate-180"></i>' ).fadeIn('slow');
        });
      });
    });  
    client.on( 'error', function(event) {
      ZeroClipboard.destroy();
    });
  });

   //Infinite scroll js
   $('.inf_scr_wrap_auto').each(function() {
      var $this = $(this);
      $this.infinitescroll({
         navSelector: ".more_post",
         nextSelector: ".more_post a",
         itemSelector: ".inf_scr_item",
         loading: {
            finishedMsg: '<em>' + translation.fin + '</em>',
            msgText: '',
            img: translation.templateurl + '/images/preload.gif',
         },        
      });      
   }); 

   if (translation.target_blank == 'yes'){
      $(".btn_offer_block").not('a[href*="#aff-link-list"]').attr('target','_blank');
      $(".single-product .product-type-external .single_add_to_cart_button").attr('target','_blank');
   }

   if (translation.rel_nofollow == 'yes'){
      $(".btn_offer_block").not('a[href*="#aff-link-list"]').attr('rel','nofollow');
   } 

   if (translation.tracking == 'yes'){
      $(".btn_offer_block").on('click', function(){
         ga('send', 'event', 'Offer', 'click on offer button', document.location.href);
      });
   }   

   //fix for VC responsive sidebar
   $('.vc_col-sm-4, .vc_col-sm-3').find('.sidebar').parent().parent().parent().addClass('vc_rehub_container'); 

   $('.eq_height_post').equalHeightColumns({
      minWidth: 767,
      afterTimeout: 500,
      checkHeight: 'innerHeight'
   });   

});

/* menu */
showNav = function(){'use strict'; jQuery(this).find('> .sub-menu').slideDown(); }
hideNav = function(){'use strict'; jQuery(this).find('> .sub-menu').slideUp();}
jQuery('nav.top_menu > ul > li.menu-item-has-children').hoverIntent({
	sensitivity: 7, // number = sensitivity threshold (must be 1 or higher)
	interval: 100, // number = milliseconds of polling interval
	over: showNav, // function = onMouseOver callback (required)
	timeout: 120, // number = milliseconds delay before onMouseOut function call
	out: hideNav // function = onMouseOut callback (required)
})

// User Rate functions
jQuery(document).on('mousemove', '.user-rate-active' , function (e) {
    var rated = jQuery(this);
    if( rated.hasClass('rated-done') ){
      return false;
    }
    if (!e.offsetX){
      e.offsetX = e.clientX - jQuery(e.target).offset().left;
    }
    var offset = e.offsetX + 4;
    if (offset > 100) {
      offset = 100;
    }
    rated.find('.user-rate-image span').css('width', offset + '%');
    var score = Math.floor(((offset / 10) * 5)) / 10;
    if (score > 5) {
      score = 5;
    }
});
jQuery(document).on('click', '.user-rate-active' , function (e) {
    var rated = jQuery(this);
    if( rated.hasClass('rated-done') ){
      return false;
    }
    var gg = rated.find('.user-rate-image span').width();
    rated.find('.user-rate-image').hide();
    rated.append('<span class="rehub-rate-load"></span>');
    if (gg > 100) {
      gg = 100;
    }
    ngg = (gg*5)/100;
    var post_id = rated.attr('data-id');
    var numVotes = rated.parent().find('.userrating-count').text();
    jQuery.post(rehub.ajaxurl, { action:'rehub_rate_post' , post:post_id , value:ngg}, function(data) {
    var post_rateed = '.rate-post-'+post_id;
      jQuery( post_rateed ).addClass('rated-done').attr('data-rate',gg);
      rated.find('.user-rate-image span').width(gg+'%');
      
      jQuery(".rehub-rate-load").fadeOut(function () {

        rated.parent().find('.userrating-score').html( ngg );
        
        if( (jQuery(rated.parent().find('.userrating-count'))).length > 0 ){
          numVotes =  parseInt(numVotes)+1;
          rated.parent().find('.userrating-count').html(numVotes);
        }else{
          rated.parent().find('small').hide();
        }
        rated.parent().find('strong').html(rehub.your_rating);
        
        rated.find('.user-rate-image').fadeIn();
      });
    }, 'html');
    return false;
});
jQuery(document).on('mouseleave', '.user-rate-active' , function (e) {
    var rated = jQuery(this);
    if( rated.hasClass('rated-done') ){
      return false;
    }
    var post_rate = rated.attr('data-rate');
    rated.find(".user-rate-image span").css('width', post_rate + '%');
});

// Rate bar annimation
jQuery(function($){
'use strict';	
  $(document).ready(function(){   
    $('.rate_bar_wrap').bind('inview', function(event, visible) {
      if (visible) {
        $('.rate-bar').each(function(){
         $(this).find('.rate-bar-bar').animate({ width: $(this).attr('data-percent') }, 1500 );
         $('.rate_bar_wrap').unbind('inview');
        });
      }
    });

    $('.rate-line').bind('inview', function(event, visible) {
      if (visible) {
        $('.rate-line .line').each(function(){
         $(this).find('.filled').animate({ width: $(this).attr('data-percent') }, 1500 );
         $('.rate-line').unbind('inview');
        });
      }
    });

    $('.top-rating-item-circle-view').bind('inview', function(event, visible) {
      if (visible) {
        $('.radial-progress').each(function(){
          $(this).find('.circle .mask.full, .circle .fill:not(.fix)').animate({  borderSpacing: $(this).attr('data-rating')*18 }, {
              step: function(now,fx) {
                $(this).css('-webkit-transform','rotate('+now+'deg)'); 
                $(this).css('-moz-transform','rotate('+now+'deg)');
                $(this).css('transform','rotate('+now+'deg)');
              },
              duration:'slow'
          },'linear');

          $(this).find('.circle .fill.fix').animate({  borderSpacing: $(this).attr('data-rating')*36 }, {
              step: function(now,fx) {
                $(this).css('-webkit-transform','rotate('+now+'deg)'); 
                $(this).css('-moz-transform','rotate('+now+'deg)');
                $(this).css('transform','rotate('+now+'deg)');
              },
              duration:'slow'
          },'linear');                   


         $('.top-rating-item-circle-view').unbind('inview');
        });
      }
    });    

  });
});  
  

//Scroll To top
jQuery(window).scroll(function(){
'use strict';	
  if (jQuery(this).scrollTop() > 100) {
    jQuery('#topcontrol').css({bottom:"15px"});
  } else {
    jQuery('#topcontrol').css({bottom:"-100px"});
  }
});

//FOR VC ROW

var re_sizebg = function(){
   'use strict';
   jQuery('.vc_custom_row_width').each(function() {
   var ride = jQuery(this).data('bg-width');
   var ancenstor,parent;
   parent = jQuery(this).parent();
   if(ride=='container_width'){
      ancenstor = jQuery('.main-side').parent().parent();
   }
   else if(ride == 'window_width'){
      ancenstor = jQuery('html');
   }
   var al= parseInt( ancenstor.css('paddingLeft') );
   var ar= parseInt( ancenstor.css('paddingRight') )
   var w = al+ar + ancenstor.width();
   var bl = - ( parent.offset().left - ancenstor.offset().left );
   if ( bl > 0 ) { left = 0; }
   jQuery(this).css({'width': w,'margin-left': bl })
});
};
re_sizebg();
jQuery(window).load(function(){
   re_sizebg();
});
jQuery(window).resize(function(){
   re_sizebg();
});


jQuery(window).load(function() {

   //CAROUSELS

   var makesiteCarousel = function() {
      if(jQuery().carouFredSel) {

         jQuery('.sec_style_carousel').each(function() {
            var carousel = jQuery(this).find('.gallery-pics');
            carousel.carouFredSel({
               scroll: {
                  items: 1
               },
               responsive: true,
               auto: {
                  play: false
               },
               items: {
                  width: 200,  
                  visible   : {
                      min      : 1,
                      max      : 3
                  }
               },
               prev: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-prev");} 
               },
               next: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-next");}
               },
               width: "100%",
               height: "auto",        
               onCreate: function () {
                  jQuery(".sec_style_carousel").removeClass('loading');
               }         
            });
         });   

         jQuery('.photo_carousel').each(function() {
            var carousel = jQuery(this).find('.gallery-pics');
            carousel.carouFredSel({
               width: '100%',
               height: 'variable',
               responsive: true,
               scroll: {
                  items: 1
               },
               auto: {
                  play: false
               },               
               items: {
                  width: 172,
                  height: 'variable',
                  visible: {
                     min: 2,
                     max: 4
                  }
               },
               prev: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-prev");} 
               },
               next: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-next");}
               },
               onCreate: function () {
                  jQuery(".media_carousel").removeClass('loading');

               },  
            });
         });   

         jQuery('.best_from_cat_carousel').each(function() {
            var carousel = jQuery(this).find('.gallery-pics');
            carousel.carouFredSel({
               scroll: {
                  items: 1
               },
               responsive: true,
               auto: {
                  play: false
               },
               items: {
                  width: 172,   
                  visible   : {
                      min     : 2,
                      max     : 4
                  }
               },
               prev: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-prev");} 
               },
               next: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-next");}
               },
               width: "100%",
               height: "auto",
               onCreate: function () {
                  jQuery(".best_from_cat_carousel").removeClass('loading');
               },  
            });            
         });            

         jQuery('.home_carousel').each(function() {
            var carousel = jQuery(this).find('.carousel-block');
            carousel.carouFredSel({
               scroll: {
                  items: 1
               },
               responsive: true,
               auto: {
                  play: false
               },
               items: {
                  height: 'variable',
                  width: 290,  
                  visible   : {
                     min      : 1,
                     max      : 4
                  }
               },
               prev: {
                  button: '.prev'
               },
               next: {
                  button: '.next'
               },
               height: 'variable',
               width: "100%",
               onCreate: function () {
                  jQuery(".home_carousel").removeClass('loading');
               }
            });
         });   

         jQuery('.shop_carousel').each(function() {
            var carousel = jQuery(this).find('.gallery-pics');
            carousel.carouFredSel({
               scroll: {
                  items: 1,
               },
               responsive: true,
               auto: {
                  play: false
               },
               items: {
                  width: 218, 
                  visible   : {
                     min     : 1,
                     max     : 3
                  }
               },
               prev: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-prev");} 
               },
               next: {
                  button: function() {return jQuery(this).parent().parent().siblings(".carousel-next");}
               },
               width: "100%",
               onCreate: function () {
                  jQuery(".shop_carousel").removeClass('loading');
               }             
            });
         });

      }
   }   

   makesiteCarousel();

   var canSlide = true;

    // Setup a callback for the YouTube api to attach video event handlers
   window.onYouTubeIframeAPIReady = function(){
      // Iterate through all videos
      jQuery('.gallery_top_slider iframe').each(function(){
         var slider = jQuery('.gallery_top_slider');
         // Create a new player pointer; "this" is a DOMElement of the player's iframe
         var player = new YT.Player(this, {
            playerVars: {
               autoplay: 0
            }
         });
 
         // Watch for changes on the player
         player.addEventListener("onStateChange", function(state){
            switch(state.data)
            {
               // If the user is playing a video, stop the slider
               case YT.PlayerState.PLAYING:
                  slider.flexslider("stop");
                  canSlide = false;
                  break;
               // The video is no longer player, give the go-ahead to start the slider back up
               case YT.PlayerState.ENDED:
               case YT.PlayerState.PAUSED:
                  slider.flexslider("play");
                  canSlide = true;
                  break;
            }
         });
 
         jQuery(this).data('player', player);
      });
   }          

   //SLIDER
   var flexslidersiteInit = function() {
   if(jQuery().flexslider) {

      jQuery('.featured_slider').each(function() {
         var slider = jQuery(this);
         slider.flexslider({
            animation: "slide",
            selector: ".slides > .slide",
            slideshow: false,   
         });
      });

      jQuery('.blog_slider').each(function() {
         var slider = jQuery(this); 
         slider.flexslider({
            animation: "slide",
            smoothHeight: true,
            slideshow: false,
            start: function(slider) {
               slider.removeClass('loading');
               var first_height = jQuery('.blog_slider .slides li:last-child img').height();
               jQuery('.flex-viewport').height(first_height);
            }      
         });
      }); 
      
      jQuery('.gallery_top_slider').each(function() {
         var tag = document.createElement('script');
         tag.src = "//www.youtube.com/iframe_api";
         var firstScriptTag = document.getElementsByTagName('script')[0];
         firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);         
         var slider = jQuery(this); 
         slider.flexslider({
            animation: "fade",
            controlNav: "thumbnails",
            slideshow: false,
            video: true,
            //useCSS: false, 
            before: function(){                 
               if(!canSlide)
                  slider.flexslider("stop");
            },            
            start: function(slider) {
               slider.removeClass('loading');
               jQuery('.flex-control-thumbs img').each(function() {
                  var widththumb = jQuery(this).width();
                  jQuery(this).height(widththumb);
               });                
            }
         });
         slider.on("click", ".flex-prev, .flex-next, .flex-control-nav", function(){
            canSlide = true;
            jQuery('.gallery_top_slider iframe').each(function(){
               jQuery(this).data('player').pauseVideo();
            });
         });  
         jQuery(".play3").fitVids();          
      }); 

      jQuery('.main_slider').each(function() {
         var slider = jQuery(this);
         slider.flexslider({
            animation: "slide", 
            start: function(slider) {
               slider.removeClass('loading');
            }                
         });
      });

      jQuery('.re_thing_slider').each(function() {
         var slider = jQuery(this);
         slider.flexslider({
            animation: "slide", 
            start: function(slider) {
               slider.removeClass('loading');
            }                
         });
      });      

      jQuery('.flexslider').each(function() {
         var slider = jQuery(this);
         slider.flexslider({
            animation: "slide",     
         });
      });                        

   }}

   flexslidersiteInit();

   jQuery('.footer_widget').each(function() {
      jQuery(this).equalHeightColumns({
         minWidth: 767,
         afterTimeout: 500,
         checkHeight: 'innerHeight'
      });
   });    

}); 