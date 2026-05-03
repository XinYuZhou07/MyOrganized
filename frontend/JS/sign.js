let signBtn = document.querySelector('#SignBtn');

const signEmail = document.querySelector('#SignEmail');
const signPassword = document.querySelector('#SignPassword');



signBtn.addEventListener('click', () => {
    let emailValue = signEmail.value.trim();
    let pswValue = signPassword.value.trim();
    if(emailValue === '' || pswValue === ''){
        console.log("Errore");
        return false;
    }
    window.location.href = "./home.html"; //momentaneo
    return true;
});

