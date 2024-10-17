<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KBPS 2023</title>
  <link rel="icon" href="<?= base_url() ?>assets/img/kgpm.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- general style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/general.css?n=2">
  <!-- beranda style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/beranda.css?n=1">
</head>

    <nav class="navbar navbar-expand-lg px-sm-3">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url() ?>assets/img/kgpm.png" alt="KPGM LOGO" width="40">
        </a>
        <span class="navbar-title d-md-block d-none">Kerapatan Gereja Protestan Minahasa</span>
        <div class="ml-auto">
            <a href="<?= base_url() ?>Auth/login" class="btn btn-primary">Login</a>
            <a href="<?= base_url() ?>Auth/registrasi" class="btn btn-primary">Pendaftaran</a>
        </div>
    </nav>

    <div class="modal fade" id="susunanacara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <img style="width:100%" src="<?= base_url() ?>assets/img/acara.jpg" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>    
    </div>

    <div class="modal fade" id="gambarpanitia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <img style="width:100%" src="<?= base_url() ?>assets/img/panitia.jpg" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>

    <div class="titlebar mb-3">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="m-0 text-uppercase font-weight-bold">Konsultasi</h2>
            <h4 class="m-0 text-uppercase font-weight-bold">Badan Pimpinan Sidang Se KGPM Tahun 2023</h4>
            <span>
                Tema : “Satu Kasih, Satu Jiwa, Satu Tujuan” (Filipi 2 : 2b)
            </span>
            <br>
            <span>
                Hotel Swiss Belresidences Kalibata Jakarta, 11 - 13 Juli 2023
            </span>
            <br>
            <button data-toggle="modal" data-target="#susunanacara" class="btn btn-primary mt-2">Susunan Acara</button>
            <button data-toggle="modal" data-target="#gambarpanitia" class="btn btn-primary mt-2">Susunan Panitia</button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>