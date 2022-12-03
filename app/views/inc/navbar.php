<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
                <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
                <a class="nav-link" href="<?php echo URLROOT; ?>/artists">Artists</a>
                <a class="nav-link" href="<?php echo URLROOT; ?>/albums">Albums</a>
                <a class="nav-link" href="<?php echo URLROOT; ?>/songs">Songs</a>
            </div>
        <div class="navbar-nav ms-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
              <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name']; ?></a>
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
          <?php else : ?>
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
          <?php endif; ?>
      </div>
    </div>
  </nav>