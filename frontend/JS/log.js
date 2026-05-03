let logBtn = document.querySelector('#LogBtn');
const logEmail = document.querySelector('#LogEmail');
const logPassword = document.querySelector('#LogPassword');

logBtn.addEventListener('click', () => {
    let emailValue = logEmail.value.trim();
    let pswValue = logPassword.value.trim();
    if(emailValue === '' || pswValue === ''){
        console.log("Errore");
        return false;
    }
    window.location.href = "./home.html"; //momentaneo
    return true;
});