 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h2 class="font-weight-bold">INFORMASI BERITA</h2>
                <a href="<?= base_url() ?>Dashboard"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- berita utama -->
                <div class="col-sm-9">
                    <div class="title-card mx-auto text-center">
                        <span>Berita Utama</span>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url() ?>assets/img/berita/<?= $mberita->beritagambar ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold"><?= $mberita->beritajudul ?></h5>
                            <p class="card-text text-justify"><?= $mberita->beritaisi ?></p>
                        </div>
                    </div>
                </div>
                <!-- berita lain -->
                <div class="col-sm-3">
                    <div class="title-card mx-auto text-center">
                        <span>Berita Lain</span>
                    </div>
                    <div class="card">
                        <div class="card-body p-2">
                            <?php if($beritalain):?>
                                <table style="font-size:12px;" class="table table-sm table-borderless">
                                    <tbody>
                                        <?php foreach($beritalain as $bl):?>
                                            <tr>
                                                <td width="30%"><img style="width:100%" src="<?= base_url() ?>assets/img/berita/<?= $bl['beritagambar'] ?>" alt=""></td>
                                                <td>
                                                    <span class="font-weight-bold"><?= $bl['beritajudul'] ?></span>
                                                    <a href="<?= base_url() ?>Dashboard/berita/<?= $bl['beritaid'] ?>">Selengkapnya <i class="fas fa-chevron-right"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            <?php else:?>
                                <p class="text-center">- Akan diisi berita -</p>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->