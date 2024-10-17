<div class="register-box">
  <div class="card">
    <div class="card-body register-card-body rounded">
      <div class="header-group text-center">
        <a href="<?=base_url('Beranda')?>">
          <img src="<?= base_url() ?>assets/img/kgpm.png" style="width:80px;">
        </a>
        <br>
        <a style="font-size:25px;color:black;" class="login-box-msg" href="<?=base_url('Beranda')?>"><b>KBPS 2023</b> </a>
        <p class="login-box-msg">LOGIN</p>
      </div>

      <form action="<?=base_url('Auth/Login_Post')?>" method="post">
        <?php if($this->session->userdata('errormsg')):?>
          <div class="alert alert-danger" role="alert">
            <?= $this->session->userdata('errormsg')?>
            <button type="button"class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <?php $this->session->unset_userdata('errormsg');?>
          </div>
        <?php endif;?>
        <?php if($this->session->userdata('successmsg')):?>
          <div class="alert alert-success" role="alert">
            <?= $this->session->userdata('successmsg')?>
            <button type="button"class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <?php $this->session->unset_userdata('successmsg');?>
          </div>
          <?php endif;?>
        <div class="input-group mb-3">
          <input type="text" id="userid" name="userid" class="form-control" placeholder="Nomor HP/Wa" maxlength="20" autofocus required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password"id="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" class="font-weight-normal">
                Remember Me
                </label>
            </div>
        </div>
        
        <button type="submit" class="btn btn-block btn-primary">
            <i class="fas fa-sign-in"></i>
            LOGIN
        </button>
          <a href="<?= base_url('Auth/registrasi')?>" class=" btn btn-block btn-secondary text-center">BELUM PUNYA LOGIN?</a>
        </div>
      </form>
    
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

<script>
  window.onload = function(){
    <?php if($this->session->userdata('autologinuserid')):?>
      auto_login();
    <?php endif?>
  }

  <?php if($this->session->userdata('autologinuserid')):?>
    function auto_login()
    {
      var userid = document.getElementById('userid');
      var password = document.getElementById('password');
      userid.value = '<?= $this->session->userdata('autologinuserid') ?>';
      password.value = '<?= $this->session->userdata('autologinpassword') ?>';
      <?php
        $this->session->set_userdata('autologinuserid');
        $this->session->set_userdata('autologinpassword');
      ?>
    }
  <?php endif;?>

</script>
