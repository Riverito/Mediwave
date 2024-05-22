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



    $(document).on('click', '.editbtn', function () {

        let operationId = $(this).data('uid');
        $('#editForm>input[name="uid"]').val(operationId);

        var currentRow = $(this).closest("tr");
        var firstName = currentRow.find('td:eq(0)').text();
        var lastName = currentRow.find('td:eq(1)').text();
        var userCd = currentRow.find('td:eq(2)').text();
        var email = currentRow.find('td:eq(3)').text();
        var rol = currentRow.find('td:eq(4)').text();

        if (rol == "Doctor") {
            rol = 2
        } else {
            rol = 3;
        }

        $('#editNombre').val(firstName);
        $('#editApellido').val(lastName);
        $('#editUserCd').val(userCd);
        $('#editEmail').val(email);
        $('#editRol').val(rol);
    });

    $(document).on('click', '.delbtn', function () {
        let operationId = $(this).data('uid');
        $('#delform>input[name="uid"]').val(operationId);
        updateUserTable();
    });

});

