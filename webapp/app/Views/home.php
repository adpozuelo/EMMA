<body class="d-flex h-100 text-center text-white bg-dark">

  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">EMMA</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link active" aria-current="page" href="#">Principal</a>

          <?php if (session()->get('logged')): ?>
            <?= anchor('dashboard', 'Panel', [
              'class' => 'nav-link',
              'aria-current' => 'page'
            ]) ?>
            <?= anchor('signout', 'Salir', [
              'class' => 'nav-link',
              'aria-current' => 'page'
            ]) ?>
          <?php else: ?>
            <?= anchor('signin', 'Acceder', [
              'class' => 'nav-link',
              'aria-current' => 'page'
            ]) ?>
          <?php endif ?>
        </nav>
      </div>
    </header>

    <main class="px-3">
      <h1>Environments Monitoring & Management Application</h1>
      <p class="lead">
        Bienvenido a EMMA, la aplicación de monitorización y gestión de instalaciones científico-técnicas.
      </p>
    </main>

    <footer class="mt-auto text-white-50">
      <p>&copy;</p>
    </footer>
  </div>

</body>

</html>