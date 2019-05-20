function clearForm(obj)
{
    var form = obj.closest('form')                
    form.find('select').val(0)
}

$(document).ready(function(){

	//CLEAR FILTER FORM
    $(document).on('click','.filter-clear',function(){
        clearForm($(this))
        var form = $(this).closest('form')
        form.submit()
    })





    $(document).on('change','#filter-vendor',function(){
    	url = $(this).attr('url')
    	parameters = {
    		'vendor':$(this).val()
    	}
    	$.when(ajax(parameters,url).then(function(data){
    		data = JSON.parse(data)
    		$('#filter-car').html('')
            $('#filter-car').append('<option selected disabled value="0">Укажите модель</option>')
    		for(i in data){
    			$('#filter-car').append('<option value="'+data[i].car+'">'+data[i].car+'</option>')
    		}
            $('#filter-year').html('')
            $('#filter-modification').html('')
    	}))
    })

    $(document).on('change','#filter-car',function(){
    	url = $(this).attr('url')
    	parameters = {
     		'vendor':$('#filter-vendor').val(),
     		'car':$(this).val()
    	}
    	$.when(ajax(parameters,url).then(function(data){
    		data = JSON.parse(data)
    		$('#filter-year').html('')
            $('#filter-year').append('<option selected disabled value="0">Укажите год</option>')
    		for(i in data){
    			$('#filter-year').append('<option value="'+data[i].year+'">'+data[i].year+'</option>')
    		}
            $('#filter-modification').html('')
    	}))
    })

    $(document).on('change','#filter-year',function(){
    	url = $(this).attr('url')
    	parameters = {
    		'vendor':$('#filter-vendor').val(),
    		'car':$('#filter-car').val(),
    		'year':$(this).val()
    	}
    	$.when(ajax(parameters,url).then(function(data){
    		data = JSON.parse(data)
    		$('#filter-modification').html('')
            $('#filter-modification').append('<option selected disabled value="0">Укажите исполнение</option>')
    		for(i in data){
    			$('#filter-modification').append('<option value="'+data[i].modification+'">'+data[i].modification+'</option>')
    		}
    	}))
    })
})