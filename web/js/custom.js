let splitFirst = window.location.href.split('/');
let idFirst = splitFirst[splitFirst.length - 1];
let splitSecond = idFirst.split('?');
let id = splitSecond[0];

// let nav = document.getElementsByClassName('nav-link');
let nav = document.querySelectorAll('#menu li');

for (let i = 0; i < nav.length; i++) {

    if (nav[i].getAttribute('data-id') == id) {
        console.log(id);
        nav[i].classList.add('active');
        break;
    }
}