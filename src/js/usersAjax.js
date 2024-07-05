function updateUserTable() {
    var tbody = '';
    $.ajax({
        url: '/users/index',
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
                $('#errorsAlerts').removeClass("d-none").addClass('d-block alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#errorsAlerts').addClass('d-none');
                }, 6000);
                if (response.status === 20){
                    updateUserTable();
                    $('#signupForm')[0].reset();
                }
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
                $('#editErrorsAlerts').removeClass("d-none").addClass('alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#editErrorsAlerts').addClass('d-none');
                }, 5000);
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

}, true);

