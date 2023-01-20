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
              <th scope="col">CPUs<br><?= esc('('. $n_cpus.')') ?></th>
              <th scope="col">CPU Brand</th>
              <th scope="col">Arch</th>
              <th scope="col">Kernel</th>
              <th scope="col">GPUs<br><?= esc('('.$n_gpus.')') ?></th>
              <th scope="col">Dirección IP</th>
              <th scope="col">En línea</th>
              <th scope="col">Error</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($nodes) && is_array($nodes)) : ?>
            <?php foreach ($nodes as $node): ?>
            <tr>
              <td>
                <?php
                  if ($node['online'] == 1)
                    echo '<span style="color:green">'.esc($node['hostname']).'</span>';
                  else if ($node['online'] == 0)
                    echo '<span style="color:red">'.esc($node['hostname']).'</span>';
                ?>
              </td>
              <td>
                <?= esc($node['n_cpu']) ?>
              </td>
              <td>
                <?= esc($node['cpu_brand']) ?>
              </td>
              <td>
                <?= esc($node['cpu_arch']) ?>
              </td>
              <td>
                <?= esc($node['kernel']) ?>
              </td>
              <td>
                <?= esc($node['n_gpu']) ?>
              </td>
              <td>
                <?= esc($node['ip_address']) ?>
              </td>
              <td>
                <?php
                  if ($node['online'] == 1)
                    echo '<span style="color:green">'.esc('Sí').'</span>';
                  else if ($node['online'] == 0)
                    echo '<span style="color:red">'.esc('No').'</span>';
                ?>
              </td>
              <td>
                <?php
                  if ($node['error_count'] < 2)
                    echo '<span style="color:green">'.esc($node['error_count']).'</span>';
                  else if ($node['error_count'] == 2)
                    echo '<span style="color:orange">'.esc($node['error_count']).'</span>';
                  else if ($node['error_count'] == 3)
                    echo '<span style="color:red">'.esc($node['error_count']).'</span>';
                ?>
              </td>
              <td>
                <?php
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="trash"></span>',
                    'onclick' => "location.href='/nodes/delete/{$node['hostname']}'"
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