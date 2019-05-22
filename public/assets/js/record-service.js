$('#service-record').on('click',function(){
    let err = [];
    let form = $(this).closest('form');
    
    form.find('input').each(function() {
        if ($(this).val() == '')
            err.push($(this).attr('placeholder'));
    });

    alert();

    if (err.length < 1)
    {
        let parameters = form.serialize();
        let url = form.attr('action');

        $.when(ajax(parameters,url).then(function(data){
            if (data == '1')
            {
                writeAlert('Заявка на сервис успешно отправлена.');
                form[0].reset();
            }
            else
            {
                writeAlert('Не удалось отправить заявку на сервис.');
            }
        }));
    }
    else
    {
        let msg_err = '';
        for (i in err)
            msg_err += 'Поле "' + err[i] + '" не заполнено.<br>';
        
        writeAlert(msg_err);
    }
});