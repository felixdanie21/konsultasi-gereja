<div class="register-box">
  <div class="card">
    <div class="card-body register-card-body rounded">
      <div class="header-group text-center">
        <a href="<?=base_url('Beranda')?>">
          <img src="<?= base_url() ?>assets/img/kgpm.png" style="width:80px;">
        </a>
        <br>
        <a style="font-size:25px;color:black;" class="login-box-msg" href="<?=base_url('Beranda')?>"><b>KBPS 2023</b> </a>
        <p class="login-box-msg">GANTI PASSWORD ANDA</p>
      </div>

      <form action="<?=base_url('Auth/gantipassword_post')?>" method="post">
        <?php if($this->session->userdata('errormsg')):?>
          <div class="alert alert-danger" role="alert">
            <?= $this->session->userdata('errormsg')?>
            <button type="button"class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <?php $this->session->unset_userdata('errormsg');?>
          </div>
          <?php endif;?>
        <div class="input-group mb-3">
          <input type="text" id="userid" name="userid" class="form-control"  value="<?= $muser->userid ?>" readonly required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" id="username" name="username" class="form-control"  value="<?= $muser->username ?>" readonly required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Ganti Password" autofocus required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password2" name="password2" class="form-control" placeholder="Masukan Kembali Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-block btn-primary">
            <i class="fas fa-sign-in"></i>
            PROSES
        </button>
          <a href="<?= base_url('Auth/login')?>" class=" btn btn-block btn-secondary text-center">KEMBALI</a>
        </div>
      </form>
    
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>