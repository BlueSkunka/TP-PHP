<?php require_once "config/base_path.php" ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if ($controllerName == "home") {
                            echo 'active';
                          }; ?>">
        <a class="nav-link" href="<?= BASE_PATH ?>/">Dashboard <?php if ($controllerName == "home") {
                                                                  echo '<span class="sr-only">(current)</span>';
                                                                }; ?></a>
      </li>

      <!-- STRUCTURE -->
      <li class="nav-item dropdown <?php if ($controllerName == "structure") {
                                      echo 'active';
                                    }; ?>">
        <a class="nav-link" href="<?= BASE_PATH ?>/index.php?controller=structure&action=list">Structures <?php if ($controllerName == "structure") {
                                                                                                            echo '<span class="sr-only">(current)</span>';
                                                                                                          }; ?></a>
      </li>

      <!-- Sector -->
      <li class="nav-item dropdown <?php if ($controllerName == "sector") {
                                      echo 'active';
                                    }; ?>">
        <a class="nav-link" href="<?= BASE_PATH ?>/index.php?controller=sector&action=list">Secteurs <?php if ($controllerName == "sector") {
                                                                                                        echo '<span class="sr-only">(current)</span>';
                                                                                                      }; ?></a>
      </li>
    </ul>
  </div>
</nav>