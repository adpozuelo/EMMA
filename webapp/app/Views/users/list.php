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
                            'content' => '<span data-feather="user-plus"></span> Añadir usuario',
                            'onclick' => "location.href='/users/create'"
                            ];
              echo form_button($add_button);
          ?>
        </div>
        
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Usuario</th>
              <th scope="col">Correo</th>
              <th scope="col">Grupo</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($users) && is_array($users)) : ?>
            <?php foreach ($users as $user): ?>
            <tr>
              <td>
                <?php
                  if ($user['status'] == 'enabled')
                    echo '<span style="color:green">'.esc($user['username']).'</span>';
                  else if ($user['status'] == 'disabled')
                    echo '<span style="color:red">'.esc($user['username']).'</span>';
                ?>
              </td>
              <td>
                <?= esc($user['email']) ?>
              </td>
              <td>
                <?php
                    if ($user['group'] == 'user')
                      echo esc('Usuario');
                    else if ($user['group'] == 'admin')
                      echo esc('Administrador');
                  ?>
              </td>
              <td>
                <?php
                    if ($user['status'] == 'enabled')
                      echo '<span style="color:green">'.esc('Activado').'</span>';
                    else if ($user['status'] == 'disabled')
                      echo '<span style="color:red">'.esc('Desactivado').'</span>';
                  ?>
              </td>
              <td>
                <?php
                  if ($user['status'] == 'enabled') {
                    $lock_icon = 'lock';
                    $url_segment = 'disable';
                  }
                  else {
                    $lock_icon = 'unlock';
                    $url_segment = 'enable'; 
                  } 
                  $add_button = [
                      'type'    => 'button',
                      'class'   => 'btn btn-sm btn-outline-secondary',
                      'content' => '<span data-feather="'.$lock_icon.'"></span>',
                      'onclick' => "location.href='/users/{$url_segment}/{$user['id']}'"
                      ];
                  if ($user['id'] == 1) $add_button['disabled'] = 'true';
                  echo form_button($add_button);
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="edit"></span>',
                    'onclick' => "location.href='/users/modify/{$user['id']}'"
                    ];
                  if ($user['id'] == 1) $add_button['disabled'] = 'true';
                  echo form_button($add_button);
                  $add_button = [
                    'type'    => 'button',
                    'class'   => 'btn btn-sm btn-outline-secondary',
                    'content' => '<span data-feather="trash"></span>',
                    'onclick' => "location.href='/users/delete/{$user['id']}'"
                    ];
                  if ($user['id'] == 1) $add_button['disabled'] = 'true';
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