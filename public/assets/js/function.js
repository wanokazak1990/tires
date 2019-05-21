function log(str)
{
    console.log(str);
}

function ajax(parameters,url)
{
    return $.ajax({
        url: url,
        type: 'POST',
        data: parameters,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    });
}

function alert(str)
{
	$('#messageModal').find('.modal-body').html(str);
	$('#messageModal').modal('show');
}