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
              <th scope="col">ID</th>  
              <th scope="col">Nodo</th>
              <th scope="col">Modelo</th>
              <th scope="col">Driver</th>
              <th scope="col">Mem. Total</th>
              <th scope="col">En línea</th>
              <th scope="col">Error</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($gpus) && is_array($gpus)) : ?>
            <?php foreach ($gpus as $gpu): ?>
            <tr>
              <td>
                <?php
                  if ($gpu['online'] == 1)
                    echo '<span style="color:green">'.esc($gpu['gpu_id']).'</span>';
                  else if ($gpu['online'] == 0)
                    echo '<span style="color:red">'.esc($gpu['gpu_id']).'</span>';
                ?>
              </td>
              <td>
                <?= esc($gpu['node_id']) ?>
              </td>
              <td>
                <?= esc($gpu['gpu_name']) ?>
              </td>
              <td>
                <?= esc($gpu['driver']) ?>
              </td>
              <td>
                <?= esc($gpu['mem_total']) ?>
              </td>
              <td>
                <?php
                  if ($gpu['online'] == 1)
                    echo '<span style="color:green">'.esc('Sí').'</span>';
                  else if ($gpu['online'] == 0)
                    echo '<span style="color:red">'.esc('No').'</span>';
                ?>
              </td>
              <td>
                <?php
                  if ($gpu['error_count'] < 2)
                    echo '<span style="color:green">'.esc($gpu['error_count']).'</span>';
                  else if ($gpu['error_count'] == 2)
                    echo '<span style="color:orange">'.esc($gpu['error_count']).'</span>';
                  else if ($gpu['error_count'] == 3)
                    echo '<span style="color:red">'.esc($gpu['error_count']).'</span>';
                ?>
              </td>
              <td>
                <?php
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="trash"></span>',
                    'onclick' => "location.href='/gpus/delete/{$gpu['gpu_id']}'"
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