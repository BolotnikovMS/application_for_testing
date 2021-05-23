let data = [[]];

jexcel(document.getElementById('spreadsheetAnswers'), {
    data:data,
    tableOverflow: true,
    tableWidth: "820px",
    minDimensions:[2,1],
    columns: [
        {
            type: 'text',
            title:'id вопроса',
            width:80,
            content: 'format_align_left',
        },
        {
            type: 'text',
            title:'Формулировка ответа',
            width:570,
            content: 'format_align_left',
        },
        {
            type: 'text',
            title:'Верный ответ',
            width:100,
            content: 'format_align_left',
        },
        // {
        //     type: 'text',
        //     title:'id темы',
        //     width:80,
        // },
    ],
    text: {
        insertANewColumnBefore:'Вставить новый столбец перед',
        insertANewColumnAfter:'Вставить новый столбец после',
        insertANewRowBefore:'Вставить новую строку перед',
        insertANewRowAfter:'Вставить новую строку после',
        deleteSelectedRows:'Удалить выбранную строку',
        deleteSelectedColumns:'Удалить выбранный столбец',
        renameThisColumn:'Переименовать выбранный столбец',
        copy:'Копировать...',
        paste:'Вставить...',
        saveAs:'Сохранить ...',
    }
});

$(document).ready(function () {
    $('#btnSaveAnswers').on('click', function (e) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            dataType: 'html',
            url: '/addinganswers/save',
            data: {data: data},
            success: function (data) {
                console.log(data);
            }
        });
        location.reload();
    });
});
