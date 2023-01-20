    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
        <h3 class="h3">
          <?= $title ?>
        </h3>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Tipo</th>
              <th scope="col">Estado</th>
              <th scope="col">Raspberry</th>
              <th scope="col">En línea</th>
              <th scope="col">Error</th>
              <th scope="col">T(a)</th>
              <th scope="col">T(c)</th>
              <th scope="col">H(a)</th>
              <th scope="col">H(c)</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($sensors) && is_array($sensors)) : ?>
            <?php foreach ($sensors as $sensor): ?>
            <tr>
              <td>
                <?php
                  if ($sensor['online'] == 1 && $sensor['status'] == 1)
                    echo '<span style="color:green">'.esc($sensor['name']).'</span>';
                  else if ($sensor['online'] == 0 || $sensor['status'] == 0)
                    echo '<span style="color:red">'.esc($sensor['name']).'</span>';
                ?>
              </td>
              <td>
                <?= esc($sensor['type']) ?>
              </td>
              <td>
                <?php
                    if ($sensor['status'] == 1)
                      echo '<span style="color:green">'.esc('Activado').'</span>';
                    else if ($sensor['status'] == 0)
                      echo '<span style="color:red">'.esc('Desactivado').'</span>';
                  ?>
              </td>
              <td>
                <?= esc($sensor['raspberry_id']) ?>
              </td>
              <td>
                <?php
                  if ($sensor['online'] == 1)
                    echo '<span style="color:green">'.esc('Sí').'</span>';
                  else if ($sensor['online'] == 0)
                    echo '<span style="color:red">'.esc('No').'</span>';
                ?>
              </td>
              <td>
                <?php
                  if ($sensor['error_count'] < 2)
                    echo '<span style="color:green">'.esc($sensor['error_count']).'</span>';
                  else if ($sensor['error_count'] == 2)
                    echo '<span style="color:orange">'.esc($sensor['error_count']).'</span>';
                  else if ($sensor['error_count'] == 3)
                    echo '<span style="color:red">'.esc($sensor['error_count']).'</span>';
                ?>
              </td>
              <td>
                <?php
                  if ($sensor['type'] == 'TH')
                    echo esc($sensor['warning_temp'].' ºC');
                  else
                    echo esc('--');
                ?>
              </td>
              <td>
                <?php
                  if ($sensor['type'] == 'TH')
                    echo esc($sensor['critical_temp'].' ºC');
                  else
                    echo esc('--');
                ?>
              </td>
              <td>
                <?php
                  if ($sensor['type'] == 'TH')
                    echo esc($sensor['warning_hum'].' %');
                  else
                    echo esc('--');
                ?>
              </td>
              <td>
                <?php
                  if ($sensor['type'] == 'TH')
                    echo esc($sensor['critical_hum'].' %');
                  else
                    echo esc('--');
                ?>
              </td>
              <td>
                <?php
                  if ($sensor['status'] == 1) {
                    $lock_icon = 'zap-off';
                    $url_segment = 'disable';
                  }
                  else if ($sensor['status'] == 0) {
                    $lock_icon = 'zap';
                    $url_segment = 'enable'; 
                  } 
                  $add_button = [
                      'type'    => 'button',
                      'class'   => 'btn btn-sm btn-outline-secondary',
                      'content' => '<span data-feather="'.$lock_icon.'"></span>',
                      'onclick' => "location.href='/sensors/{$url_segment}/{$sensor['name']}'"
                      ];
                  echo form_button($add_button);
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="edit"></span>',
                    'onclick' => "location.href='/sensors/modify/{$sensor['name']}'"
                    ];
                  if ($sensor['type'] != 'TH' && $sensor['type'] != 'DB') $add_button['disabled'] = 'true';
                  echo form_button($add_button);
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="trash"></span>',
                    'onclick' => "location.href='/sensors/delete/{$sensor['name']}'"
                    ];
                  echo form_button($add_button);
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