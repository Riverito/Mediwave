$(document).ready(function () {
    updatePatiensTable();
    toggleCedulaField();

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
        updatePatiensTable();
    });
    $('#searchFullTable').on('input', function () {
        updatePatiensTable();
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

    hasCedulaSwitch.addEventListener('change', toggleCedulaField);

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
                }, 6000);
                if (response.status == 20) {
                    updatePatiensTable();
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
                }, 6000);
                if (response.status == 20) {
                    updatePatiensTable();
                    $('#newPatientForm')[0].reset();
                    setTimeout(function () {
                        $('#HistoryAsignErrors').addClass('d-none');
                    }, 6000);
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
                updatePatiensTable();
                $('#delpatientErrorsAlerts')
                    .removeClass("d-none alert-primary alert-danger")
                    .addClass('d-block w-100 alert alert-primary')
                    .text(response.message)
                    .show();
                setTimeout(function () {
                    $('#delpatientErrorsAlerts').addClass('d-none');
                }, 6000);
            },
            error: function (error) {
                $('#delpatientErrorsAlerts')
                    .removeClass("d-none alert-primary")
                    .addClass('d-block alert alert-danger')
                    .text('Ha ocurrido un error al procesar la solicitud.')
                    .show();
                    updatePatiensTable();
                setTimeout(function () {
                    $('#delpatientErrorsAlerts').addClass('d-none');
                }, 6000);
            }
        });
    });
    
});

const toggleCedulaField = () => {
    if (hasCedulaSwitch.checked) {
        cedulaField.style.display = 'block';
    } else {
        cedulaField.style.display = 'none';
    }
};

function updatePatiensTable() {
    $.ajax({
        url: '/medical-records/index',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response) {
                renderFullViewPatients(response);
                renderPatients(response);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

function renderPatients(patients) {
    var searchText = $('#searchTable').val().toLowerCase();
    var filteredPatients = patients.filter(function (patient) {
        return patient.PatienName.toLowerCase().includes(searchText);
    });

    var tbody = '';
    filteredPatients.forEach(function (patient) {
        var age = calculateAge(patient.patientDOB);
        tbody += '<tr>' +
            '<td>' + patient.PatienName + '</td>' +
            '<td>' + patient.patientLastName + '</td>' +
            '<td>' + patient.patientCd + '</td>' +
            '<td>' + age + '</td>' +
            '<td>' + patient.patientGender + '</td>' +
            '<td>' +
            '<button type="button" data-bs-toggle="modal" data-bs-target="#EditItemModal" class="editbtn m-1 btn btn-primary" data-uid="' + patient.idPatient + '">' +
            '<i class="fa-solid fa-pen-to-square"></i>' +
            '</button>' +
            '<button type="button" data-bs-toggle="modal" data-bs-target="#viewMedicalRecord" class="view-medical-record-btn m-1 btn btn-primary" data-uid="' + patient.idPatient + '">' +
            '<i class="fa-solid fa-book-medical"></i>' +
            '</button>' +
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


function showMedicalRecord(patientId) {
    $.ajax({
        url: '/medical-records/view',
        type: 'GET',
        data: { id: patientId },
        dataType: 'json',
        success: function (response) {
            if (response.status === 1) {
                console.log(response);
                window.open(response.filePath, '_blank');
            } else {
                alert('No se encontró el archivo médico para este paciente.');
            }
        },
        error: function () {
            alert('Hubo un error al obtener el archivo médico.');
        }
    });
}

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
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDifference = today.getMonth() - birthDate.getMonth();

    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    return age;
}

