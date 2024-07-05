<?php
get_header();
?>
<section class="login-section">

  <form action="/auth" id="loginForm" method="post" class="login-form d-flex align-items-center justify-contetent-center">

    <img src="src/img/mediwave.svg" class="login-logo w-100">
    <div class="form-container w-100">
      <h2 class="h2">Inicio de sesión</h2>

      <div class="input-field">
        <label class="form-label" for="userEmail">Email</label>
        <input placeholder="alguien@gmail.com" class="input" name="userEmail">
      </div>

      <div class="input-field">
        <label class="form-label" for="pwd">Contraseña</label>
        <input class="input" type="password" name="pwd" placeholder="Contraseña">
      </div>

      <button class="btn btn-primary mb-2 col-6" type="submit" name="submit" class="btn">Iniciar Sesión</button>
      <div id="loginErrorsAlerts" class=' w-75 d-none alert alert-primary text-center' role='alert'></div>
    </div>
  </form>
</section>
<?php
get_footer();
?>