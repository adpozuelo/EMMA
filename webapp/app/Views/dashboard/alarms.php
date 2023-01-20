<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3 class="h3">
      <?= esc($title) ?>
    </h3>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Nodo</th>
          <th scope="col">Raspberry</th>
          <th scope="col">Sensor</th>
          <th scope="col">Fecha</th>
          <th scope="col">Notificada</th>
          <th scope="col">Mensaje</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($alarms) && is_array($alarms)) : ?>
        <?php foreach ($alarms as $alarm): ?>
        <tr>
          <td>
            <?php 
              $add_button = [
                      'type'    => 'button',
                      'class'   => 'btn btn-sm btn-outline-secondary',
                      'content' => '<span data-feather="alert-triangle"></span>',
                      'disabled' => 'true'
                      ];
              echo form_button($add_button);
            ?>
          </td>
          <td>
            <?php
              if (isset($alarm['node_id'])) {echo esc($alarm['node_id']);}
              else {echo esc('--');}
            ?>
          </td>
          <td>
            <?php
              if (isset($alarm['raspberry_id'])) {echo esc($alarm['raspberry_id']);}
              else {echo esc('--');}
            ?>
          </td>
          <td>
            <?php
              if (isset($alarm['sensor_id'])) {echo esc($alarm['sensor_id']);}
              else {echo esc('--');}
            ?>
          </td>
          <td>
            <?php 
              $fecha = DateTime::createFromFormat('ymdHi', $alarm['date'])
                        ->format('d/m/Y H:i');
              echo esc($fecha);
            ?>
          </td>
          <td>
            <?php
              if ($alarm['notified'] == 1)
                echo '<span style="color:green">'.esc('Sí').'</span>';
              else if($alarm['notified'] == 0)
                echo '<span style="color:red">'.esc('No').'</span>';
            ?>
          </td>
          <td>
            <?= esc($alarm['msg']) ?>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</main>
</div>
</div>