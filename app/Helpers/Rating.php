<?php
/*
 * Rating helper.
 *
 * Функция предназначенная для расчета оценки.
 *
 * @param $numbers - кол-во вопросов в тесте;
 * @param $correct - кол-во верных ответов;
 *
 * @return $mark - оценка.
 */
function ratingCalculation($numbers, $correct) {
    $mark = '';
    $calculation = (100 * $correct) / $numbers;
    if ($calculation < 30) {
        $mark = 'Неуд.';
    } else if ($calculation > 30 && $calculation < 50) {
        $mark = 'Уд.';
    } else if ($calculation >= 50 && $calculation < 75) {
        $mark = 'Хорошо';
    } else if ($calculation >= 75) {
        $mark = 'Отлично';
    }

    return $mark;
}
