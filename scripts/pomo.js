//timer variables (from document)
let minutes = document.querySelector('.minutes');
let seconds = document.querySelector('.seconds');
//button variables (frome document)
let start = document.querySelector('.start');
let restart = document.querySelector('.restart');
let rest = document.querySelector('.rest');
let stop = document.querySelector('.stop');
//js variables
// let mode = 'work';
let startTimer;
//start btn event listener
start.addEventListener('click', ()=>{
    // if(startTimer === undefined){
        stopTimer()
        minutes.innerText = 25;
        seconds.innerText = '00';
        startTimer = setInterval(timer, 1000);
    // } else{
        // alert('تایمر درحال اجرا است');
    // }
})
//stop btn event listener
stop.addEventListener('click', () => {
    stopTimer();
})
//rest btn event listener
rest.addEventListener('click', ()=>{
    minutes.innerText = 5;
    seconds.innerText = '00';
    stopTimer();
    startTimer = setInterval(timer, 1000)
})
//restart btn event listener
restart.addEventListener('click', ()=>{
    stopTimer();
    startTimer = setInterval(timer, 1000);
})
//timer function
const timer = () => {
    //decreasing seconds
    if(seconds.innerText != '00'){
        seconds.innerText--;
        if(seconds.innerText < 10){
            seconds.innerText = `0${seconds.innerText}`;
        }
    //decreasing minutes
    } else if(minutes.innerText != '00' && seconds.innerText == '00'){
        seconds.innerText = 59;
        minutes.innerText--;
        if(minutes.innerText < 10){
            minutes.innerText = `0${minutes.innerText}`;
        }
    }

    //stoping timer
    if(seconds.innerText == '00' && minutes.innerText == '00'){
        seconds.innerText = '00';
        minutes.innerText = '00';
        // if(mode == 'work'){
        //     mode == 'rest';
        // } else {
        //     mode == 'work';
        // }
        stopTimer();
    }
}
//stop timer function
const stopTimer = () => {
    clearInterval(startTimer);
    startTimer = undefined;
}