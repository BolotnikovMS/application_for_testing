const btnSave = document.getElementById('btnSaveQuestions');

let data = [[]];

jexcel(document.getElementById('spreadsheetQuestions'), {
    data:data,
    tableOverflow: true,
    tableWidth: "820px",
    minDimensions:[1,1],
    columns: [
        {
            type: 'text',
            title:'Формулировка вопроса',
            width:660
        },
        {
            type: 'text',
            title: 'Группа ЭБ',
            width: 80
        }
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
    $('#btnSaveQuestions').on('click', function (e) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            dataType: 'html',
            url: '/newquestionsgroup/save',
            data: {data: data, topic: $('#topic').val()},
            success: function (data) {
            }
        });
        location.reload();
    });

    $('#discipline').on('change', function (e) {
        e.preventDefault();
        let idDisc = $('#discipline').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            dataType: 'html',
            url: '/topic',
            data: {data: idDisc},
            success: function (data) {
                $('#topic').empty();
                $('#topic').append($('<option disabled selected>Выберите тему</option>'));
                let respObj = JSON.parse(data);
                    for (let key in respObj) {
                        let obj = respObj[key];
                        if (idDisc == obj.id_discipline) {
                            $('#topic').append($('<option>', {
                                value: obj.id,
                                text: obj.name
                            }));
                        }
                    }
            }
        });
    });
});
