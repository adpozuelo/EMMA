<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <?php
            foreach ($main as $main_item) {
              if ($main_item['admin']) {
                if (session()->get('group') == 'admin') { ?>
                    <li class="nav-item">
                        <?= anchor($main_item['controller'],
                              '<span data-feather="'.$main_item['icon'].'"></span>'.$main_item['title'].'',
                              ['class' => 'nav-link '.$main_item['active'].'']) ?>
                    </li>
                    <?php 
                }

              } else { ?>
                    <li class="nav-item">
                        <?= anchor($main_item['controller'],
                          '<span data-feather="'.$main_item['icon'].'"></span>'.$main_item['title'].'',
                            ['class' => 'nav-link '.$main_item['active'].'']) ?>
                    </li>
                    <?php 
              }
            };
          ?>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Sensores</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <?php
            if (isset($sensors)) {
                foreach ($sensors as $sensor_item) {
                    if ($sensor_item['admin']) {
                        if (session()->get('group') == 'admin') { ?>
                            <li class="nav-item">
                                <?= anchor($sensor_item['controller'],
                                    '<span data-feather="'.$sensor_item['icon'].'"></span>'.$sensor_item['title'].'',
                                    ['class' => 'nav-link '.$sensor_item['active'].'']) ?>
                            </li>
                            <?php 
                        }
                    } else { ?>
                            <li class="nav-item">
                                <?= anchor($sensor_item['controller'],
                                '<span data-feather="'.$sensor_item['icon'].'"></span>'.$sensor_item['title'].'',
                                ['class' => 'nav-link '.$sensor_item['active'].'']) ?>
                            </li>
                            <?php 
                    }
                };
            } else {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="alert-circle"></span>
                                        No sensors found
                                    </a>
                            </li>';
                    }

                    
                    ?>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Nodos</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <?php
            if (isset($nodes)) {
                foreach ($nodes as $node_item) {
                    if ($node_item['admin']) {
                        if (session()->get('group') == 'admin') { ?>
                            <li class="nav-item">
                                <?= anchor($node_item['controller'],
                                    '<span data-feather="'.$node_item['icon'].'"></span>'.$node_item['title'].'',
                                    ['class' => 'nav-link '.$node_item['active'].'']) ?>
                            </li>
                            <?php 
                        }
                    } else { ?>
                            <li class="nav-item">
                                <?= anchor($node_item['controller'],
                                '<span data-feather="'.$node_item['icon'].'"></span>'.$node_item['title'].'',
                                ['class' => 'nav-link '.$node_item['active'].'']) ?>
                            </li>
                            <?php 
                    }
                };
            } else {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="alert-circle"></span>
                                        No nodes found
                                    </a>
                            </li>';
                    }

                    
                    ?>
                </ul>
            </div>
        </nav>