// pomodoro
const startBtn = document.getElementById('start-button');
const restBtn = document.getElementById('rest-button');
const resetBtn = document.getElementById('reset-button');
const stopBtn = document.getElementById('stop-button');
const timerBody = document.getElementById('timer-container');
const timerValue = document.getElementById('timer-value');
const message = document.createElement('p');
const alarm = new Audio('../auido/alarm.mp3');

let timeLeft = 1500; // seconds in 25 minutes
let timerInterval; // which time we're going to interval ( 5minutes or 25 minutes )


//display the timer
const updateTimer = () => {
    let minutes = Math.floor(timeLeft/60); // minutes left
    let seconds = timeLeft % 60; // seconds left
    timerValue.textContent = `${minutes.toString().padStart(2,0)} : ${seconds.toString().padStart(2,0)}`; 
}

const startTimer = () => {
    timerInterval = setInterval(() => {
        timeLeft--;
        updateTimer();
        if(timeLeft === 0) {
            clearInterval(timerInterval);
            startBtn.disabled = true;
            stopBtn.disabled = true;
            timerBody.appendChild(message);
            message.style.marginTop = '50px';
            message.textContent = 'وقت تمام شد. برای استراحت بر دكمه (استراحت) و برای شروع مجدد بر دكمه (شروع مجدد) کلیک كنید.'
            alarm.play();
        }
    }, 1000);
}

const stopTimer = () => {
    clearInterval(timerInterval);
}

const breakTimer = () => {
    stopTimer();
    timeLeft = 300;
    let minutes = Math.floor(timeLeft / 60);
    let seconds = timeLeft % 60;
    timerValue.textContent = `${minutes.toString().padStart(2,0)} : ${seconds.toString().padStart(2,0)}`;
    if(stopBtn.disabled && startBtn.disabled) {
        startBtn.disabled = false;
        stopBtn.disabled = false;
        message.remove();
        alarm.play();
    }
}

const resetTimer = () => {
    timeLeft = 1500;
    let minutes = Math.floor(timeLeft/60); // minutes left
    let seconds = timeLeft % 60; // seconds left
    stopTimer();
    timerValue.textContent = `${minutes.toString().padStart(2,0)} : ${seconds.toString().padStart(2,0)}`; 
    if(stopBtn.disabled && startBtn.disabled) {
        startBtn.disabled = false;
        stopBtn.disabled = false;
        message.remove();
    }
}

updateTimer();

startBtn.addEventListener('click', startTimer);
stopBtn.addEventListener('click', stopTimer);
restBtn.addEventListener('click', breakTimer);
resetBtn.addEventListener('click', resetTimer);