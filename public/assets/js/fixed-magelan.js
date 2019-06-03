
$(document).ready(function(){
	let maxWidth = 755
	let magelan = $('.filter-block')
	magelan.css('width',magelan.parent().width()+'px')
	magelan.parent().css('position','relative')
	let product = $('.product-block')

	magelan.on('click','.btn-link',function(){
		setTimeout(function() {


			product.css('min-height',magelan.height()+18+'px')
			if(magelan.offset().top+magelan.height()>product.offset().top+product.height())
			{
				magelan.removeClass('fixed-magelan')
				magelan.addClass('bottom-magelan')
			}


		}, 300);
	})

	$(window).on('scroll',function(){
		if($(window).width()>maxWidth)
		{
			let scroll = $(this).scrollTop()
			
			if(scroll<product.offset().top)
			{
				magelan.removeClass('fixed-magelan')
				magelan.removeClass('bottom-magelan')
			}

			else if(
				scroll>product.offset().top &&
				scroll+magelan.height()+130<product.offset().top+product.height() &&
				magelan.height()<product.height()

			){
				magelan.removeClass('bottom-magelan')
				magelan.addClass('fixed-magelan')
			}
			else {
				product.css('min-height',magelan.height()+17+'px')
				magelan.removeClass('fixed-magelan')
				magelan.addClass('bottom-magelan')		
			}
		}
	})

	$(window).on('resize',function(){
		magelan.css('width',magelan.parent().width()+'px').removeClass('fixed-magelan').removeClass('bottom-magelan')
	})

	/*let displayWidth
	let magelanYB
	let magelanYT
	let magelanWidth
	let magelanHeight

	let maxYT
	let maxYB
	let maxHeight

	function setter()
	{
		if(magelan.length>0){
			displayWidth = $(window).width()
			magelanYT = magelan.offset().top
			magelanYB = magelan.offset().top+magelan.height()
			magelanWidth = magelan.parent().width()
			magelanHeight = magelan.height()

			maxYT = $('.product-block').offset().top
			maxYB = $('.product-block').offset().top+$('.product-block').height()
			maxHeight = $('.product-block').height()

			$('.product-block').css('min-height',magelanHeight+'px')
			magelan.width(magelanWidth)

		}
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
	$(window).on('load',function(){
		setter()
	})
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
			if(magelan.height()>$('.product-block').height()){
				magelan.removeClass('fixed-magelan').addClass('bottom-magelan')
			}

		}, 300);
	})*/

})