$(document).ready(function () {
    updatePatientsTable();

    $('#HpatienName').val('');
    $('#HpatienSecondName').val('');
    $('#HpatienCd').val('');

    $('#cancelHistoryAsingn').on('click', function () {
        $('#historyForm')[0].reset();
        $('#HpatienName').val('');
        $('#HpatienSecondName').val('');
        $('#HpatienCd').val('');
    });
    $('#searchTable').on('input', function () {
        updatePatientsTable();
    });
    $('#searchFullTable').on('input', function () {
        updatePatientsTable();
    });
    $('#newPatientForm')[0].reset();
    $("#CancelNewPatient").on("click", function () {
        $('#newPatientForm')[0].reset();
    });

    var fullTable = $('#patientsFullViewTable');
    var fullScreenTableModal = $('#FullpatientsViews');

    fullTable.on("click", "tr", function () {
        var currentRow = $(this);
        var patientName = currentRow.find('td:eq(0)').text().trim();
        var patientLastName = currentRow.find('td:eq(1)').text().trim();
        var patientCd = currentRow.find('td:eq(2)').text().trim();
        var patientId = currentRow.find('td:eq(3)').text().trim();

        $('#HpatienName').val(patientName);
        $('#HpatienSecondName').val(patientLastName);
        $('#HpatienCd').val(patientCd);
        $('#Hpatient_id').val(patientId);

        fullScreenTableModal.modal('hide');
    });

    $('#searchFullTable').on('input', function () {
        updatePatientsTable();
    });
    
    const hasCedulaSwitch = document.getElementById('hasCedulaSwitch');
    const cedulaField = document.getElementById('cedulaField');
    const patientCdInput = document.getElementById('patientCd');

    const edithasCedulaSwitch = document.getElementById('edithasCedulaSwitch');
    const editcedulaField = document.getElementById('editcedulaField');
    const editpatientCdInput = document.getElementById('editpatientCd');

    if (hasCedulaSwitch && cedulaField) {
        hasCedulaSwitch.addEventListener('change', function () {
            toggleCedulaField(hasCedulaSwitch, cedulaField, patientCdInput);
        });
    }

    if (edithasCedulaSwitch && editcedulaField) {
        edithasCedulaSwitch.addEventListener('change', function () {
            toggleCedulaField(edithasCedulaSwitch, editcedulaField, editpatientCdInput);
        });
    }

    function toggleCedulaField(toggleCheck, fieldCh, input) {
        if (toggleCheck.checked) {
            fieldCh.style.display = 'block';
            input.disabled = false;
        } else {
            console.log(input);
            console.log('hola');
            fieldCh.style.display = 'none';
            input.disabled = true;
        }
    }

    $(document).on('click', '.delbtn', function () {
        let operationId = $(this).data('uid');
        $('#delpacient>input[name="uid"]').val(operationId);
    });

    $("#newPatientForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/medical-records/create',
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                response = JSON.parse(response);
                console.log(response['message']);
                $('#createPatientsErrorsAlerts').removeClass("d-none").addClass('d-block alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#createPatientsErrorsAlerts').addClass('d-none');
                }, 3000);
                if (response.status == 20) {
                    updatePatientsTable();
                    $('#newPatientForm')[0].reset();
                    setTimeout(function () {
                        $('#createPatientsErrorsAlerts').addClass('d-none');
                    }, 6000);
                }
            },
            error: function (error) {
                console.log("SignupForm ajax request fail", error);
            }
        });
    });

    $("#historyForm").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: '/medical-records/assign',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#HistoryAsignErrors').removeClass("d-none").addClass('d-block alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#HistoryAsignErrors').addClass('d-none');
                }, 3000);
                if (response.status == 100) {
                    $('#newPatientForm')[0].reset();
                    updatePatientsTable();
                    setTimeout(function () {
                        $('#HistoryAsignErrors').addClass('d-none');
                    }, 3000);
                }
            },
            error: function (error) {
                console.log("SignupForm ajax request fails", error);
            }
        });
    });

    $("#delpacient").submit(function (e) {
        e.preventDefault();
        console.log("si");
        $.ajax({
            type: "POST",
            url: '/medical-records/delete',
            data: $(this).serialize(),
            success: function (response) {
                response = JSON.parse(response);

                if (response.status == 2) {
                    updatePatientsTable();
                }
                $('#delpatientErrorsAlerts')
                    .removeClass("d-none alert-primary alert-danger")
                    .addClass('d-block w-100 alert alert-primary')
                    .text(response.message)
                    .show();
                setTimeout(function () {
                    $('#delpatientErrorsAlerts').addClass('d-none');
                }, 3000);
            },
            error: function (error) {
                $('#delpatientErrorsAlerts')
                    .removeClass("d-none alert-primary")
                    .addClass('d-block alert alert-danger')
                    .text('Ha ocurrido un error al procesar la solicitud.')
                    .show();
                setTimeout(function () {
                    $('#delpatientErrorsAlerts').addClass('d-none');
                }, 3000);
            }
        });
    });

    $("#editPatientForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/medical-records/update',
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                response = JSON.parse(response);
                console.log(response['message']);
                $('#editPatientsErrorsAlerts').removeClass("d-none").addClass('d-block alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#editPatientsErrorsAlerts').addClass('d-none');
                }, 6000);
                if (response.status == 20) {
                    updatePatientsTable();
                    $('#editPatientForm')[0].reset();
                    setTimeout(function () {
                        $('#editPatientsErrorsAlerts').addClass('d-none');
                    }, 3000);
                }
            },
            error: function (error) {
                console.log("SignupForm ajax request fail", error);
            }
        });
    });

    // Detectar cambios en los campos del formulario
    var originalValues = $('#editPatientForm').serialize();

    // Detectar cambios en los campos del formulario
    $('#editPatientForm input, #editPatientForm select').on('input change', function () {
        // Serializar los valores actuales del formulario
        var currentValues = $('#editPatientForm').serialize();
        // Comparar los valores originales con los actuales
        if (originalValues !== currentValues) {
            $('#editButton').prop('disabled', false);
        } else {
            $('#editButton').prop('disabled', true);
        }
    });

    // Resetear los valores del formulario y el botón cuando se cierra el modal
    $('#editPatientModal').on('hidden.bs.modal', function () {
        $('#editPatientForm')[0].reset();
        originalValues = $('#editPatientForm').serialize();
        $('#editButton').prop('disabled', true);
    });
});


$(document).on('click', '.editbtn', function () {
    let operationId = $(this).data('uid');
    let patientDOB = $(this).data('dob');
    $('#editPatientForm>input[name="uid"]').val(operationId);

    var currentRow = $(this).closest("tr");
    var firstName = currentRow.find('td:eq(0)').text();
    var lastName = currentRow.find('td:eq(1)').text();
    var userCd = currentRow.find('td:eq(2)').text();
    var gender = currentRow.find('td:eq(4)').text();

    $('#editpatientName').val(firstName);
    $('#editpatientLastname').val(lastName);
    $('#editpatientCd').val(userCd);
    $('#idpatientAge').val(patientDOB);
    $('#idpatientGenre').val(gender);
});



function updatePatientsTable() {
    $.ajax({
        url: '/medical-records/index',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response) {
                response.patients;
                response.registros;

                renderFullViewPatients(response.patients);
                renderPatients(response);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

function renderPatients(data) {
    var searchText = $('#searchTable').val().toLowerCase();
    var filteredPatients = data.patients.filter(function (patient) {
        return patient.PatienName.toLowerCase().includes(searchText)
            || patient.patientLastName.toLowerCase().includes(searchText)
            || patient.patientCd.toLowerCase().includes(searchText)
            || patient.patientGender.toLowerCase().includes(searchText);
    });

    // Crear un conjunto de idPatient que tienen registros médicos
    var registros = new Set(data.registros.map(registro => registro.idPatient));

    var tbody = '';
    filteredPatients.forEach(function (patient) {
        var age = calculateAge(patient.patientDOB);
        var hasRecord = registros.has(patient.idPatient);  // Verificar si el paciente tiene un registro

        tbody += '<tr>' +
            '<td>' + patient.PatienName + '</td>' +
            '<td>' + patient.patientLastName + '</td>' +
            '<td>' + patient.patientCd + '</td>' +
            '<td>' + age + '</td>' +
            '<td>' + patient.patientGender + '</td>' +
            '<td>' +
            '<button type="button" data-bs-toggle="modal" data-bs-target="#editPatientModal" class="editbtn m-1 btn btn-primary" ' +
            'data-uid="' + patient.idPatient + '" ' +
            'data-dob="' + patient.patientDOB + '">' +
            '<i class="fa-solid fa-pen-to-square"></i>' +
            '</button>' +
            (hasRecord ? `<a href="/medical-records/view?id=${patient.idPatient}">` +
            '<button type="button" data-bs-toggle="modal" data-bs-target="#viewMedicalRecord" class="view-medical-record-btn m-1 btn btn-primary" data-uid="' + patient.idPatient + '">' +
            '<i class="fa-solid fa-book-medical"></i>' +
            '</button>' +
            '</a>' : '') +
            '<button type="button" id="delpacient" data-bs-toggle="modal" data-bs-target="#deletePacientModal" class="delbtn m-1 btn btn-danger" data-uid="' + patient.idPatient + '">' +
            '<i class="fa-solid fa-trash"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';
    });
    $('#medicViewTable').html(tbody);

    $('.view-medical-record-btn').click(function () {
        var patientId = $(this).attr('data-uid');
        showMedicalRecord(patientId);
    });
}



$('.view-medical-record-btn').click(function () {
    var patientId = $(this).attr('data-uid');

    showMedicalRecord(patientId);
});

function renderFullViewPatients(patients) {
    var searchText = $('#searchFullTable').val().toLowerCase();
    var filteredPatients = patients.filter(function (patient) {
        return patient.PatienName.toLowerCase().includes(searchText) || patient.patientCd.includes(searchText);
    });

    var tbody = '';
    filteredPatients.forEach(function (patient) {
        tbody += '<tr data-id="' + patient.idPatient + '">' +
            '<td>' + patient.PatienName + '</td>' +
            '<td>' + patient.patientLastName + '</td>' +
            '<td>' + patient.patientCd + '</td>' +
            '<td class="d-none">' + patient.idPatient + '</td>' +
            '</tr>';
    });
    $('#patientsFullViewTable').html(tbody);
}

function calculateAge(dob) {
    var birthDate = new Date(dob);
    var today = new Date();
    var ageYears = today.getFullYear() - birthDate.getFullYear();
    var ageMonths = today.getMonth() - birthDate.getMonth();

    if (ageMonths < 0 || (ageMonths === 0 && today.getDate() < birthDate.getDate())) {
        ageYears--;
        ageMonths = 12 + ageMonths; // ajustar meses si es necesario
    }

    if (ageYears > 0) {
        return ageYears + " años";
    } else {
        return ageMonths + " meses";
    }
}
