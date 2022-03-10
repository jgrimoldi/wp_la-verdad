let days = document.getElementById('days');
let hours = document.getElementById('hours');
let minutes = document.getElementById('mins');
let seconds = document.getElementById('secs');

let date = "28 Mar 2022";

function countdown() {
    let launchDay = new Date(date);
    let currentDate = new Date();

    let totalSeconds = (launchDay - currentDate) / 1000;

    let remDays = Math.floor(totalSeconds / 3600 / 24);
    let remHours = Math.floor(totalSeconds / 3600) % 24;
    let remMins = Math.floor(totalSeconds / 60) % 60;
    let remSecs = Math.floor(totalSeconds) % 60;

    days.innerHTML = remDays;
    hours.innerHTML = formatTime(remHours);
    minutes.innerHTML = formatTime(remMins);
    seconds.innerHTML = formatTime(remSecs);

}


function formatTime(time) {
    return time < 10 ? `0${time}` : time;
}

countdown()

setInterval(countdown, 1000);