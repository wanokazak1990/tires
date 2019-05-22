/**
 * Сокращенное отображение логов
 */
function log(str)
{
    console.log(str);
}

/**
 * Краткая запись ajax-функции
 */
function ajax(parameters,url)
{
    return $.ajax({
        url: url,
        type: 'POST',
        data: parameters,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    });
}

/**
 * Отображение сообщений alert'а в специальном модальном окне
 */
function alert(str = '')
{
    $(document).find('.modal').modal('hide');
    $('#messageModal').modal('show');
    
    if (str == '')
    {
        var loader = $(document).find('.loader-wrapper').clone().css('display', 'block');
        $('#messageModal').find('.modal-body').html(loader);
    }
    else
        writeAlert(str);
}

function writeAlert(data) 
{
    $('#messageModal').find('.modal-body').html(data);
}

/**
 * Очистка модального окна собщений при его закрытии
 */
$('#messageModal').on('hidden.bs.modal', function () {
    $(this).find('.modal-body').html('');
});

/**
 * Задание одинаковой высоты нескольким блокам
 */
function oneHeight(whatSelector)
{
    let min = 0;
    $(whatSelector).each(function(){
        if($(this).height()>min)
            min = $(this).height();
    })
    $(whatSelector).height(min);
}
