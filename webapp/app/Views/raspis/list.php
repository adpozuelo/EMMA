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
              <th scope="col">Localización</th>
              <th scope="col">En línea</th>
              <th scope="col">Error</th>
              <th scope="col">Dirección IP</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($raspis) && is_array($raspis)) : ?>
            <?php foreach ($raspis as $raspi): ?>
            <tr>
              <td>
                <?php
                  if ($raspi['online'] == 1)
                    echo '<span style="color:green">'.esc($raspi['hostname']).'</span>';
                  else if ($raspi['online'] == 0)
                    echo '<span style="color:red">'.esc($raspi['hostname']).'</span>';
                ?>
              </td>
              <td>
                <?= esc($raspi['location']) ?>
              </td>
              <td>
                <?php
                  if ($raspi['online'] == 1)
                    echo '<span style="color:green">'.esc('Sí').'</span>';
                  else if ($raspi['online'] == 0)
                    echo '<span style="color:red">'.esc('No').'</span>';
                ?>
              </td>
              <td>
                <?php
                  if ($raspi['error_count'] < 2)
                    echo '<span style="color:green">'.esc($raspi['error_count']).'</span>';
                  else if ($raspi['error_count'] == 2)
                    echo '<span style="color:orange">'.esc($raspi['error_count']).'</span>';
                  else if ($raspi['error_count'] == 3)
                    echo '<span style="color:red">'.esc($raspi['error_count']).'</span>';
                ?>
              </td>
              <td>
                <?= esc($raspi['ip_address']) ?>
              </td>
              <td>
                <?php
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="edit"></span>',
                    'onclick' => "location.href='/raspis/modify/{$raspi['hostname']}'"
                    ];
                  echo form_button($add_button);
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="trash"></span>',
                    'onclick' => "location.href='/raspis/delete/{$raspi['hostname']}'"
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