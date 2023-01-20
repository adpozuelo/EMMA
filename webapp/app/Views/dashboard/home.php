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
          <th scope="col">Sensor</th>
          <th scope="col">Fecha</th>
          <th scope="col">Temp</th>
          <th scope="col">T(a)-T</th>
          <th scope="col">T(c)-T</th>
          <th scope="col">Hum</th>
          <th scope="col">H(a)-H</th>
          <th scope="col">H(c)-H</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($sensors) && is_array($sensors)) : ?>
        <?php foreach ($sensors as $sensor): ?>
        <tr>
          <td>
            <?php 
              $add_button = [
                      'type'    => 'button',
                      'class'   => 'btn btn-sm btn-outline-secondary',
                      'content' => '<span data-feather="play"></span>',
                      'disabled' => 'true'
                      ];
              echo form_button($add_button);
            ?>
          </td>
          <td>
            <?php
              if (!$sensor['status'])
                echo '<span style="color:red">'.esc($sensor['sensor_id']).' is disabled</span>';
              else if (!$sensor['online']) 
                echo '<span style="color:orange">'.esc($sensor['sensor_id']).' is offline</span>';
              else
                echo '<span style="color:green">'.esc($sensor['sensor_id']).'</span>';
            ?>
          </td>
          <td>
            <?php
              if (!$sensor['status'] || !$sensor['online']) {$fecha = '--';}
              else {$fecha = DateTime::createFromFormat('ymdHi', $sensor['date'])->format('d/m/Y H:i');}
              echo esc($fecha);
            ?>
          </td>
          <td>
            <?php
              if ($sensor['temp'] <= 0 || !$sensor['status'] || !$sensor['online']) {echo esc('--');}
              else {echo esc($sensor['temp'].' ºC');}               
            ?>
          </td>
          <td>
            <?php
              if ($sensor['temp'] <= 0 || !$sensor['status'] || !$sensor['online']) {echo esc('--');}
              else {
                if ($sensor['wt_diff'] <= 0.5) {
                  echo '<span style="color:red">'.esc($sensor['wt_diff']).' ºC</span>';
                } else if ($sensor['wt_diff'] < 1.5) {
                  echo '<span style="color:orange">'.esc($sensor['wt_diff']).' ºC</span>';
                } else {
                  echo '<span style="color:green">'.esc($sensor['wt_diff']).' ºC</span>';
                }
              }
            ?>
          </td>
          <td>
            <?php
              if ($sensor['temp'] <= 0 || !$sensor['status'] || !$sensor['online']) {echo esc('--');}
              else {
                if ($sensor['ct_diff'] <= 0.5) {
                  echo '<span style="color:red">'.esc($sensor['ct_diff']).' ºC</span>';
                } else if ($sensor['ct_diff'] < 1.5) {
                  echo '<span style="color:orange">'.esc($sensor['ct_diff']).' ºC</span>';
                } else {
                  echo '<span style="color:green">'.esc($sensor['ct_diff']).' ºC</span>';
                }
              }
            ?>
          </td>
          <td>
            <?php
            if ($sensor['hum'] <= 0 || !$sensor['status'] || !$sensor['online']) {echo esc('--');}
            else {echo esc($sensor['hum'].' %');}
            ?>
          </td>
          <td>
            <?php
                if ($sensor['hum'] <= 0 || !$sensor['status'] || !$sensor['online']) {echo esc('--');}
                else {
                if ($sensor['wh_diff'] <= 5) {
                  echo '<span style="color:red">'.esc($sensor['wh_diff']).' %</span>';
                } else if ($sensor['wh_diff'] < 10) {
                  echo '<span style="color:orange">'.esc($sensor['wh_diff']).' %</span>';
                } else {
                  echo '<span style="color:green">'.esc($sensor['wh_diff']).' %</span>';
                }
              }
            ?>
          </td>
          <td>
          <?php
              if ($sensor['hum'] <= 0 || !$sensor['status'] || !$sensor['online']) {echo esc('--');}
              else {
                if ($sensor['ch_diff'] <= 5) {
                  echo '<span style="color:red">'.esc($sensor['ch_diff']).' %</span>';
                } else if ($sensor['ch_diff'] < 10) {
                  echo '<span style="color:orange">'.esc($sensor['ch_diff']).' %</span>';
                } else {
                  echo '<span style="color:green">'.esc($sensor['ch_diff']).' %</span>';
                }
              }
            ?>
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