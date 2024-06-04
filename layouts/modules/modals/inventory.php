<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content edit-item-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel">Crear insumo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/createItem" id="createItem" method="post" class="modal-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Itemname" class="form-label">Nombre</label>
                        <input type="text" id="Itemname" name="Itemname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea id="description" name="itemDescription" class="form-control"></textarea>
                    </div>
                    <div id="createItemErrorsAlerts" class="text-center d-none" role="alert"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver al menú</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content edit-item-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel">Editar insumo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard/createItem" id="createItem" method="post" class="modal-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Itemname" class="form-label">Nombre</label>
                        <input type="text" id="Itemname" name="Itemname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea id="description" name="itemDescription" class="form-control"></textarea>
                    </div>
                    <div id="createItemErrorsAlerts" class="text-center alert alert-primary" role="alert">Editado exitoso</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Volver al menú</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="AjustementsModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-adjustment">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CreateModalLabel">Insumo a procesar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/adjustments" id="adjustmentform" method="post" class="adjustment-form p-3">
                    <div class="input-group mb-3">
                        <button type="button" data-bs-toggle='modal' data-bs-target='#fullScreenTable' class="input-group-text fs-5" id="fullTableLaunch">Buscar</button>
                        <input id="searchItemadjustment" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Operación</th>
                                    <th scope="col">Eliminar fila</th>
                                </tr>
                            </thead>
                            <tbody id="ajustTableProccess">
                             
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <label for="ajustRazon" class="form-label">Razón del ajuste</label>
                        <textarea  name="ajustRazon" default="0" id="AjusRazonTexarea" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary w-100 me-2">Realizar ajuste</button>
                        <button id="cancelCurrentAjust" type="button" class="btn btn-danger w-100 ms-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
                <div id="adjustmentErrorsAlerts" class='hidden alert alert-primary mt-3 text-center' role='alert'></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="fullScreenTable" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccionar Item para Ajuste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input id="searchFullTable" class="form-control" type="text" placeholder="Buscar">
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryFullViewTable">
                            <!-- Items will be dynamically filled here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer row">
                <div id="fullScreenTableModalErros" class="d-flex align-content-center justify-content-center col-12 alert hidden alert-primary"></div>
                <h5 class="modal-title col-5 text-start">Seleccione el item que desea agregar a la lista</h5>
                <button type="button" class="btn col-5 btn-danger align-self-end" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4>Estás apunto de eliminar un item.<br>
                    ¿Está seguro de realizar esta operación?
                </h4>
            </div>

            <form id="deliTemform" method="post" action="/dashboard/deleteItem" class="modal-footer">
                <input type="hidden" name="uid" value="">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button for="userDelete" name="submit" class="btn submit btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="adjustmentTable" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informes de ajuste de inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input id="searchadjustments" class="form-control" type="text" placeholder="Buscar">
                </div>
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
        
                                <th scope="col">item procesado</th>
                                <th scope="col">Por el usuario</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Razon</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="adjustmentsViewTable">
                            <!-- Items will be dynamically filled here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer row">
                <div id="fullScreenTableModalErros" class="d-flex align-content-center justify-content-center col-12 alert hidden alert-primary"></div>
                <button type="button" class="btn col-5 btn-danger align-self-end" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>