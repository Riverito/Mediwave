function updateItemsTable() {
    $.ajax({
        url: '/inventory/index',
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

function updateadjustmentTable() {
    $.ajax({
        url: '/inventory/adjustments',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response) {
                console.log(response);
                renderadjustments(response);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
    
}

function renderadjustments(adjustments) {
    var searchText = $('#searchadjustments').val().toLowerCase();
    var filteredadjustments = adjustments.filter(function (adjustment) {
        return adjustment.nameItem.toLowerCase().includes(searchText) ||
            adjustment.usersName.toLowerCase().includes(searchText);
    });

    var tbody = '';
    filteredadjustments.forEach(function (adjustment) {
        tbody += '<tr>' +
            '<td>' + adjustment.nameItem + '</td>' +
            '<td>' + adjustment.usersName + '</td>' +
            '<td>' + adjustment.adjustmentAmount + '</td>' +
            '<td>' + adjustment.adjustmentReason + '</td>' +
            '<td>' + adjustment.adjustmentDateTime + '</td>' +
            '</tr>';
    });

    $('#adjustmentsViewTable').html(tbody);
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
            '<button type="button" data-bs-toggle="modal" data-bs-target="#deleteItemModal" class="delbtn m-1 btn btn-danger" data-uid="' + item.idItem + '">' +
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
    updateadjustmentTable();

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
                }, 3000);
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

    $('#searchadjustments').on('input', function () {
        updateadjustmentTable();
    });

    $(document).on('click', '.delbtn', function () {
        let operationId = $(this).data('uid');
        $('#delItemForm>input[name="uid"]').val(operationId);
        updateUserTable();
    });

    $("#delItemForm").submit(function (e) {
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: '/inventory/delete',
            data: $(this).serialize(),
            success: function (response) {
                response = JSON.parse(response);
                $('#delItemErrorsAlerts')
                    .removeClass("d-none alert-primary alert-danger")
                    .addClass('d-block w-100 alert alert-primary')
                    .text(response.message)
                    .show();
    
                setTimeout(function () {
                    $('#delItemErrorsAlerts').addClass('d-none');
                }, 3000);
    
                if (response.status === 2) {
                    updateItemsTable();
                }
            },
            error: function (error) {
                console.log("Algo salió mal", error);
    
                $('#delItemErrorsAlerts')
                    .removeClass("d-none alert-primary")
                    .addClass('d-block alert alert-danger')
                    .text('Ha ocurrido un error al procesar la solicitud.')
                    .show();
    
                setTimeout(function () {
                    $('#delItemErrorsAlerts').addClass('d-none');
                }, 3000);
            }
        });
    });
    

    $("#adjustmentform").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/inventory/adjustments/create',
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                response = JSON.parse(response);
                $('#adjustmentErrorsAlerts').removeClass("hidden").addClass('alert alert-primary').text(response.message).show();
                setTimeout(function () {
                    $('#adjustmentErrorsAlerts').addClass('hidden');
                }, 3000);
                if (response.status == 20) {
                    updateItemsTable();
                    updateadjustmentTable();
                    $('#adjustmentform')[0].reset();
                    ajustTableProccess.empty();
                }
            },
            error: function (error) {
                console.log("SignupForm ajax request fail", error);
            }
        });
    });
});
