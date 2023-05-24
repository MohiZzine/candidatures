<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 sticky-top p-5">
    <div class="container-md">
      <a href="#" class="navbar-brand mx-4 mx-md-0 fw-bold"><?php if (isset($_SESSION['user_id'])) {
        echo $_SESSION['user_name'];
      } else {
        echo $_SESSION['admin_name'];
      } ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="#" class="nav-link active">Elections</a>
          </li>
          <li class="nav-item">
            <a href="education.php" class="nav-link">Programs</a>
          </li>
          <li class="nav-items">
            <a href="experience.php" class="nav-link">Candidates</a>
          </li>
          <li class="nav-item">
            <a href="skills.php" class="nav-link"></a>
          </li>
          <li class="nav-item">
            <a href="projects.php" class="nav-link">Projects</a>
          </li>
          <li class="nav-item">
            <form action="../../server/logout.php" method="post"></form>
            <button class="btn btn-danger mx-3">Log out</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>