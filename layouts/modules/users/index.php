<div class="users-table-container  w-100 mt-5 ">
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
        <script src="../../../src/js/usersAjax.js"></script>
        <script>
            $(document).ready(function() {
                updateUserTable();
            });
        </script>
        <tbody id="usersViewTable">

        </tbody>
    </table>
</div>