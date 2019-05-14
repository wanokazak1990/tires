$(document).ready(function(){
	let menu = $('.top-menu')
	let topMenu = menu.offset().top
	let heightMenu = menu.height()

	$(window).on('scroll',function(){
		let scroll = $(this)
		if(scroll.scrollTop()>topMenu+heightMenu)
			menu.
				css({'width':($('body').width()+15)+'px'}).
				addClass('fixed-menu')
		else
			menu.
				css({'width':($('body').width())+'px'}).
				removeClass('fixed-menu')
	})
})