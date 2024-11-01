(function($) {
	'use strict';

	$.cookie.raw = true;
	var $delay = tlp_popup_sub.load;
	var $session = tlp_popup_sub.session;
	var $ph = tlp_popup_sub.ph.toString()+'%';
	var $pw = tlp_popup_sub.pw.toString()+'%';
	$.removeCookie('tlp_popup_cookie');
	if($.cookie('tlp_popup_cookie') != 'tlppopupcookie'){
		setTimeout( function(){
			$(".tlp_popup").eq(0).trigger('click');
		  }  , $delay*1000 );
	}else{
		console.info($.cookie('tlp_popup_cookie'));
	}

	$(".tlp_popup").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: $pw,
		height		: $ph,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		beforeClose	: function(){
			ExpireCookie($session);
		}
	});
	$("#tlp_opoup_model").css('height',$('.fancybox-inner').innerHeight() + 'px');
})(jQuery);

function ExpireCookie(hours) {
	 var date = new Date();
	 var m = hours;
	 date.setTime(date.getTime() + (m * 60 * 60 * 1000));
	 jQuery.cookie("tlp_popup_cookie", "tlppopupcookie", { expires: date });
}
