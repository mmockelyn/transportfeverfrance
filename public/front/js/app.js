$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

moment.locale('fr');

// Dark mode settings
let toggle_icon = document.getElementById('theme-toggle')
let body = document.getElementsByTagName('body')[0];
var dark_theme_class = 'dark-theme';

toggle_icon.addEventListener('click', (e) => {
    if(body.classList.contains(dark_theme_class)) {
        body.classList.remove(dark_theme_class);
        setCookie('theme', 'light')
    } else {
        body.classList.add(dark_theme_class);
        setCookie('theme', 'dark')
    }
})

function setCookie(name, value) {
    let d = new Date()
    d.setTime(d.getTime() + (365*24*60*60*1000))
    let expires = "expires="+d.toUTCString()
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}
