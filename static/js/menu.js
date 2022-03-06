let collapse = document.querySelector('.collapse');
let collapse_button = document.querySelector('.fa-chevron-down');
let navbar = document.querySelector('.navbar');

collapse.onclick = () => {
    navbar.classList.toggle('active');
    collapse_button.classList.toggle('fa-chevron-up');
}

window.onscroll = () => {
    navbar.classList.remove('fa-chevron-up');
    collapse_button.classList.remove('active');
}