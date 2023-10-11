function toggle_mode(){
    let theme = document.querySelectorAll('link')[0];
    
    if (theme.getAttribute('href') == 'style/main_style_light.css'){
        setcookie("mode", "dark");
        theme.setAttribute('href', 'style/main_style_dark.css');
        let options = document.querySelectorAll('img');

        for (let i = 0; i < options.length; i++){
            if (i == 0){
                options[0].setAttribute('src', 'img/user_white.png');
            }
            else if(i == 1){
                options[1].setAttribute('src', 'img/notes_white.png');
            }
            else if(i == 2){
                options[2].setAttribute('src', 'img/callendar_white.png');
            }
            else if(i == 3){
                options[3].setAttribute('src', 'img/settings_white.png');
            }
            else if(i == 4){
                options[4].setAttribute('src', 'img/day-and-night_white.png');
            }

        }
    }
    else{
        theme.setAttribute('href', 'style/main_style_light.css');
        setcookie("mode", "light");
        let options = document.querySelectorAll('img');
        for (let i = 0; i < options.length; i++){
            if (i == 0){
                options[0].setAttribute('src', 'img/user.png');
            }
            else if(i == 1){
                options[1].setAttribute('src', 'img/notes.png');
            }
            else if(i == 2){
                options[2].setAttribute('src', 'img/callendar.png');
            }
            else if(i == 3){
                options[3].setAttribute('src', 'img/settings.png');
            }
            else if(i == 4){
                options[4].setAttribute('src', 'img/day-and-night.png');
            }
    }
}}

function write_date(){
    const date = new Date();
    const year = date.getFullYear();
    let month = date.getMonth();
    let day = date.getDate();

    if (day < 10){
        day = '0' + day;
    }
    if (month < 10){
        month = '0' + month;
    }
    
    const div = document.querySelector('#headline');
    div.innerHTML = "[ " + day + "." + month + "." + year + " ]";
}

function clear_textarea(){
    document.querySelector("#notepad").value = "";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

function setcookie(cookieName,cookieValue) {
    var today = new Date();
    var expire = new Date();
    expire.setTime(today.getTime() + 3600000*24*14);
    document.cookie = cookieName+"="+encodeURI(cookieValue) + ";expires="+expire.toGMTString() + ";path=/notepad";
}

function setcookie_24h(cookieName,cookieValue) {
    var today = new Date();
    var expire = new Date();
    expire.setTime(today.getTime() + 24*60*60*1000);
    document.cookie = cookieName+"="+encodeURI(cookieValue) + ";expires="+expire.toGMTString() + ";path=/notepad";
}

function doSomething(){
    if(document.cookie.indexOf('mode=') == -1){
        setcookie("mode", "light");
    }
    else if(getCookie('mode') == 'dark'){
       toggle_mode();
    }
}

// const script = document.querySelector('script');
// script.addEventListener("onload", checkStreak());
// function checkStreak(){
//     const inputStreak = document.querySelector('#input_streak');
//     if(document.cookie.indexOf('streak=') == -1){
//         setcookie_24h("streak", 0);
//         inputStreak.value = 0;
//     }
//     else{
//         getCookie('streak')
//         inputStreak.value = getCookie('streak');
//     }
// }

const table = document.querySelector('.form_table');
const correction = () => {
    const tdClass = document.querySelectorAll('.tdClass');
    tdClass.forEach(td => {
        text = td.textContent.split(' ');
        td.textContent = text[0];
    });
}
table.addEventListener('onload', correction());