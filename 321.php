<?php
include('functions.php');
require_once('modals.php');
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
                <button type="button" class="box-item btn col-12 btn-md box-item">
                    <h5>Historial Medico</h5>
                </button>
                <button class="box-item btn btn-md col-12 box-item">
                    <h5>Inventario</h5>
                </button>
                <button class="box-item btn btn-md col-12 box-item">
                    <h5>Citas</h5>
                </button>
            </div>

            <div class="bottom-box">
                <form class="w-100" method="post" action="functions.php">
                    <button type="submit" name="submit" class="btn btn-lg col-12 box-item">Salir</button>
                </form>
            </div>
        </div>

        <div class="col display-content d-flex align-items-center">
            <div id="reloj">
                <?php date_default_timezone_set("America/Caracas"); ?>
                <?php echo date("H:i"); ?>
            </div>
            <div class="users-container w-100 mt-5 ">
                <table id="usersViewTable" class="table table-striped table-bordered">
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
                    <tbody>
                        <?php
                        $sql1 = "SELECT * FROM roles";
                        $result1 = mysqli_query($conn, $sql1);
                        $row_roles = mysqli_fetch_all($result1, MYSQLI_ASSOC);

                        $sql2 = "SELECT * FROM users";
                        $result2 = mysqli_query($conn, $sql2);
                        while ($row2 = mysqli_fetch_array($result2)) {
                            $cargo = '';

                        ?>
                            <tr>
                                <td>
                                    <?php echo $row2["usersName"]; ?>
                                </td>
                                <td>
                                    <?php echo $row2["userApellido"]; ?>
                                </td>
                                <td>
                                    <?php echo $row2["userCd"]; ?>
                                </td>
                                <td>
                                    <?php echo $row2["userEmail"]; ?>
                                </td>
                                <td>
                                    <?php
                                    $done = false;
                                    foreach ($row_roles as $row1) {
                                        $done = false;
                                        if ($row1['role_id'] == $row2["userRol"]) {
                                            echo $row1['role_name'] . '<br>';
                                            $done = true;
                                        }
                                    }
                                    ?>
                                </td>

                                <td>
                                    <button type='button' data-bs-toggle='modal' data-bs-target='#EditUserModal' class='editbtn btn btn-primary' data-uid="<?php echo $row2["user_id"]; ?>">
                                        <i class='fa-solid fa-pen-to-square'></i>
                                    </button>

                                    <button type='button' data-bs-toggle='modal' data-bs-target='#deleteModal' class='delbtn btn btn-danger' data-uid="<?php echo $row2["user_id"]; ?>">
                                        <i class='fa-solid fa-trash'></i>
                                    </button>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button type='button' data-bs-toggle='modal' data-bs-target='#NewUserModal' class='align-self-start m-1 btn btn-danger'>
                Nuevo usuario
            </button>
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
get_footer();
?>