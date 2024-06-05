<aside class="col-2 p-3 text-center navigation-bar">
    <div class="w-100">
        <div>
            <img src="src/img/mediwave.svg" class="logo">
        </div>
    </div>

    <div class="w-100">
        <?php
        $access = routeAccessController();
        $AC = [1];
        if( in_array($access, $AC) ){
        ?>
        <a href="/users">
            <button type="button" class="btn col-12 lg-btn">
                <h5>Usuarios</h5>
            </button>
        </a>
        <?php
        }
        $AC = [2,1];
        if( in_array($access, $AC) ){
        ?>
        <a href="/medical-records">
            <button type="button" class="btn col-12 lg-btn">
                <h5>Historial Medico</h5>
            </button>
        </a>
        <?php
        }
        $AC = [3,1];
        if( in_array($access, $AC) ){
        ?>
        <a href="/inventory">
            <button id="inventoryDashBoard" class="btn col-12 lg-btn">
                <h5>Inventario</h5>
            </button>
        </a>
        <?php
        }
        ?>
    </div>
    <div class="w-100">
        <a href="/logout">
            <button class="btn col-12 lg-btn">Cerrar Sesión</button>
        </a>
    </div>

</aside>