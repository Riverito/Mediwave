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


    // let password = document.getElementById('passwordField');
    // let password2 = document.getElementById('passwordField2');
    // let eyeicon = document.getElementById('eye-icon');
    // let eyeicon2 = document.getElementById('eye-icon2');


    // eyeicon2.onclick = function () {
    //     if (password2.type == "password") {
    //         password2.type = "text";
    //     } else {
    //         password2.type = "password";
    //     }
    // }

    // eyeicon.onclick = function () {
    //     if (password.type == "password") {
    //         password.type = "text";
    //     } else {
    //         password.type = "password";
    //     }
    // }

    let routeac;


    $("#loginForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                response = JSON.parse(response);
                $('#loginErrorsAlerts').removeClass("d-none").addClass('d-block alert-primary').text(response.message).show();
                if (response.success) {
                    $.ajax({
                        url: '/ac',
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            routeac = response.url;
                        },
                        error: function (error) {
                            console.error('Error en la solicitud AJAX:', error);
                        }
                    });
                    setTimeout(function () {
                        $('#loginErrorsAlerts').addClass('d-none');
                        location.href = routeac;
                    }, 1000);
                }
                setTimeout(function () {
                    $('#loginErrorsAlerts').addClass('d-none');
                }, 6000);
            },
            error: function (error) {
                console.log("SignupForm ajax request fail", error);
            }
        });
    });
});

