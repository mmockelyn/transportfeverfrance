let toggle_icon = document.getElementById('theme-toggle');
let body = document.getElementsByTagName('body')[0];
let sun_class = 'sun';
let moon_class = 'moon';
let dark_theme_class = 'dark-theme';

toggle_icon.addEventListener('click', function() {
    if (body.classList.contains(dark_theme_class)) {
        toggle_icon.classList.add(moon_class);
        toggle_icon.classList.remove(sun_class);

        body.classList.remove(dark_theme_class);

        setCookie('theme', 'light');
    }
    else {
        toggle_icon.classList.add(sun_class);
        toggle_icon.classList.remove(moon_class);

        body.classList.add(dark_theme_class);

        setCookie('theme', 'dark');
    }
});

function setCookie(name, value) {
    var d = new Date();
    d.setTime(d.getTime() + (365*24*60*60*1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}
