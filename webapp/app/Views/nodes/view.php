<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h3">
          <?= $title ?>
        </h3>
        <div class="btn-toolbar mb-2 mb-md-0">
          <?php
              $add_button = [
                'type'    => 'button',
                'class'   => 'btn btn-sm btn-outline-secondary',
                'content' => '<span data-feather="bookmark"></span> 24 horas',
                'onclick' => "location.href='/node/view/".$node['hostname']."'",
                'style' => "margin-right: 5px"
                ];
              echo form_button($add_button);
              $days_number = [7, 30, 182];
              $days_name = ['Semanal', 'Mensual', 'Semestral'];
              for ($i = 0; $i < count($days_number); $i++) {
                $add_button = [
                  'type'    => 'button',
                  'class'   => 'btn btn-sm btn-outline-secondary',
                  'content' => '<span data-feather="bookmark"></span> '.$days_name[$i],
                  'onclick' => "location.href='/node/view/".$node['hostname']."/".$days_number[$i]."'",
                  'style' => "margin-right: 5px"
                  ];
                echo form_button($add_button);
              }
          ?>
        </div>
      </div>
      <div>
        <h4 class="h4">
          <?= 'Última medida' ?>
        </h4>
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Fecha</th>
              <th scope="col">Último inicio</th>
              <th scope="col">Carga(1m)</th>
              <th scope="col">Carga(5m)</th>
              <th scope="col">Carga(15m)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <?php
                  $fecha = DateTime::createFromFormat('ymdHi', $last_measure['date'])
                            ->format('d/m/Y H:i');
                  echo esc($fecha);
                ?>
              </td>
              <td>
                <?= esc($last_measure['uptime']) ?>
              </td>
              <td>
                <?= esc($last_measure['load_1'] .' %') ?>
              </td>
              <td>
                <?= esc($last_measure['load_5'] .' %') ?>
              </td>
              <td>
                <?= esc($last_measure['load_15'] .' %') ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
      <div class="border-top my-3"></div>
      <h4 class="h4">
        <?= 'Almacenamiento' ?>
      </h4>
      <div class="container">
      <div class="row">
        <div class="col-4">
          <canvas id="fs" ></canvas>
        </div>
        <div class="col-4">
          <canvas id="var" ></canvas>
        </div>
        <div class="col-4">
          <canvas id="scratch" ></canvas>
        </div>
      </div>
      </div>
      <div class="border-top my-3"></div>
      <h4 class="h4">
        <?= 'RAM y carga de CPU' ?>
      </h4>
      <div class="container">
      <div class="row">
        <div class="col-4">
          <canvas id="mem" ></canvas>
        </div>
        <div class="col-8">
          <canvas id="loadChart"></canvas>
        </div>
      </div>
      </div>
      <div class="border-top my-3"></div>
      <?php
        if ($node['n_gpu'] > 0) {
          for ($i = 0; $i < $node['n_gpu']; $i++) {
          ?>
            <div>
              <h4 class="h4">
                <?= esc($gpus[$i]['gpu_name'].' (id: '.substr($gpus[$i]['gpu_id'],0,1).')') ?>
              </h4>
              <script>
                var gpumemory = <?php echo json_encode($gpu_memory); ?>;
                var gpuload = <?php echo json_encode($gpus_load); ?>;
              </script>
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <canvas id=<?= 'gpumem'.$i ?>></canvas>
                </div>
                <div class="col-8">
                  <canvas id=<?= 'gpuload'.$i ?> ></canvas>
                </div>
              </div>
            </div>
            <div class="border-top my-3"></div>
            </div>
          <?php
          }
        }
      ?>
    </main>
  </div>
</div>
<script>
    var memory = <?php echo json_encode($memory); ?>;
    var fs_usage = <?php echo json_encode($fs_usage); ?>;
    var var_usage = <?php echo json_encode($var_usage); ?>;
    var scratch_usage = <?php echo json_encode($scratch_usage); ?>;
    var load = <?php echo json_encode($load); ?>;
    var dates = <?php echo json_encode($datetime); ?>;
</script>

