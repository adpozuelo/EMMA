<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
      <?= $title ?>
    </h1>
  </div>
  <div class="signup-form">
    <?= form_open('/raspis/modify/'.$raspi['hostname']) ?>
    <?php if(isset($validation)): ?>
    <div class="alert alert-danger" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <?= $validation->listErrors() ?>
    </div>
    <?php endif ?>
    <input type="hidden" id="name" name="name" value="<?= $raspi['hostname'] ?>">
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="text" name="location" class="form-control" id="locFloatingInput" placeholder="Localización"
        value="<?= $raspi['location'] ?>">
      <label for="locFloatingInput">Localización</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="text" name="ip_address" class="form-control" id="ipFloatingInput" placeholder="Dirección IP"
        value="<?= $raspi['ip_address'] ?>">
      <label for="ipFloatingInput">Dirección IP</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <button class="w-100 center btn btn-lg btn-primary" type="submit">Modificar</button>
    </div>
    <?= form_close() ?>
  </div>
</main>
</div>
</div>