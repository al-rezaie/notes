const eyeContainer = document.querySelector('.pass-container .pass-icon');
const eyeIcon = document.querySelector('.pass-container .pass-icon i');
const input = document.querySelector('.pass-container .pass-input');

eyeContainer.addEventListener('click', () => {
    if(input.type == 'text') {
        input.type = 'password'
    } else {
        input.type = 'text'
    }
})

const confirmEyeContainer = document.querySelector('#pass-container #pass-icon');
const confirmEyeIcon = document.querySelector('#pass-container #pass-icon i');
const confirmInput = document.querySelector('#pass-container #pass-input');

confirmEyeContainer.addEventListener('click', () => {
    if(confirmInput.type == 'text') {
        confirmInput.type = 'password'
    } else {
        confirmInput.type = 'text'
    }
})