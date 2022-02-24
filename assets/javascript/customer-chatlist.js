const form = document.querySelector('.search-list'),
inputField = form.querySelector('.search-list input'),
searchBtn = form.querySelector('button'),
chats = document.querySelector('.users-list');

console.log('this');
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
              chats.innerHTML = data;
          }
      }
  }
  xhr.open("GET", "../customers/show-chats.php", true);
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);