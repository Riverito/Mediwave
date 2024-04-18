<?php
include('functions.php');
get_header();
?>
<div class="inventory-container">
    <div class="row">
        <aside class="col-2 p-3 text-center navigation-bar">
            <div class="w-100">
                <div>
                    <img src="sources\images\mediwave.svg" class="logo">
                </div>
            </div>
            <div class="w-100">
                <button type="button" class="btn col-12 lg-btn">
                    <h5>Configuracion</h5>
                </button>
                <button id="inventoryDashBoard" class="btn col-12 lg-btn">
                    <h5>Generar Reporte</h5>
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
            <input class="search-input align-self-start mt-5" type="text" placeholder="Buscar">
            <div class="users-container  w-100">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Operaciones</th>
                        </tr>
                    </thead>
                    <script>
                        $(document).ready(function() {
                            updateItemsTable();
                        });
                    </script>
                    <tbody id="itemsViewTable">

                    </tbody>
                </table>
            </div>

            <div class="w-100 d-flex align-items-start justify-content-start">
                <button type='button' data-bs-toggle='modal' data-bs-target='#NewItemModal' class='align-self-start btn-primary m-1 btn sm-btn'>
                    Crear articulo
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