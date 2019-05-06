
$(document).ready(function(){
	let maxWidth = 755
	let magelan = $('.filter-block')

	let displayWidth
	let magelanYB
	let magelanYT
	let magelanWidth
	let magelanHeight

	let maxYT
	let maxYB
	let maxHeight

	function setter()
	{
		displayWidth = $(window).width()
		magelanYT = magelan.offset().top
		magelanYB = magelan.offset().top+magelan.height()
		magelanWidth = magelan.parent().width()
		magelanHeight = magelan.height()

		maxYT = $('.product-block').offset().top
		maxYB = $('.product-block').offset().top+$('.product-block').height()
		maxHeight = $('.product-block').height()
	}

	function fly(scroll)
	{
		if(displayWidth>maxWidth){
			if(magelanHeight<maxHeight){
				if(scroll.scrollTop()>maxYT && scroll.scrollTop()<maxYB && scroll.scrollTop()+magelanHeight < maxYB-140)
					magelan.removeClass('bottom-magelan').addClass('fixed-magelan').css({'width':magelanWidth+'px'})
				else if(scroll.scrollTop()+magelanHeight > maxYB-140)
					magelan.removeClass('fixed-magelan').addClass('bottom-magelan')
				else
					magelan.removeClass('fixed-magelan')
			}
		}
	}

	setter()

	//resizer
	$(window).on('resize',function(){
		setter()
		magelan.css({'width':magelanWidth+'px'})
		magelan.removeClass('fixed-magelan').removeClass('bottom-magelan')
	})
	//scroller
	$(window).on('scroll',function(){
		setter()
		fly($(this))
	})

	magelan.on('click','.btn-link',function(){
		setTimeout(function() {

			setter()
			if(magelanYB>maxYB){
				magelan.removeClass('fixed-magelan').addClass('bottom-magelan')
			}

		}, 300);
	})

})