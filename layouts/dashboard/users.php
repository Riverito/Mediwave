<?php
get_header();
?>
<div class="admin-container">
    <div class="row">
        <?php
        require_once(LAYOUTS_DIR . '/modules/sidebar.php');
        ?>
        <div class="col display-content d-flex align-items-center">
            <?php
            require_once(LAYOUTS_DIR . '/modules/clock.php');
            ?>
            <div class="container d-flex justify-content-end col-12 ">
                <button type='button' onclick="updateUserTable()" class='align-self-start btn-primary m-1 btn sm-btn'>
                    <i class="fa-solid fa-arrows-rotate"></i>
                </button>
            </div>
            <?php
            require_once(LAYOUTS_DIR . '/modules/users/index.php');
            ?>
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
require_once(LAYOUTS_DIR . '/modules/modals/users.php');
?>