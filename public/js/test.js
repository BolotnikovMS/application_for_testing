/*
    Таймер.
 */

function getTimeRemaining(endtime) {
    let t = Date.parse(endtime) - Date.parse(new Date()),
        seconds = Math.floor((t / 1000) % 60),
        minutes = Math.floor((t / 1000 / 60) % 60),
        hours = Math.floor((t / (1000 * 60 * 60)) % 24);

    return {
        total: t,
        hours: hours,
        minutes: minutes,
        seconds: seconds
    };
}

function getZero(num) {
    if (num >= 0 && num < 10) {
        return `0${num}`;
    } else {
        return num;
    }
}

function setClock(selsector, endtime) {
    const clock = document.querySelector(selsector),
        hoursSpan = clock.querySelector(".hours"),
        minutesSpan = clock.querySelector(".minutes"),
        secondsSpan = clock.querySelector(".seconds");

    function updateClock() {
        const t = getTimeRemaining(endtime);

        if (t.total <= 0) {
            document.getElementById("countdown").className = "hidden";
            alert("Время вышло!");

            document.getElementById('test_submit').submit();

            clearInterval(timeinterval);
            return true;
        }

        hoursSpan.innerHTML = getZero(t.hours);
        minutesSpan.innerHTML = getZero(t.minutes);
        secondsSpan.innerHTML = getZero(t.seconds);
    }

    updateClock();
    let timeinterval = setInterval(updateClock, 1000);
}

let t = document.getElementById('timer').value;
let deadline = new Date(Date.parse(new Date()) + t * 1000);

setClock(".countdown", deadline);

/*
    Действия при перезагрузке страницы.
 */

if (performance.navigation.type === 1) {
    console.log( "Страница перезагружена" );
    document.getElementById('test_submit').submit();
} else {
    console.log( "Страница не перезагружена");
}
