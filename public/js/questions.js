/*
    Фаил с js скриптом для questions.
 */

const discipline = document.getElementById('disciplines'),
    topicElem = document.querySelectorAll('.optionElem'),
    tableTr = document.querySelectorAll('.styleTableTr'),
    topics = document.getElementById('topic');

discipline.addEventListener('change', () => {
    let selectedOptionDisc = discipline.options[discipline.selectedIndex];

    topicElem.forEach((itemTopic) => {
        if (itemTopic.value === selectedOptionDisc.value) {
            itemTopic.classList.remove('hidden');
        } else {
            itemTopic.classList.add('hidden');
        }
    });

});

topics.addEventListener('change', () => {
    let selectOptionTopic = topics.options[topics.selectedIndex];
    tableTr.forEach((itemTr) => {
        if (itemTr.dataset.trel === selectOptionTopic.dataset.topicItem) {
            itemTr.classList.remove('hidden');
        } else  {
            itemTr.classList.add('hidden');
        }
    });
});

const btnResetFilterSearchQuestion = document.getElementById('resetFilterSearchQuestion');

btnResetFilterSearchQuestion.addEventListener('click', () => {
    tableTr.forEach((itemTr) => {
        itemTr.classList.remove('hidden');
    });
});

/*
    Показать скрыть ответы к вопросу.
 */
const expandList = document.querySelectorAll('#expandList'),
    imgExpandList = document.querySelectorAll('#imgExpandList');

// v.1
expandList.forEach((itemList, i) => {
    let flag = true;
    itemList.addEventListener('click', () => {
        const listInTable = document.querySelectorAll('#listInTable');

        listInTable[i].classList.toggle('hidden');
        if (flag === true) {
            imgExpandList[i].src = './img/minus.png';
            flag = false;
        } else {
            imgExpandList[i].src = './img/plus.png';
            flag = true;
        }
    });
});

/*
    Показ формы
 */

const addFormBtn = document.querySelectorAll('#addFormBtn'),
    addFormAnswer = document.querySelectorAll('.addFormAnswer');

addFormBtn.forEach((itemBtn, i) => {
    itemBtn.addEventListener('click', () => {
        addFormAnswer[i].classList.toggle('hidden');
    });
});
