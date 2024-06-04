<?php
get_header();
?>
<div class="inventory-container">
    <div class="row">
        <?php
        require_once(LAYOUTS_DIR . '/modules/sidebar.php');
        ?>
        <div class="col display-content d-flex align-items-center">
            <?php
            require_once(LAYOUTS_DIR . '/modules/clock.php');
            ?>
            <input id="searchTable" class="search-input align-self-start mt-5" type="text" placeholder="Buscar">

            <?php
            require_once(LAYOUTS_DIR . '/modules/inventory/index.php');
            ?>
            <div class="w-100 d-flex align-items-start justify-content-start">
                <button type='button' data-bs-toggle='modal' data-bs-target='#newItemModal' class='align-self-start btn-primary m-1 btn sm-btn'>
                    Crear articulo
                </button>
                <button type='button' data-bs-toggle='modal' data-bs-target='#AjustementsModal' class='align-self-start btn-primary m-1 btn sm-btn'>
                    Ajuste de inventario
                </button>

                <button type='button' data-bs-toggle='modal' data-bs-target='#adjustmentTable' class='align-self-start btn-primary m-1 btn sm-btn'>
                    Reportes de inventario
                </button>
            </div>
        </div>
    </div>



</div>
<?php
get_footer();
require_once(LAYOUTS_DIR . '/modules/modals/inventory.php');
?>