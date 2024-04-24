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