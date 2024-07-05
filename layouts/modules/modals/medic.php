<div class="modal fade" id="newPacientModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel">datos básicos del paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/createPatient" id="newPatientForm" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="patientName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="patientName" name="patientName">
                    </div>
                    <div class="col-md-6">
                        <label for="patientLastname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="patientLastname" name="patientLastname">
                    </div>
                    <div class="form-check form-switch col-12">
                        <input class="form-check-input" name="HasCd" type="checkbox" role="switch" id="hasCedulaSwitch" checked>
                        <label class="form-check-label" for="hasCedulaSwitch">¿Posee cédula?</label>
                    </div>
                    <div class="col-md-6" id="cedulaField">
                        <label for="patientCd" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="patientCd" name="patientCd" placeholder="V-">
                    </div>
                    <div class="col-md-6">
                        <label for="patientAge" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="patientAge" name="patientAge">
                    </div>
                    <div class="col-md-6">
                        <label for="patientGenre" class="form-label">Género del paciente</label>
                        <select id="patientGenre" class="form-select" name="patientGenre">
                            <option value="">Seleccione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        <div class="invalid-feedback">Por favor elija un género</div>
                    </div>
                    <div class="col-12 text-center">
                        <div id="createPatientsErrorsAlerts" class="alert alert-primary d-none" role="alert"></div>
                    </div>
                    <div class="col-6">
                        <button type="submit" name="submit" class="btn btn-primary w-100">Crear</button>
                    </div>
                    <div class="col-6">
                        <button type="button" id="CancelNewPatient" class="btn btn-danger w-100" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="sutmitPatienHistory" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-adjustment">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CreateModalLabel">Asignar historia médica</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/AsignHistory" id="historyForm" enctype="multipart/form-data" method="post" class="adjustment-form p-3">
                    <div class="input-group mb-3">
                        <button type="button" data-bs-toggle='modal' data-bs-target='#FullpatientsViews' class="input-group-text fs-5" id="fullTableLaunch">Buscar</button>
                        <input id="searchPatient" class="form-control" aria-label="Buscar paciente" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="mb-3">
                        <label for="Itemname" class="form-label">Nombre</label>
                        <input type="text" id="HpatienName" disabled name="Itemname" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="ItemSecondName" class="form-label">Segundo Nombre</label>
                        <input type="text" id="HpatienSecondName" disabled name="ItemSecondName" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="ItemCd" class="form-label">Cédula</label>
                        <input type="text" id="HpatienCd" disabled name="ItemCd" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="inputGroupFile04" class="form-label">Subir archivo</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="inputfile" name="fileUpload" aria-label="Upload">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary w-100 me-2">Asignar historial</button>
                        <button id="cancelHistoryAsingn" type="button" class="btn btn-danger w-100 ms-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <input type="hidden" name="patient_id" id="Hpatient_id" value="">
                </form>
                <div id="HistoryAsignErrors" class="d-none alert alert-primary mt-3 text-center" role="alert"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deletePacientModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4>Estás apunto de eliminar un paciente.<br>
                    Esto es un proceso irreversible.<br>
                    ¿Está seguro de realizar esta operación?
                </h4>
            </div>

            <form id="delpacient" method="post" action="/dashboard/delete" class="modal-footer">
                <div id="delpatientErrorsAlerts" class='d-none alert alert-primary mt-3 text-center' role='alert'></div>
                <input type="hidden" name="uid" value="">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button for="userDelete" name="submit" class="btn submit btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="FullpatientsViews" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccionar paciente para asignar historia médica</h5>
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
                                <th scope="col">Segundo Nombre</th>
                                <th scope="col">Cedula</th>
                            </tr>
                        </thead>
                        <tbody id="patientsFullViewTable">
                            <!-- Items will be dynamically filled here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer row">
                <div id="fullScreenTableModalErros" class="d-flex align-content-center justify-content-center col-12 alert hidden alert-primary"></div>
                <h5 class="modal-title col-5 text-start">Seleccione el paciente al que quiere asignar un historial</h5>
                <button type="button" class="btn col-5 btn-danger align-self-end" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>