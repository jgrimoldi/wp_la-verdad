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

let video_frame = document.querySelector('#video_frame');
let featured_image = document.querySelector('#featured_image');
let post_frame = document.querySelector('#post_frame');

post_frame.onchange = () => {
    if(post_frame.value == 0 ){
        featured_image.classList.toggle('d-none');
        video_frame.classList.toggle('d-none');
    }else if(post_frame.value == 1){
        featured_image.classList.toggle('d-none');
        video_frame.classList.toggle('d-none');
    }
}