$(document).ready(function () {

    function currenTime() {
        let date = new Date();
        let hh = date.getHours();
        let mm = date.getMinutes();
        hh = (hh < 10) ? "0" + hh : hh;
        mm = (mm < 10) ? "0" + mm : mm;
        let time = hh + ":" + mm;
        let reloj = document.querySelector("#reloj");
        reloj.innerHTML = time;
    }
    setInterval(currenTime, 1000);


    let password = document.getElementById('passwordField');
    let password2 = document.getElementById('passwordField2');
    let eyeicon = document.getElementById('eye-icon');
    let eyeicon2 = document.getElementById('eye-icon2');


    eyeicon2.onclick = function () {
        if (password2.type == "password") {
            password2.type = "text";
        } else {
            password2.type = "password";
        }
    }

    eyeicon.onclick = function () {
        if (password.type == "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    }




});

