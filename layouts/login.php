<?php
get_header();
?>
<section class="login-section">

  <form action="/auth" method="post" class="login-form d-flex align-items-center justify-contetent-center" id>

    <img src="src/img/mediwave.svg" class="login-logo w-100">
    <div class="form-container w-100">
      <h2 class="h2">Inicio de sesion</h2>

      <div class="input-field">
        <label class="form-label" for="userEmail">Email</label>
        <input placeholder="alguien@gmail.com" class="input" name="userEmail">
      </div>

      <div class="input-field">
        <label class="form-label" for="pwd">Contraseña</label>
        <input class="input" type="input-field" name="pwd" placeholder="Contraseña">
      </div>

      <button class="btn btn-primary mb-2 col-6" type="submit" name="submit" class="btn">Iniciar Sesión</button>

      <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "campovacio")
          echo "<div class='alert alert-primary col-12 text-center' role='alert'>
          Por favor llena todos los campos!
        </div>";
        else  if ($_GET["error"] == "nombremal") {
          echo "<div class='alert alert-primary col-12 text-center' role='alert'>
          Este usuario no existe!
        </div>";
        } else  if ($_GET["error"] == "002") {
          echo "<div class='alert alert-primary col-12 text-center' role='alert'>
          Clave invalida!
        </div>";
        } else  if ($_GET["error"] == "001") {
          echo "<div class='alert alert-primary col-12 text-center' role='alert'>
          Este usuario no existe
        </div>";
        }
      }
      ?>
    </div>
  </form>
</section>
<?php
get_footer();
?>