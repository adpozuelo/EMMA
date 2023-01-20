<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3 class="h3">
      <?= $title ?>
    </h3>
  </div>
  <div class="signup-form">
    <?= form_open('/sensors/modify/'.$sensor['name']) ?>
    <?php if(isset($validation)): ?>
    <div class="alert alert-danger" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <?= $validation->listErrors() ?>
    </div>
    <?php endif ?>
    <input type="hidden" id="name" name="name" value="<?= $sensor['name'] ?>">
    <input type="hidden" id="type" name="type" value="<?= $sensor['type'] ?>">
    <?php
      $type_th = 'text';
      $type_db = 'hidden';
      if ($sensor['type'] == 'DB') {
        $type_th = 'hidden';
        $type_db = 'text';
      }
    ?>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="<?= $type_th ?>" name="warning_temp" class="form-control" id="wtFloatingInput" placeholder="Temperatura aviso"
        value="<?= $sensor['warning_temp'] ?>">
      <label for="wtFloatingInput">Temperatura aviso</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="<?= $type_th ?>" name="critical_temp" class="form-control" id="ctFloatingInput"
        placeholder="Temperatura crítica" value="<?= $sensor['critical_temp'] ?>">
      <label for="ctFloatingInput">Temperatura crítica</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="<?= $type_th ?>" name="warning_hum" class="form-control" id="whFloatingInput" placeholder="Humedad aviso"
        value="<?= $sensor['warning_hum'] ?>">
      <label for="whFloatingInput">Humedad aviso</label>
    </div>
    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <input type="<?= $type_th ?>" name="critical_hum" class="form-control" id="chFloatingInput" placeholder="Humedad crítica"
        value="<?= $sensor['critical_hum'] ?>">
      <label for="chFloatingInput">Humedad crítica</label>
    </div>

    <div class="form-floating" style="margin: auto; margin-bottom: 10px; width: 50%;">
      <button class="w-100 center btn btn-lg btn-primary" type="submit">Modificar</button>
    </div>
    <?= form_close() ?>
  </div>
</main>
</div>
</div>