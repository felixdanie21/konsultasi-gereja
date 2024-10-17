<div class="register-box registrasi">
  <div class="card my-3">
    <div class="card-body register-card-body rounded">
      <div class="header-group text-center">
        <a href="<?=base_url('Beranda')?>">
          <img src="<?= base_url() ?>assets/img/kgpm.png" style="width:80px;">
        </a>        <br>
        <a style="font-size:25px;color:black;" class="login-box-msg" href="<?=base_url('Beranda')?>"><b>KBPS 2023</b> </a>
        <p class="login-box-msg">REGISTRASI</p>
      </div>

      <form action="<?= base_url() ?>Auth/registrasi_post" method="post">
        <?php if($this->session->userdata('errormsg')):?>
          <div class="alert alert-danger" role="alert">
            <?= $this->session->userdata('errormsg')?>
            <button type="button"class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <?php $this->session->unset_userdata('errormsg');?>
          </div>
        <?php endif;?>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Nomor Hp</label>
          <input functionlain="cek_nomorhp()" type="angka" class="form-control" id="nomorhp" name="nomorhp"  maxlength="20" required>
          <select class="form-control mt-1" name="fungsihp" id="fungsihp" required>
            <option value="" disabled selected>-- FUNGSI HP --</option>
            <option value="T">TELPON</option>
            <option value="W">WHATSAPP</option>
            <option value="G">TELEGRAM</option>
          </select>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Jabatan Majelis</label>
          <select class="form-control" name="jabatanmajelis" id="jabatanmajelis" required>
            <option value="" disabled selected>-- PILIH --</option>
            <option value="P">PENATUA</option>
            <option value="D">DIAKEN</option>
            <option value="J">JEMAAT</option>
          </select>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Nama Lengkap (Dengan Gelar)</label>
          <input type="text" class="form-control text-uppercase" id="namalengkap" name="namalengkap" maxlength="50" required>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Nama Panggilan</label>
          <input type="text" class="form-control text-uppercase" id="namapanggilan" name="namapanggilan" maxlength="10" required>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Tanggal Lahir</label>
          <input type="text" class="form-control"  id="tgllahir" name="tgllahir" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" required data-mask>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Jenis Kelamin</label>
          <select class="form-control" name="jeniskelamin" id="jeniskelamin" required>
            <option value="" disabled selected>-- PILIH --</option>
            <option value="L">LAKI-LAKI</option>
            <option value="P">PEREMPUAN</option>
          </select>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Asal Sidang</label>
          <select class="form-control select2" name="asalsidang" id="asalsidang" required>
            <option value="" disabled selected>-- PILIH --</option>
            <?php foreach($msidang as $ms):?>
              <option value="<?= $ms['sidangkode'] ?>"><?= strtoupper(str_replace(';','',$ms['sidanglengkap'])) ?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Tanggal Jam Kedatangan (Ke Jakarta)</label>
          <input type="text" class="form-control"  id="tgldatangke" name="tgldatangke" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy HH:MM"  data-mask>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Tanggal Jam Rencana Kepulangan (Dari Jakarta)</label>
          <input type="text" class="form-control"  id="tgldatangdari" name="tgldatangdari" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy HH:MM"  data-mask>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Ukuran Baju</label>
          <input type="text" class="form-control text-uppercase" id="ukuranbaju" name="ukuranbaju"  maxlength="5" required>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Jenis Peserta</label>
          <select class="form-control" name="jenispeserta" id="jenispeserta" required>
            <option value="" disabled selected>-- PILIH --</option>
            <option value="S">SIDANG</option>
            <option value="W">WILAYAH</option>
            <option value="P">PPMG</option>
            <option value="A">PANITIA</option>
            <option value="L">PENINJAU</option>
          </select>
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Email</label>
          <input type="email" class="form-control" id="email" name="email"  maxlength="30">
        </div>
        <div class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Datang Bersama Pasangan?</label>
          <select onchange="is_pasangan()" class="form-control mt-1" name="datangpasangan" id="datangpasangan" required>
            <option value="" disabled selected>-- PILIH --</option>
            <option value="Y">YA</option>
            <option value="T">TIDAK</option>
          </select>
        </div>
        <div id="divnamapasangan" style="display:none;" class="form-group mb-2">
          <label for="exampleFormControlSelect1" class="mb-0 font-weight-normal">Nama Pasangan</label>
          <input type="text" class="form-control text-uppercase" id="namapasangan" name="namapasangan"  maxlength="50">
        </div>
        <button type="submit" class="btn btn-block btn-primary mt-3">REGISTRASI</button>
        <a href="<?= base_url('Auth/login')?>" class=" btn btn-block btn-secondary text-center">LOGIN</a>  
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

<!-- Modal -->
<div class="modal fade" id="modalinformasilogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">INFORMASI LOGIN ANDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Silahkan Login Menggunakan Nomor Hp/Wa Anda Seperti Ini!
        <div class="form-group row mt-2">
          <label for="Userid" class="col-sm-4 col-form-label">Nomor Hp/Wa</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control" id="Userid" value="<?= $this->session->userdata('infologinuserid') ?>">
          </div>
        </div>
        <div class="form-group row mt-2">
          <label for="password" class="col-sm-4 col-form-label">Password</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control" id="password" value="<?= $this->session->userdata('infologinpassword') ?>">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="<?= base_url() ?>Auth/autologin/<?=$this->session->userdata('infologinuserid')?>/<?=$this->session->userdata('infologinpassword')?>" type="button" class="btn btn-primary">LOGIN</a>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = function(){
    <?php if($this->session->userdata('datadaftargagal')):?>
      gagal_registrasi();
    <?php endif;?>
    <?php if($this->session->userdata('infologinuserid')):?>
      $('#modalinformasilogin').modal('show');
      toastr.success('BERHASIL REGISTRASI');
      <?php $this->session->unset_userdata('infologinuserid'); ?>
      <?php $this->session->unset_userdata('infologinpassword'); ?>
    <?php endif;?>
  }

  <?php if($this->session->userdata('datadaftargagal')):?>
    function gagal_registrasi()
    {
      <?php
        $datadaftargagal = $this->session->userdata('datadaftargagal'); 
        $this->session->unset_userdata('datadaftargagal');
      ?>

      var nomorhp = document.getElementById('nomorhp');
      var fungsihp = document.getElementById('fungsihp');
      var jabatanmajelis = document.getElementById('jabatanmajelis');
      var namalengkap = document.getElementById('namalengkap');
      var tgllahir = document.getElementById('tgllahir');
      var jeniskelamin = document.getElementById('jeniskelamin');
      var asalsidang = document.getElementById('asalsidang');
      var jenispeserta = document.getElementById('jenispeserta');
      var email = document.getElementById('email');
      var namapanggilan = document.getElementById('namapanggilan');
      var tgldatangke = document.getElementById('tgldatangke');
      var tgldatangdari = document.getElementById('tgldatangdari');
      var ukuranbaju = document.getElementById('ukuranbaju');
      var datangpasangan = document.getElementById('datangpasangan');
      var namapasangan = document.getElementById('namapasangan');

      nomorhp.setAttribute('placeholder','<?= $datadaftargagal['daftarhp'] ?>');
      fungsihp.value = '<?= $datadaftargagal['daftarfungsi'] ?>';
      jabatanmajelis.value = '<?= $datadaftargagal['daftarmajelis'] ?>';
      namalengkap.value = '<?= $datadaftargagal['daftarnama'] ?>';
      tgllahir.value = '<?= $this->RyuModel->datemask_format($datadaftargagal['daftartglhr'],'date','1') ?>';
      jeniskelamin.value = '<?= $datadaftargagal['daftarjk'] ?>';
      asalsidang.value = '<?= $datadaftargagal['sidangkode'] ?>';
      jenispeserta.value = '<?= $datadaftargagal['daftarjenis'] ?>';
      email.value = '<?= $datadaftargagal['daftaremail'] ?>';
      namapanggilan.value = '<?= $datadaftargagal['daftarnamapanggilan'] ?>';
      tgldatangke.value = '<?= $this->RyuModel->datemask_format($datadaftargagal['daftarkejakarta'],'time','1') ?>';
      tgldatangdari.value = '<?= $this->RyuModel->datemask_format($datadaftargagal['daftardarijakarta'],'time','1') ?>';
      ukuranbaju.value = '<?= $datadaftargagal['daftarukuranbaju'] ?>';
      datangpasangan.value = '<?= $datadaftargagal['daftardgnpasangan'] ?>';
      namapasangan.value = '<?= $datadaftargagal['daftarnamapasangan'] ?>';
      console.log('<?= $this->RyuModel->datemask_format($datadaftargagal['daftartglhr'],'date','1') ?>');
      is_pasangan();
    }
  <?php endif;?>

  function cek_nomorhp()
  {
    var nomorhp = document.getElementById('nomorhp');
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
      if(ajax.readyState == 4 && ajax.status == 200){
        var response = ajax.responseText;
        // alert(response);
        if(response == '1'){
          toastr.error('NOMOR HP SUDAH DIGUNAKAN');
          nomorhp.setAttribute('placeholder',nomorhp.value);
          nomorhp.value = '';
        }
      }
    }
    ajax.open('POST','<?= base_url() ?>Auth/ajax_registrasi_cek_nomorhp',true);
    ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
    ajax.send('nomorhp='+nomorhp.value);
  }

  function is_pasangan()
  {
    var datangpasangan = document.getElementById('datangpasangan');
    var divnamapasangan = document.getElementById('divnamapasangan');
    var namapasangan = document.getElementById('namapasangan');
    if(datangpasangan.value == 'Y'){
        divnamapasangan.style.display = 'block';
        namapasangan.setAttribute('required',true);
    } else {
        divnamapasangan.style.display = 'none';
        namapasangan.removeAttribute('required',true);
        namapasangan.value = '';
    }
  }

</script>
