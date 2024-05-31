function updateItemsTable() {
    $.ajax({
        url: '/dashboard/itemsTable',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response) {
                renderItems(response);
                renderFullScreenItems(response);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

function updateAjustmentTable() {
    $.ajax({
        url: '/dashboard/adjustmentTable',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response) {
                console.log(response);
                renderAjustments(response);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
    
}

function renderAjustments(ajustments) {
    var searchText = $('#searchAjustments').val().toLowerCase();
    var filteredAjustments = ajustments.filter(function (ajustment) {
        return ajustment.nameItem.toLowerCase().includes(searchText) ||
            ajustment.usersName.toLowerCase().includes(searchText);
    });

    var tbody = '';
    filteredAjustments.forEach(function (ajustment) {
        tbody += '<tr>' +
            '<td>' + ajustment.nameItem + '</td>' +
            '<td>' + ajustment.usersName + '</td>' +
            '<td>' + ajustment.adjustmentAmount + '</td>' +
            '<td>' + ajustment.adjustmentReason + '</td>' +
            '<td>' + ajustment.adjustmentDateTime + '</td>' +
            '</tr>';
    });

    $('#ajustmentsViewTable').html(tbody);
}


function renderItems(items) {
    var searchText = $('#searchTable').val().toLowerCase();
    var filteredItems = items.filter(function (item) {
        return item.nameItem.toLowerCase().includes(searchText) || item.descriptionItem.toLowerCase().includes(searchText);
    });

    var tbody = '';
    filteredItems.forEach(function (item) {
        tbody += '<tr>' +
            '<td>' + item.nameItem + '</td>' +
            '<td>' + item.descriptionItem + '</td>' +
            '<td>' + item.countItem + '</td>' +
            '<td>' +
            '<button type="button" data-bs-toggle="modal" data-bs-target="#editItemModal" class="editbtn m-1 btn btn-primary" data-uid="' + item.idItem + '">' +
            '<i class="fa-solid fa-pen-to-square"></i>' +
            '</button>' +
            '</td>' +
            '<td>' +
            '<button type="button" data-bs-toggle="modal" data-bs-target="#deleteItemModal" class="editbtn m-1 btn btn-danger" data-uid="' + item.idItem + '">' +
            '<i class="fa-solid fa-trash"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';
    });
    $('#inventoryViewTable').html(tbody);
}

function renderFullScreenItems(items) {
    var searchText = $('#searchFullTable').val().toLowerCase();
    var filteredItems = items.filter(function (item) {
        return item.nameItem.toLowerCase().includes(searchText) || item.descriptionItem.toLowerCase().includes(searchText);
    });

    var tbody = '';
    filteredItems.forEach(function (item) {
        tbody += '<tr data-id="' + item.idItem + '">' +
            '<td>' + item.nameItem + '</td>' +
            '<td>' + item.descriptionItem + '</td>' +
            '<td>' + item.countItem + '</td>' +
            '</tr>';
    });

    $('#inventoryFullViewTable').html(tbody);
}





$(document).ready(function () {

    $('#AjusRazonTexarea').val('');
    $("#ajustTableProccess").empty();
    updateItemsTable();
    updateAjustmentTable();

    var fullTable = $('#inventoryFullViewTable');
    var fullScreenTableModal = $('#fullScreenTable');
    var ajustTableProccess = $('#ajustTableProccess');
    var cancelCurrentAjust = $('#cancelCurrentAjust');
    var fullScreenTableModalErrors = $('#fullScreenTableModalErros');



    fullTable.on("click", "tr", function () {
        var currentRow = $(this);
        var itemExists = false;
        var ajustItemName = currentRow.find('td:eq(0)').text().trim();
        var ajustItemId = currentRow.data('id');

        ajustTableProccess.find('tr').each(function () {
            var existingItemName = $(this).find('td:eq(0) input').val().trim(); // Trim whitespace
            if (existingItemName === ajustItemName) {
                itemExists = true;
                return false; // Break loop
            }
        });

        if (itemExists) {
            fullScreenTableModalErrors.text('Este item ya está en la lista.').removeClass('hidden');
            setTimeout(function () {
                fullScreenTableModalErrors.addClass('hidden');
            }, 6000);
        } else {
            var newRow = '<tr>' +
                '<td><input type="text" name="itemName[]" class="form-control" value="' + ajustItemName + '" readonly></td>' +
                '<td><input type="number" name="itemQuantity[]" class="form-control" placeholder="Cantidad"></td>' +
                '<td>' +
                '<select name="operation[]" class="form-control">' +
                '<option value="sum">Sumar</option>' +
                '<option value="subtract">Restar</option>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<button type="button" class="removebtn m-1 btn btn-danger">' +
                '<i class="fa-solid fa-trash"></i>' +
                '</button>' +
                '</td>' +
                '<input type="hidden" name="itemId[]" value="' + ajustItemId + '">' +
                '</tr>';

            ajustTableProccess.append(newRow); // Agregar la nueva fila a la tabla
            fullScreenTableModal.modal('hide'); // Cerrar el modal
        }
    });



    cancelCurrentAjust.on("click", function () {
        ajustTableProccess.empty();
    });

    ajustTableProccess.on("click", ".removebtn", function () {
        $(this).closest("tr").remove();
    });



    $("#createItem").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                response = JSON.parse(response);
                console.log(response['message']);
                $('#createItemErrorsAlerts').removeClass("d-none").addClass('d-block alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#createItemErrorsAlerts').addClass('d-none');
                }, 6000);
                if (response.status == 20) {
                    $('#createItem')[0].reset();
                    updateItemsTable();
                }
            },
            error: function (error) {
                console.log("SignupForm ajax request fail", error);
            }
        });
    });

    $('#searchTable').on('input', function () {
        updateItemsTable();
    });

    $('#searchFullTable').on('input', function () {
        updateItemsTable();
    });

    $('#searchAjustments').on('input', function () {
        updateAjustmentTable();
    });

    $("#delItemform").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                $('#deleteItemModal').modal('hide');
                updateUserTable();
                updateAjustmentTable();
            },
            error: function (error) {
                console.log("Algo salio mal", error)
            }
        });
    });



    $("#ajustmentform").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                response = JSON.parse(response);
                $('#ajustmentErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#ajustmentErrorsAlerts').addClass('hidden');
                }, 5000);
                if (response.status == 20) {
                    updateItemsTable();
                    updateAjustmentTable();
                    $('#ajustmentform')[0].reset();
                    ajustTableProccess.empty();
                }
            },
            error: function (error) {
                console.log("SignupForm ajax request fail", error);
            }
        });
    });
});
