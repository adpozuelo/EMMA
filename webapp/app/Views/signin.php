<body class="text-center">

  <main class="form-signin">
    <?= form_open('Signin') ?>
    <img class="mb-4" src="images/bootstrap-logo.svg" alt="" width="216" height="216">

    <?php if (isset($validation)): ?>
      <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif ?>

    <?php if (session()->getFlashdata('login_error')): ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('login_error') ?>
      </div>
    <?php endif ?>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Correo electrónico</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Contraseña</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Acceder</button>
    <?= form_close() ?>
    <p class="mt-5 mb-3 text-muted">&copy;</p>
  </main>

</body>

</html>