<?php
include('functions.php');
get_header();
?>
<div class="main-container">
    <div class="row">
        <div class="col-2 p-3 text-center navigation-bar">
            <div class="top-box">
                <div>
                    <img src="sources\images\mediwave.svg" class="logo">
                </div>
            </div>
            <div class="middle-box">

            </div>
            <div class="bottom-box">
                <form class="w-100" method="post" action="functions.php">
                    <button type="submit" name="submit" class="btn btn-lg col-12 box-item">Salir</button>
                </form>
            </div>
        </div>

        <div class="col display-content d-flex">
            <div class="row d-flex mt-3">
                <div class="align-self-start col-6">
                    <h1 class="h2">Sistema de inventario</h1>
                    <input type="text" class="input-label" placeholder="buscar">    
                </div>

                <div id="reloj" class="align-self-end col-6">
                    <?php date_default_timezone_set("America/Caracas"); ?>
                    <?php echo date("H:i"); ?>
                </div>
            </div>

            <div class="users-container w-100 mt-5 ">
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
                <button type='button' data-bs-toggle='modal' data-bs-target='#NewUserModal' class='btn-info align-self-start m-1 btn'>
                    Nuevo usuario
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>

<?php
require_once('modals.php');
get_footer();
?>