/*
    Файл предназначен для работы фильтра тем по выбранной дисциплине
    newquestions, newtest.
 */

const discipline = document.getElementById('discipline'),
    topic = document.querySelectorAll('.optionElem');

discipline.addEventListener('change', () => {
    let selectedOptionDisc = discipline.options[discipline.selectedIndex];

    topic.forEach((itemTopic) => {
        if (itemTopic.dataset.disc === selectedOptionDisc.value) {
            itemTopic.classList.remove('hidden');
        } else {
            itemTopic.classList.add('hidden');
        }
    });
});
