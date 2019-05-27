/*RESPONSIVE TABLE*/
$(document).ready(function(){
	var area = $('.content-area')
	var tables = area.find('table')
	var maxWidth = 900
	var curWidth = $(window).width()
	
	function checkWidth()
	{
		if(curWidth<maxWidth)
		{
			addClass()
			makeTH()
		}
	}

	function addClass()
	{
		tables.addClass('responsive')
		tables.each(function(){
			$(this).css({'width':'100%'})
		})
	}

	function getTHValues(table)
	{
		var mas = []
		table.find('th').each(function(){
			mas.push($(this).html())
		})
		return mas
	}

	function remakeTD(tr,th)
	{
		var countTD = tr.find('td').length
		if(th.length == countTD)
			var i = 0
			tr.find('td').each(function(){
				if(th[i])
				{
					var oldVal = $(this).html()
					var newVal = th[i]+' : '+oldVal
					$(this).html(newVal)
				}
				i++
			})
		
	}

	function makeTH()
	{	
		tables.each(function(){
			var ths = getTHValues($(this))
			$(this).find('tr').each(function(){
				remakeTD($(this),ths)
			})
		})
	}



	checkWidth()
	

})