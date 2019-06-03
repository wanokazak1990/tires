$(document).ready(function(){
	let menu = $('.top-menu')
	let topMenu = menu.offset().top
	let heightMenu = menu.height()

		if($(window).width()<800)
		{
			menu.css({'width':($('body').width()+15)+'px'}).addClass('fixed-menu')
		}
		
		$(window).on('resize',function(){
			if($(window).width()<800)
			{
				menu.css({'width':($('body').width()+15)+'px'}).addClass('fixed-menu')
			}
		})
		
		$(window).on('scroll',function(){
			if($(window).width()>800)
			{
				let scroll = $(this)
				if(scroll.scrollTop()>topMenu+heightMenu)
					menu.
						css({'width':($('body').width()+15)+'px'}).
						addClass('fixed-menu')
				else
					menu.
						css({'width':($('body').width())+'px'}).
						removeClass('fixed-menu')
			}
		})

})