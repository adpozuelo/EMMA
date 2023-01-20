<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3 class="h3">
      <?= $title ?>
    </h3>
  </div>
  <div class="signup-form">
    <?= form_open('/users/modify/'.$user['id']) ?>
    <?php if(isset($validation)): ?>
    <div class="alert alert-danger" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <?= $validation->listErrors() ?>
    </div>
    <?php endif ?>
    <input type="hidden" id="id" name="id" value="<?= $user['id'] ?>">
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="text" name="username" class="form-control" id="userFloatingInput" placeholder="Usuario"
        value="<?= $user['username'] ?>">
      <label for="userFloatingInput">Usuario</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com"
        value="<?= $user['email'] ?>">
      <label for="floatingInput">Correo electrónico</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="password" name="password" class="form-control" id="passFloatingPassword" placeholder="Password">
      <label for="passFloatingPassword">Contraseña</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="password" name="password_conf" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Confirmar contraseña</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <select name="group" class="form-select" id="floatingSelect">
        <?php
                if ($user['group'] == 'user')
                  echo '<option selected value="user">Usuario</option><option value="admin">Administrador</option>';
                else if ($user['group'] == 'admin')
                  echo '<option value="user">Usuario</option><option selected value="admin">Administrador</option>';
              ?>
      </select>
      <label for="floatingSelect">Selecciona grupo</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <button class="w-100 center btn btn-lg btn-primary" type="submit">Modificar</button>
    </div>
    <?= form_close() ?>
  </div>
</main>
</div>
</div>