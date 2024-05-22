<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content edit-item-modal" style="height: 30rem;">
            <form action="/dashboard/createItem" id="createItem" method="post" class="modal-form row">


                <div class="input-field col-12">
                    <label class="form-label align-self-start" for="editNombre">Nombre</label>
                    <input id="Itemname" class="input form-label " type="text" name="Itemname"> </input>
                </div>

                <div class="input-field col-12">
                    <label class="form-label align-self-start" for="editApellido">Descripcion</label>
                    <textarea id="description" class="input" type="textbox" name="itemDescription"></textarea>
                </div>


                <div class="input-field col-6">
                    <button type="submit" name="submit" class="btn submit btn-primary m-1">Crear</button>
                </div>

                <div class="input-field col-6">
                    <div type="button" class="btn btn-danger m-1" data-bs-dismiss="modal">Volver al menu</div>
                </div>

                <div id="createItemErrorsAlerts" class='hidden alert alert-primary mb-5 text-center' role='alert'></div>
            </form>
        </div>
    </div>
</div>


<!-- 
<div class="modal w-85 fade" id="AjustementsModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-ajustment modal-content">
            <form action="/dashboard/ajustments" id="ajustmentform" method="post" class="ajustment-form p-3 row">
                <div class="col-6 ajustments-item-info-container">
                    <h4 class="col-12 fs-2">Insumo a procesar</h4>
                    <div class="row">
                        <div class="input-group mb-3 col-12">
                            <button data-bs-toggle='modal' data-bs-target='#fullScreenTable' class="input-group-text fs-5" id="fullTableLaunch">Buscar</button>
                            <input id="searchItemAjustment" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-name mb-3 col-12">
                            <span class="fs-5">Nombre</span>
                            <input id="ajustItemName" name="itemName" type="text" disabled>
                        </div>


                        <div class="mb-3 col-12">
                            <span class="fs-5">Descripción</span>
                            <textarea id="ajustItemDescription" name="itemDescription" class="form-control" aria-label="With textarea" disabled></textarea>
                        </div>

                        <div class="input-group mb-3 col-12 d-flex row ">
                            <div class="form-check col-3 m-1">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Entrada
                                </label>
                            </div>

                            <div class="form-check col-3  m-1">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Salida
                                </label>
                            </div>

                            <div class="item-count col-4 gap-2 m-1   d-flex justify-content-center align-content-center">
                                <label class="form-label for=">Cantidad</label>
                                <input class=" form-control" type="number" name="" id="" checked>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-6 responsable-info-container">
                    <div class="row">
                        <h4 class="col-12 fs-2">Responsable</h4>

                        <div class="col-6 mb-3">
                            <span class="fs-5">Nombre</span>
                            <input disabled type="text" id="responsableName" class="" name="responsableName">
                        </div>
                        <div class="col-6 mb-3">
                            <span class="fs-5">Cédula</span>
                            <input disabled type="text" id="responsableCd" class="" name="responsableCd">
                        </div>
                        <div class="col-12">
                            <label for="ajustmentConcept" class="fs-5">Motivo de Ajuste</label>
                            <textarea class="w-100" name="ajustmentConcept" id="ajustmentConcept"></textarea>
                        </div>

                        <div class="col-12 p-5 ">
                            <button type="submit" class="btn m-1 bt-lg w-100 btn-primary">
                                Realizar ajuste
                            </button>

                            <button id="cancelCurrentAjust" type="button" class="btn m-1 bt-lg w-100 btn-danger" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>

                <div id="ajustmentErrorsAlerts" class='hidden alert alert-primary mb-5 text-center' role='alert'></div>
            </form>
        </div>
    </div>
</div>
 -->

<div class="modal fade" id="AjustementsModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-ajustment">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CreateModalLabel">Insumo a procesar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/ajustments" id="ajustmentform" method="post" class="ajustment-form p-3">
                    <div class="input-group mb-3">
                        <button type="button" data-bs-toggle='modal' data-bs-target='#fullScreenTable' class="input-group-text fs-5" id="fullTableLaunch">Buscar</button>
                        <input id="searchItemAjustment" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
                        <textarea  name="ajustRazon" id="AjusRazonTexarea" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary w-100 me-2">Realizar ajuste</button>
                        <button id="cancelCurrentAjust" type="button" class="btn btn-danger w-100 ms-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
                <div id="ajustmentErrorsAlerts" class='hidden alert alert-primary mt-3 text-center' role='alert'></div>
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