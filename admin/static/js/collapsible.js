let body = document.querySelector('#body');
let collapse = document.querySelector('#collapse');
let icon = document.querySelector('.fa-bars');
let navbar = document.querySelector('.navbar');


collapse.onclick = () => {
    icon.classList.toggle('fa-times');
    body.classList.toggle('body-collapsible');
    navbar.classList.toggle('navbar-collapsible');
}
