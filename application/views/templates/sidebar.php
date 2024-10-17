
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url() ?>assets/img/kgpm.png" alt="KGPM Logo" class="brand-image img-circle">
      <span style="color:white" class="brand-text font-weight-light">KBPS 2023</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/img/profile/<?= $this->session->userdata('userimage') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-light"><?= $this->session->userdata('username') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul style="font-size: 12px;" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a id="dashboard" href="<?= base_url() ?>Dashboard" class="nav-link">
              <i i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DASHBOARD
              </p>
            </a>
          </li>
          <?php foreach ($dbmenu as $menu) : ?>
              <?php if ($menu['levelmenu'] == '1') : ?>
                  <?php if ($menu['statmenu'] == 'I') : ?>
                      <?php
                          $submenu = $this->MenuModel->listsubmenu($menu['kodemenu']);
                      ?>
                      <li onclick="menuOpen('<?= $menu['kodemenu'] ?>')" id="<?= $menu['kodemenu'] ?>tree" class="nav-item">
                          <a id="<?= $menu['kodemenu'] ?>" href="<?= base_url() ?><?= $menu['kontroler'] ?>" class="nav-link">
                              <i id="<?= $menu['kodemenu'] ?>icon" class="nav-icon fas fa-folder"></i>
                              <p>
                                  <?= $menu['namamenu'] ?>
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <?php foreach ($submenu as $sm) : ?>
                                  <li class="nav-item ml-3">
                                      <a id="<?= $sm['kodemenu'] ?>" href="<?= base_url() ?><?= $sm['kontroler'] ?>" class="nav-link">
                                          <i class="nav-icon fas fa-file-alt"></i>
                                          <p> <?= $sm['namamenu'] ?></p>
                                      </a>
                                  </li>
                              <?php endforeach; ?>
                          </ul>
                      </li>
                  <?php else : ?>
                      <li class="nav-item">
                          <a id="<?= $menu['kodemenu'] ?>" href="<?= base_url() ?><?= $menu['kontroler'] ?>" class="nav-link">
                              <i class="nav-icon fas fa-file-alt"></i>
                              <p>
                                  <?= $menu['namamenu'] ?>
                              </p>
                          </a>
                      </li>
                  <?php endif; ?>
              <?php endif; ?>
          <?php endforeach; ?>
          <?php if($this->session->userdata('userlevel') == 0):?>
            <li class="nav-item">
              <a id="hakakses" href="<?= base_url() ?>Hakakses" class="nav-link">
                <i i class="nav-icon fas fa-user-lock"></i>
                <p>
                  HAK AKSES PANITIA
                </p>
              </a>
            </li>
          <?php endif;?>
          <?php if($this->session->userdata('userlevel') == 0):?>
            <li class="nav-item">
              <a id="datauser" href="<?= base_url() ?>Datauser" class="nav-link">
                <i i class="nav-icon fas fa-users"></i>
                <p>
                DATA USER
              </p>
              </a>
            </li>
          <?php endif;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>