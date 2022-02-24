
//Send farmers' signup details to the database with AJAX
const form = document.querySelector('.login-form'),
submitForm = form.querySelector('.submit input'),
errorText = form.querySelector('.wrong');

//prevent automatic submission when you click the form
form.onsubmit = (e) => {
    e.preventDefault();
}

submitForm.onclick = () => {
    //start AJAX
    let xhr = new XMLHttpRequest();
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                if(data !== 'success') {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                } else {
                    let word = "Login Successful!";
                    errorText.textContent = word;
                    errorText.style.display = "block";
                }
            }
        }
    }
    xhr.open("POST", "./login.php", true);
    let formData = new FormData(form);
    xhr.send(formData); //send the form data to php
}