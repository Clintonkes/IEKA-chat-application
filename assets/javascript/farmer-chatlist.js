
//Send farmers' signup details to the database with AJAX
const form = document.querySelector('.search-list'),
inputField = form.querySelector('.search-list input'),
searchBtn = form.querySelector('button'),
chatList = document.querySelector('.users-list');

//prevent automatic submission when you click the form
form.onsubmit = (e) => {
    e.preventDefault();
}


//a function to show recently received chat
setInterval(()=> {
    //start the AJAX machine
    let xhr = new XMLHttpRequest();
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                chatList.innerHTML = data;
            }
        }
    }
    xhr.open("GET", "../farmers/chatList.php", true);
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);