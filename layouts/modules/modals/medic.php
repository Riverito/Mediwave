<div class="modal fade" id="newPacientModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- Aumenta el tamaño del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel">Datos Básicos del Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/createPatient" id="newPatientForm" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="patientName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="patientName" name="patientName" required>
                    </div>
                    <div class="col-md-6">
                        <label for="patientLastname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="patientLastname" name="patientLastname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="patientPhone" class="form-label">Número de Teléfono</label>
                        <input type="tel" class="form-control" id="patientPhone" name="patientPhone" placeholder="0414-1234567" required>
                    </div>
                    <div class="col-md-6">
                        <label for="patientAddress" class="form-label">Dirección</label>
                        <textarea class="form-control" id="patientAddress" name="patientAddress" rows="2" required></textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="HasCd" type="checkbox" role="switch" id="hasCedulaSwitch" checked>
                            <label class="form-check-label" for="hasCedulaSwitch">¿Posee cédula?</label>
                        </div>
                    </div>
                    <div class="col-md-6" id="cedulaField">
                        <label for="patientCd" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="patientCd" name="patientCd" placeholder="V-" required>
                    </div>
                    <div class="col-md-6">
                        <label for="patientDOB" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="patientDOB" name="patientDOB" required>
                    </div>
                    <div class="col-md-6">
                        <label for="patientGenre" class="form-label">Género del Paciente</label>
                        <select id="patientGenre" class="form-select" name="patientGenre" required>
                            <option value="">Seleccione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <div class="invalid-feedback">Por favor elija un género</div>
                    </div>
                    <div class="col-md-6">
                        <label for="patientBloodType" class="form-label">Tipo de Sangre</label>
                        <select id="patientBloodType" class="form-select" name="patientBloodType" required>
                            <option value="">Seleccione</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                        <div class="invalid-feedback">Por favor elija un tipo de sangre</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Historial Médico</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hasDiabetes" name="medicalHistory[]" value="Diabetes">
                            <label class="form-check-label" for="hasDiabetes">Diabetes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hasHypertension" name="medicalHistory[]" value="Hipertensión">
                            <label class="form-check-label" for="hasHypertension">Hipertensión</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hasCardiovascular" name="medicalHistory[]" value="Enfermedad Cardiovascular">
                            <label class="form-check-label" for="hasCardiovascular">Enfermedad Cardiovascular</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hasAsthma" name="medicalHistory[]" value="Asma">
                            <label class="form-check-label" for="hasAsthma">Asma</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hasAllergies" name="medicalHistory[]" value="Alergias">
                            <label class="form-check-label" for="hasAllergies">Alergias</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hasKidneyDisease" name="medicalHistory[]" value="Enfermedad Renal">
                            <label class="form-check-label" for="hasKidneyDisease">Enfermedad Renal</label>
                        </div>
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
                <form action="/dashboard/AsignHistory" id="historyForm" method="post" class="adjustment-form p-3">
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
                            <input type="file" class="form-control" id="inputGroupFile04" name="fileUpload" aria-label="Upload">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary w-100 me-2">Asignar historial</button>
                        <button id="cancelHistoryAsingn" type="button" class="btn btn-danger w-100 ms-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
                <div id="adjustmentErrorsAlerts" class="hidden alert alert-primary mt-3 text-center" role="alert"></div>
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

            <form id="deliTemform" method="post" action="/dashboard/deleteItem" class="modal-footer">
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