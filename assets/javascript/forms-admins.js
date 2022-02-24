
//Send customers signup details to the database with AJAX
const form = document.querySelector('.signup form'),
submitForm = form.querySelector('.sub input'),
errorText = form.querySelector('.error');

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
                if(data == 'success') {
                    let word = 'Your signup was a ' + data;
                    errorText.textContent = word;
                    errorText.style.display = "block";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    xhr.open("POST", "./admin_signup_code.php", true);
    let formData = new FormData(form);
    xhr.send(formData); //send the form data to php
}