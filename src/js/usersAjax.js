function updateUserTable() {
    var tbody = '';
    $.ajax({
        url: '/dashboard/index',
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

$(document).ready(function () {
    $("#signupForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                response = JSON.parse(response);
                console.log(response['message']);
                $('#errorsAlerts').removeClass("hidden").addClass('alert alert-primary').text(response.message).show();
                // flashToast('Registro exitoso.');
                $('#signupForm')[0].reset();
                updateUserTable();
            },
            error: function (error) {
                console.log("SignupForm ajax request fail", error);
            }
        });
    });

    $("#editForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                response = JSON.parse(response);
                $('#editErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text(response.message).show();
                updateUserTable();
            },
            error: function (error) {
                console.log("Algo salio mal", error);
                console.log(response);
            }
        });
    });

    $("#delform").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                $('#deleteModal').modal('hide');
                updateUserTable();
            },
            error: function (error) {
                console.log("Algo salio mal", error)
            }
        });
    });
}, true); 

