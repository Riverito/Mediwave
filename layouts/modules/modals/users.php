<div class="modal fade" id="NewUserModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel">Registrar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/create" id="signupForm" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="newUserName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="newUserName" name="user_name">
                    </div>
                    <div class="col-md-6">
                        <label for="newUserSecondName" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="newUserSecondName" name="user_apellido">
                    </div>
                    <div class="col-12">
                        <label for="passwordField" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="passwordField" name="pwd">

                        </div>
                    </div>
                    <div class="col-12">
                        <label for="passwordField2" class="form-label">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="passwordField2" name="pwdrepeat">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="NewUserCd" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="NewUserCd" name="userCd" placeholder="V-">
                    </div>
                    <div class="col-12">
                        <label for="NewUserMail" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="NewUserMail" name="userEmail" placeholder="alguien@gmail.com">
                    </div>
                    <div class="col-12">
                        <label for="NewUserRol" class="form-label">Rol del usuario</label>
                        <select id="NewUserRol" class="form-select" name="userRol">
                            <option value="">Elija un rol para el usuario a registrar</option>
                            <option value="3">Enfermero</option>
                            <option value="2">Doctor</option>
                        </select>
                        <div class="invalid-feedback">Por favor elija un rol para el usuario</div>
                    </div>
                    <div class="col-12 text-center">
                        <div id="errorsAlerts" class="alert d-none alert-primary" role="alert"></div>
                    </div>
                    <div class="col-6">
                        <button type="submit" name="submit" class="btn btn-primary w-100">Registrar</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Volver al menú</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--  ########################################## DELETE USER MODAL ##########################################  -->

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4>Estás apunto de eliminar un usuario. Lo que eliminara su acceso al sistema<br>
                    ¿Está seguro de realizar esta operación?
                </h4>
            </div>

            <form id="delform" method="post" action="/dashboard/delete" class="modal-footer">
                <input type="hidden" name="uid" value="">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button for="userDelete" name="submit" class="btn submit btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>


<!--  ########################################### EDIT USER MODAL  ##########################################  -->

<div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel">Modificar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/update" id="editForm" method="post" class="row g-3">

                    <input type="hidden" name="uid" value="">

                    <div class="col-md-6">
                        <label for="editNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editNombre" name="editNombre">
                    </div>

                    <div class="col-md-6">
                        <label for="editApellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="editApellido" name="editApellido">
                    </div>

                    <div class="col-12">
                        <label for="editUserCd" class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="editUserCd" name="editUserCd" placeholder="V-">
                    </div>

                    <div class="col-12">
                        <label for="editEmail" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="editEmail" name="editMail" placeholder="alguien@gmail.com">
                    </div>

                    <div class="col-12">
                        <label for="editRol" class="form-label">Cambiar rol</label>
                        <select id="editRol" class="form-select" name="editRol">
                            <option value="">Seleccione un rol</option>
                            <option value="3">Enfermero</option>
                            <option value="2">Doctor</option>
                        </select>
                        <div class="invalid-feedback">Por favor elija un rol para el usuario</div>
                    </div>

                    <div class="col-6">
                        <button type="submit" class="btn btn-primary w-100">Modificar</button>
                    </div>

                    <div class="col-6">
                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Volver al menú</button>
                    </div>

                    <div id="editErrorsAlerts" class="alert alert-primary d-none text-center mt-3" role="alert"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  ########################################## New item Modal  ##########################################  -->

