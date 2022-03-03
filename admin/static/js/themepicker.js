let themebutton = document.querySelector('.theme');
let themepicker = document.querySelector('.theme__chooser');
let switches = document.getElementsByClassName('switch');
let style = localStorage.getItem('style');

themebutton.onclick = () =>{
    themepicker.classList.toggle('hide-chooser');
}

window.onscroll = () =>{
    themepicker.classList.add('hide-chooser')
}

if (style == null) {
  setTheme('light');
} else {
  setTheme(style);
}

for (let i of switches) {
  i.addEventListener('click', function () {
    let theme = this.dataset.theme;
    setTheme(theme);
  });
}

function setTheme(theme) {
  if (theme == 'original') {
    document.getElementById('switcher-id').href = './static/css/themes/original.css';
  } else if (theme == 'high-contrast') {
    document.getElementById('switcher-id').href = './static/css/themes/contrast.css';
  } else if (theme == 'black') {
    document.getElementById('switcher-id').href = './static/css/themes/dark.css';
  } else if (theme == 'pink') {
    document.getElementById('switcher-id').href = './static/css/themes/pink.css';
  } else if (theme == 'blue') {
    document.getElementById('switcher-id').href = './static/css/themes/blue.css';
  }
  localStorage.setItem('style', theme);
}