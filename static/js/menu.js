let collapse = document.querySelector('.collapse');
let collapse_button = document.querySelector('.fa-chevron-up');
let navbar = document.querySelector('.navbar');

collapse.onclick = () => {
    navbar.classList.toggle('active');
    collapse_button.classList.toggle('fa-chevron-up');
    collapse_button.classList.toggle('fa-chevron-down');
}

window.onscroll = () => {
    navbar.classList.remove('fa-chevron-up');
    collapse_button.classList.remove('active');
}