let logBtn = document.querySelector('#LogBtn');
const logEmail = document.querySelector('#LogEmail');
const logPassword = document.querySelector('#LogPassword');

/*
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
*/

document.getElementById('LogBtn').addEventListener('click', async () => {
    const email    = document.getElementById('LogEmail').value;
    const password = document.getElementById('LogPassword').value;

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    const res = await fetch('../APIs/usr/login.php', {
    method: 'POST',
    body: formData,
    credentials: 'include' 
});

    if (res.ok) {
        window.location.href = "./home.html"; 
    } else if (res.status === 401) {
        alert('Email o password errati');
    } else {
        alert('Errore, riprova');
    }
});
