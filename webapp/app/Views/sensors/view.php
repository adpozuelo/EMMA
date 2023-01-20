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
                'content' => '<span data-feather="bookmark"></span> 12 horas',
                'onclick' => "location.href='/sensor/view/".$sensor['name']."'",
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
                  'onclick' => "location.href='/sensor/view/".$sensor['name']."/".$days_number[$i]."'",
                  'style' => "margin-right: 5px"
                  ];
                echo form_button($add_button);
              }
          ?>
        </div>
      </div>
      <div class="container">
      <div class="row">
        <div class="col-12">
        <canvas id="tempChart"></canvas>
        </div>
      </div>
      </div>
      <div class="border-top my-3"></div>
      <div class="container">
      <div class="row">
        <div class="col-12">
        <canvas id="humChart"></canvas>
        </div>
      </div>
      </div>
      <div class="border-top my-3"></div>
    </main>
  </div>
</div>
<script>
    var temperature = <?php echo json_encode($temperature); ?>;
    var w_temperature = <?php echo json_encode($w_temperature); ?>;
    var c_temperature = <?php echo json_encode($c_temperature); ?>;
    var w_humidity = <?php echo json_encode($w_humidity); ?>;
    var c_humidity = <?php echo json_encode($c_humidity); ?>;
    var humidity = <?php echo json_encode($humidity); ?>;
    var dates = <?php echo json_encode($datetime); ?>;
</script>