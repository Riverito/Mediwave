<?php
require_once('functions.php');
?>
<div class="modal fade" id="NewUserModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content register-modal-container">
            <form action="includes/signup.inc.php" id="signupForm" method="post" class="register-modal-form row">

                <div class="input-field col-6">
                    <label class="form-label align-self-start" for="nombre">Nombre</label>
                    <input id="newUserName" class="input form-label " type="text" name="user_name">
                </div>

                <div class="input-field col-6">
                    <label class="form-label align-self-start" for="apellido">Apellido</label>
                    <input id="newUserSecondName" class="input" type="text" name="user_apellido">
                </div>

                <div class="password-field col-12">
                    <label class="form-label align-self-start" for="pwd">Contraseña</label>
                    <div class="input-eye w-100">
                        <input class="input col-10" id="passwordField" type="password" name="pwd">
                        <img class="eye-icon col-2" id="eye-icon" src="sources/images/eye-close.png" alt="">
                    </div>
                </div>

                <div class="password-field col-12">
                    <label class="form-label align-self-start" for="pwdrepeat">Confirmar Contraseña</label>
                    <div class="input-eye w-100">
                        <input class="input" id="passwordField2" type="password" name="pwdrepeat">
                        <img class="eye-icon" id="eye-icon2" src="sources/images/eye-close.png" alt="">
                    </div>
                </div>

                <div class="input-field col-12">
                    <label class="form-label align-self-start" for="userCd">Cédula</label>
                    <input id="NewUserCd" placeholder="V-" class="input" type="input-field" name="userCd">
                </div>

                <div class="input-field">
                    <label class="form-label align-self-start" for="userMail">Correo electrónico</label>
                    <input id="NewUserMail" placeholder="alguien@gmail.com" class="input" type="input-field" name="userEmail">
                </div>

                <div class="mb-3">
                    <select id="NewUserRol" class="form-select" aria-label="select example" name="userRol">
                        <option value="">Elija un rol para el usuario a registrar</option>
                        <option value="3">Enfermero</option>
                        <option value="2">Doctor</option>
                    </select>
                    <div class="invalid-feedback">Por favor elija un rol para el usuario</div>
                </div>

                <div class="input-field col-6 mt-1">
                    <button type="submit" name="submit" class="btn submit btn-primary m-1">Registrar</button>
                </div>

                <div class="input-field col-6 mt-1">
                    <div type="button" class="btn btn-danger m-1" data-bs-dismiss="modal">Volver al menu</div>
                </div>

                <div id="errorsAlerts" class='hidden alert alert-primary mb-5 text-center' role='alert'></div>
            </form>
        </div>
    </div>
</div>

<!-- ##########################################DELETE USER MODAL########################################## -->

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Advertencia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4>Estás apunto de eliminar un usuario.<br>
                    ¿Está seguro?
                </h4>
            </div>

            <form id="delform" method="post" action="includes/dataDrive.inc.php" class="modal-footer">
                <input type="hidden" name="uid" value="">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button for="userDelete" name="submit" class="btn submit btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>


<!-- ##########################################EDIT USER MODAL ########################################## -->

<div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content register-modal-container">
            <form action="includes/edit.inc.php" id="editForm" method="post" class="register-modal-form row">

                <input type="hidden" name="uid" value="">

                <div class="input-field col-6">
                    <label class="form-label align-self-start" for="editNombre">Nombre</label>
                    <input id="editNombre" class="input form-label " type="text" name="editNombre"> </input>
                </div>

                <div class="input-field col-6">
                    <label class="form-label align-self-start" for="editApellido">Apellido</label>
                    <input id="editApellido" class="input" type="text" name="editApellido">
                </div>

                <div class="input-field col-12">
                    <label class="form-label align-self-start" for="editUserCd">Cédula</label>
                    <input placeholder="V-" id="editUserCd" class="input" type="input-field" name="editUserCd">
                </div>

                <div class="input-field">
                    <label class="form-label align-self-start" for="userMail">Correo electrónico</label>
                    <input placeholder="alguien@gmail.com" id="editEmail" class="input" type="input-field" name="editMail">
                </div>

                <div class="mb-3">
                    <select id="editRol" class="form-select" aria-label="select example" name="editRol">
                        <option value="">Cambiar rol</option>
                        <option value="3">Enfermero</option>
                        <option value="2">Doctor</option>
                    </select>
                    <div class="invalid-feedback">Por favor elija un rol para el usuario</div>
                </div>

                <div class="input-field col-6 mt-1">
                    <button type="submit" name="submit" class="btn submit btn-primary m-1">Modificar</button>
                </div>
                <input type="hidden" name="uid" value="">
                <div class="input-field col-6 mt-1">
                    <div type="button" class="btn btn-danger m-1" data-bs-dismiss="modal">Volver al menu</div>
                </div>

                <div id="editErrorsAlerts" class='hidden alert alert-primary mb-5 text-center' role='alert'></div>
            </form>
        </div>
    </div>
</div>