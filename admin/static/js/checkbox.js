let checkbox = document.querySelector('#job');
let title = document.querySelector('#title');
let subtitle = document.querySelector('#subtitle');
let topic_id = document.querySelector('#topic_id');
let phone = document.querySelector('#phone');
let email = document.querySelector('#email');

checkbox.onclick = () => {
    if (checkbox.checked) {
        title.placeholder = "Puesto de trabajo";
        subtitle.placeholder = "Ubicacion del trabajo";
        topic_id.value = "1";
        phone.style.display = "inline-block";
        email.style.display = "inline-block";
    } else {
        title.placeholder = "Título de la noticia";
        subtitle.placeholder = "Subtítulo de la noticia";
        topic_id.value = "0";
        phone.style.display = "none";
        email.style.display = "none";
    }
}