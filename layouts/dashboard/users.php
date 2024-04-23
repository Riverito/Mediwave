<?php
get_header();
?>
<div class="admin-container">
    <div class="row">
        <aside class="col-2 p-3 text-center navigation-bar">
            <div class="w-100">
                <div>
                    <img src="src/img/mediwave.svg" class="logo">
                </div>
            </div>
            <div class="w-100">
                <button type="button" class="btn col-12 lg-btn">
                    <h5>Historial Medico</h5>
                </button>
                <button id="inventoryDashBoard" class="btn col-12 lg-btn">
                    <h5>Inventario</h5>
                </button>
            </div>
            <div class="w-100">
                <form class="w-100" method="post" action="functions.php">
                    <button type="submit" name="submit" class="btn col-12 lg-btn">Salir</button>
                </form>
            </div>
        </aside>

        <div class="col display-content d-flex align-items-center">
            <div id="reloj">
                <?php date_default_timezone_set("America/Caracas"); ?>
                <?php echo date("H:i"); ?>
            </div>
            <div class="users-container  w-100 mt-5 ">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Operaciones</th>
                        </tr>
                    </thead>
                    <script>
                        $(document).ready(function() {
                            updateUserTable();
                        });
                    </script>
                    <tbody id="usersViewTable">

                    </tbody>
                </table>
            </div>
            <div class="w-100 d-flex align-items-start justify-content-start">
                <button type='button' data-bs-toggle='modal' data-bs-target='#NewUserModal' class='align-self-start btn-primary m-1 btn sm-btn'>
                    Nuevo usuario
                </button>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
require_once(LAYOUTS_DIR.'/modals/modals.php');
?>