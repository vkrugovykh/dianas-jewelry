let split = window.location.href.split('/');
let id = split[split.length - 1];
let nav = document.getElementsByClassName('nav-link');
for (let i = 0; i < nav.length; i++) {
    if (nav[i].getAttribute('data-id') == id) {
        nav[i].classList.add('active');
        break;
    } else if (!id) {
        nav[0].classList.add('active');
        break;
    }
}