var page = window.location.href.match(/[^/]+$/)[0];
let base_url = `http://laverdadrn.com.ar/`;
let anchor = document.querySelector('.pagination__buttons-btn[href = "' + base_url + page + '"');

if(anchor){
    anchor.classList.toggle('active');
}

let buttons = document.querySelectorAll('.pagination__buttons-btn');
let prev = document.querySelector('.prev');
let next = document.querySelector('.next');
let initialPrev = 0;
let initialNext = 0;
let amount = 220;
let width = document.getElementById("pb").clientLeft;
let maxRange = Math.floor( ((buttons.length - 2)/ 6) * 200);

prev.onclick = () =>{
    initialPrev += amount;
    next.style.pointerEvents = 'inherit';

    if(initialPrev != 0){
        initialNext -= amount;
    }
    if(initialPrev == 0){
        prev.style.pointerEvents = 'none';
    }

    buttons.forEach(button => {
        button.style.transform = "translateX(" + initialPrev +"px)"
    });
}

next.onclick = () =>{
    initialNext += amount;

    if(initialNext != 0){
        initialPrev -= amount;
    }
    if(initialNext >= maxRange){
        next.style.pointerEvents = 'none';
    }else{
        prev.style.pointerEvents = 'inherit';
        buttons.forEach(button => {
            button.style.transform = "translateX(-"+ initialNext +"px)";
        });
    }
} 








function sum() {
    let buttonsSum = 0;
    let buttons = document.getElementsByClassName('pagination__buttons-btn');

    for(let i = 0; i < buttons.length; i++) {
        buttonsSum += buttons[i].clientWidth + 10;
    }

    return buttonsSum;
}