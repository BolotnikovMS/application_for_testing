const answers = document.getElementById('answers'),
    formSub = document.getElementById('formSub'),
    countDate = document.getElementById('count_data');

const divErrorForm = document.createElement('div');

let num = 0;

function addInputAnswer() {
    const elem = document.createElement('div');

    if(countDate.value >= 1) {
        num = +countDate.value + 1;
    } else {
        num = num + 1;
    }

    elem.innerHTML = `
        <label>Ответ ${num}</label>
        <input class="inputStyle" type="text" name="answer_${num}" id="answer_${num}">
        <input type="checkbox" name="check_${num}" id="check_${num}" value="1">
    `;
    document.getElementById('count_data').value = num;
    answers.append(elem);
}

function removeInputAnswer() {
    let q = answers.getElementsByTagName('input');
    q[q.length - 1].parentNode.removeChild(q[q.length - 1]);
    q = answers.getElementsByTagName('input');
    q[q.length - 1].parentNode.removeChild(q[q.length - 1]);
    q = answers.getElementsByTagName('label');
    q[q.length - 1].parentNode.removeChild(q[q.length - 1]);
    document.getElementById('count_data').value -= 1;
    num -= 1;
}

function formSubmit() {
    const answer = document.getElementById('answer_1');
    const divContai = document.getElementById('contain');

    if (answer && answer.value !== '' && answer.value.length > 3) {
        document.getElementById('main').submit();
    } else {
        divErrorForm.classList.add('errorMsg');
        divErrorForm.innerHTML = `
            <ul>
                <li class="errorLi">Добавьте ответы к вопросу! Длина ответа должна быть более 3 символов</li>
            </ul>
        `;
        divContai.append(divErrorForm);
    }

    let countDataNew = document.getElementById('count_data_new');
    if (countDataNew.value === '0') {
        countDataNew.value = countDate.value;
    } else {
        countDataNew.value = num;
    }
}
