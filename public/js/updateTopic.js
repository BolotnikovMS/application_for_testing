/*
    Файл с js скриптом для updatetest, updatequestion.

    Выделение темы вопроса в списке.
 */

const discipline = document.getElementById('discipline'),
    topic = document.querySelectorAll('.optionElem');

let selectedOptionDisc = discipline.options[discipline.selectedIndex];

topic.forEach((itemTopic) => {
    if (itemTopic.dataset.disc === selectedOptionDisc.value) {
        itemTopic.classList.remove('hidden');
    } else {
        itemTopic.classList.add('hidden');
    }
});
