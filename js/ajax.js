function updateUserTable() {
    var tbody = '';
    $.ajax({
        url: 'usersTable.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response) {
                response.forEach(function (user) {
                    tbody += user;
                });
                $('#usersViewTable').html(tbody);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}


$("#signupForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "includes/signup.inc.php",
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.status === 1) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Campo vacío').show();
            } else if (response.status === 2) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('No incluya caracteres especiales en el nombre').show();
            } else if (response.status === 3) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Apellido inválido').show();
            } else if (response.status === 4) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Cédula inválida').show();
            } else if (response.status === 5) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Las claves no coinciden').show();
            } else if (response.status === 8) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Ingrese un correo valido').show();
            } else if (response.status === 6) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Revise sus credenciales').show();
            } else if (response.status === 7) {
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-success').text('Registro exitoso').show();

                $('#newUserName').val('');
                $('#newUserSecondName').val('');
                $('#passwordField').val('');
                $('#passwordField2').val('');
                $('#NewUserCd').val('');
                $('#NewUserMail').val('');
                $('#NewUserRol').val('');
                updateUserTable();
            }
        },
        error: function (error) {
            console.log("SignupForm ajax request fail", error)
        }
    });
});

$("#editForm").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "includes/edit.inc.php",
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response)
            if (response.status === 1) {
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Campo vacío').show();
            } else if (response.status === 2) {
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('No incluya caracteres especiales en el nombre').show();
            } else if (response.status === 3) {
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('No incluya caracteres especiales en el apellido').show();
            } else if (response.status === 4) {
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Cédula inválida').show();
            } else if (response.status === 9) {
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Su correo no es valido').show();
            } else if (response.status === 5) {
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Verifique los datos').show();
            } else if (response.status === 6) {
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text('Se edito el usuario').show();
                updateUserTable();
            }
        },
        error: function (error) {
            console.log("Algo salio mal", error)
        }
    });
});

