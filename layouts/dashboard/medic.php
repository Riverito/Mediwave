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
            require_once(LAYOUTS_DIR . '/modules/medic/index.php');
            ?>
            <div class="w-100 d-flex align-items-start justify-content-start">
                <button type='button' data-bs-toggle='modal' data-bs-target='#newPacientModal' class='align-self-start btn-primary m-1 btn sm-btn'>
                    Crear paciente
                </button>

                <button id="inventoryDashBoard" class="align-self-start btn-primary m-1 btn sm-btn" data-bs-toggle="modal" data-bs-target="#sutmitPatienHistory">
                   Asignar historial médico
            </div>
        </div>
    </div>



</div>
<?php
get_footer();
require_once(LAYOUTS_DIR . '/modules/modals/medic.php');
?>