window.onload = setInterval(() => {
    clock();
}, 1000);

setInterval(() => {
    clock();
}, 1000);

function clock(){
    let date = new Date();
    document.getElementsByName('clock')[0].innerHTML = date.toLocaleTimeString();
}