<?php
include_once 'header.php';
?>

<section class="login-section text-center">

  <form action="includes/login.inc.php" method="post" class="login-container ">

      <img src="sources\images\mediwave.svg" class="logo" style="margin-right: 73px;">

    <h2>Iniciar Sesión</h2>
    <div class="input-field">
      <label class="form-label align-self-start" for="userEmail">Email</label>
      <input placeholder="alguien@gmail.com" class="input" name="userEmail">
    </div>

    <div class="input-field">
      <label class="form-label align-self-start" for="pwd">Contraseña</label>
      <input class="input" type="input-field" name="pwd">
    </div>

    <button class="btn btn-primary mb-2 col-6" type="submit" name="submit" class="btn">Iniciar Sesión</button>

    <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "campovacio")
        echo "<div class='alert alert-primary col-12' role='alert'>
                Por favor llena todos los campos!
              </div>";
      else  if ($_GET["error"] == "nombremal") {
        echo "<div class='alert alert-primary col-12' role='alert'>
                Este usuario no existe!
              </div>";
      } else  if ($_GET["error"] == "clavemal") {
        echo "<div class='alert alert-primary col-12' role='alert'>
                Clave invalida!
              </div>";
      } else  if ($_GET["error"] == "usernoexiste") {
        echo "<div class='alert alert-primary col-12' role='alert'>
                Este usuario no existe!
              </div>";
      }
    }
    ?>
  </form>
</section>


