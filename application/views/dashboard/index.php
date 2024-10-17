 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 text-center">
            <h2 class="m-0 text-uppercase font-weight-bold">Konsultasi</h2>
            <h4 class="m-0 text-uppercase font-weight-bold">Badan Pimpinan Sidang Se KGPM Tahun 2023</h4>
            <span>
                Tema : “Satu Kasih, Satu Jiwa, Satu Tujuan” (Filipi 2 : 2b)
            </span>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div id="carouselExampleControls" class="carousel slide mb-3 px-sm-3" data-ride="carousel">
        <?php if($mgaleri):?>
            <div class="title-card mx-auto text-center">
                <span>Galeri</span>
            </div>
            <div class="carousel-inner">
                <?php $g = 0;?>
                <?php $j = 2;?>
                <?php for($i=1;$i<$j;$i++):?>
                    <div class="carousel-item <?php if($i == 1):?>active<?php endif;?> text-center">
                        <?php for($g;$g<$i*6;$g++):?>
                            <?php if($g < count($mgaleri)):?>
                                <div class="d-inline">
                                    <img class="galeri-foto" src="<?= base_url() ?>assets/img/galeri/<?= $mgaleri[$g]['galerifile'] ?>" alt="galeri image">
                                    <!-- <?php if($mgaleri[$g]['galeriket']):?>
                                        <span style="font-size:12px" class="caption"><?= $mgaleri[$g]['galeriket'] ?></span>
                                    <?php endif;?> -->
                                </div>
                            <?php endif;?>
                        <?php endfor;?>
                    </div>
                    <?php 
                        if(count($mgaleri) > $g){
                            $j++;
                        }
                    ?>
                <?php endfor;?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        <?php endif;?>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                 <!-- berita -->
                <div class="col-sm-3 order-md-1 order-3">
                    <div class="title-card mx-auto text-center">
                        <span>Informasi Berita</span>
                    </div>
                    <div class="card">
                        <div class="card-body p-2">
                            <?php if($mberita):?>
                                <table style="font-size:12px;" class="table table-sm table-borderless">
                                    <tbody>
                                        <?php foreach($mberita as $mb):?>
                                            <tr>
                                                <td width="30%"><img style="width:100%" src="<?= base_url() ?>assets/img/berita/<?= $mb['beritagambar'] ?>" alt=""></td>
                                                <td>
                                                    <span class="font-weight-bold"><?= $mb['beritajudul'] ?></span>
                                                    <a href="<?= base_url() ?>Dashboard/berita/<?= $mb['beritaid'] ?>">Selengkapnya <i class="fas fa-chevron-right"></i></a>
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
                 <!-- Pesan dan Komentar -->
                <div class="col-sm-6 order-md-2 order-1">
                    <div class="title-card mx-auto text-center">
                        <span>Live Chat</span>
                    </div>
                    <!-- kirim komentar -->
                    <div class="card">
                        <div class="card-body p-2">
                            <form action="<?= base_url() ?>Dashboard/komentar_post" method="post">
                                <textarea class="p-2 shadow-sm" name="pesankomentar" id="pesankomentar" style="width:100%;border-radius:5px;border:1px solid #ced4da;" rows="2" placeholder="Tuliskan Pesan atau Pertanyaan Anda!" required></textarea>
                                <button type="submit" style="background-color: transparent;border: none;padding: 0;cursor: pointer;position:relative;margin-top:-2.3em;" class="float-right mr-3"><i class="fas fa-paper-plane send-button text-gray"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- list komentar -->
                    <div class="card">
                        <div class="card-body row">
                            <?php if($mkomentar):?>
                                <input type="hidden" id="idreplyactive">
                                <?php foreach($mkomentar as $k):?>
                                    <?php
                                        $this->db->order_by('lastupdate','ASC');
                                        $this->db->where('indukidkomentar',$k['idkomentar']);
                                        $this->db->where('jeniskomentar','S');
                                        $listreply = $this->db->get('mkomentar')->result_array();
                                    ?>
                                    <!-- komentar -->
                                    <div class="post col-12">
                                        <!-- foto komentar -->
                                        <div class="user-block">
                                            <img class="img-circle shadow-sm" src="<?= base_url() ?>assets/img/profile/user.png" alt="user image">
                                            <span class="username text-warning"><?= ucwords(strtolower($k['userkomentar'])) ?></span>
                                            <span class="description"><?= $this->RyuModel->hitungLamaNotifikasi($k['timekomentar'],date('Y-m-d H:i:s')) ?> Yang Lalu</span>
                                        </div>
                                        <!-- pesan komentar -->
                                        <p><?= $k['pesankomentar'] ?></p>
                                        <!-- button komentar -->
                                        <p class="mb-0">
                                            <a onclick="reply_coment('<?= $k['userkomentar'] ?>','<?= ucwords(strtolower($k['userkomentar'])) ?>','textreply<?= $k['idkomentar'] ?>')" style="cursor:pointer;" type="button" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>Balas</a>
                                            <?php if($listreply):?>
                                                <span class="float-right">
                                                    <a onclick="post_reply('lihat','sembunyi','postreply<?= $k['idkomentar'] ?>')" id="lihatpostreply<?= $k['idkomentar'] ?>" style="cursor:pointer;" type="button" class="link-black text-sm"><i class="fas fa-caret-down mr-1"></i>Lihat balasan (<?=count( $listreply )?>)</a>
                                                    <a onclick="post_reply('sembunyi','lihat','postreply<?= $k['idkomentar'] ?>')" id="sembunyipostreply<?= $k['idkomentar'] ?>" style="display: none;cursor:pointer;" type="button" class="link-black text-sm"><i class="fas fa-caret-up mr-1"></i>Sembunyikan balasan</a>
                                                </span>
                                            <?php endif;?>
                                        </p>
                                        <!-- list reply komentar -->
                                        <?php if($listreply):?>
                                            <div style="display: none;" id="postreply<?= $k['idkomentar'] ?>" class="post col-11 float-right mb-3 mt-3">
                                                <?php foreach($listreply as $rk):?>
                                                    <div class="user-block mt-3">
                                                        <img class="img-circle shadow-sm" src="<?= base_url() ?>assets/img/profile/user.png" alt="user image">
                                                        <span class="username text-yellow">
                                                            <?= ucwords(strtolower($rk['userkomentar'])) ?>
                                                        </span>
                                                        <span class="description"><?= $this->RyuModel->hitungLamaNotifikasi($rk['timekomentar'],date('Y-m-d H:i:s')) ?> Yang Lalu</span>
                                                    </div>
                                                    <p><span class="text-primary">@<?= ucwords(strtolower($rk['tagkomentar'])) ?> </span><?= $rk['pesankomentar'] ?></p>
                                                    <p class="mb-0"><a style="cursor:pointer;" type="button" onclick="reply_coment('<?= $rk['userkomentar'] ?>','<?= ucwords(strtolower($rk['userkomentar'])) ?>','textreply<?= $k['idkomentar'] ?>')" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>Balas</a></p>
                                                <?php endforeach;?>
                                            </div>
                                        <?php endif;?>
                                        <!-- balas komentar -->
                                        <form class="mt-2" action="<?= base_url() ?>Dashboard/komentar_reply/<?= $k['idkomentar'] ?>" method="post">
                                            <input type="hidden" name="tagkomentar" id="tagtextreply<?= $k['idkomentar'] ?>">
                                            <input style="display:none" name="pesankomentar" id="textreply<?= $k['idkomentar'] ?>" class="form-control form-control-sm" type="text" required>
                                            <button id="btntextreply<?= $k['idkomentar'] ?>" type="submit" style="display:none;background-color: transparent;border: none;padding: 0;cursor: pointer;position:relative;margin-top:-1.9em;font-size: 12px;"class="float-right mr-3"><i class="fas fa-paper-plane send-button text-gray"></i></button>
                                        </form>
                                    </div>
                                <?php endforeach;?>
                            <?php else:?>
                                <div class="col-12 text-center">
                                    - belum ada pesan dan kesan -
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <!-- Daftar peserta -->
                <div class="col-sm-3 order-md-3 order-2">
                    <div class="title-card mx-auto text-center">
                        <span>Daftar Peserta</span>
                    </div>
                    <div class="card">
                        <div class="card-body p-2">
                            <table style="font-size:14px" class="table table-sm table-bordered">
                                <!-- <thead>
                                    <tr>
                                        <th class="text-center">PESERTA</th>
                                        <th class="text-center">SIDANG</th>
                                    </tr>
                                </thead> -->
                                <tbody>
                                    <?php foreach($mdaftar as $d):?>
                                        <tr>
                                            <td>
                                                <?php if($d['daftarmajelis'] == 'P'):?>
                                                    PNT.
                                                <?php elseif($d['daftarmajelis'] == 'D'):?>
                                                    DKN.
                                                <?php endif;?>
                                                <?= $d['daftarnama'] ?>
                                            </td>
                                            <td>
                                                <?php if($d['daftarjenis'] == 'S'):?>
                                                    <?= strtoupper(str_replace(';','',$d['sidanglengkap'])) ?>
                                                <?php elseif($d['daftarjenis'] == 'W'):?>
                                                    <?= strtoupper(str_replace(';','',$d['wilayahnama'])) ?>
                                                <?php elseif($d['daftarjenis'] == 'P'):?>
                                                    PPMG
                                                <?php elseif($d['daftarjenis'] == 'L'):?>
                                                    PENINJAU
                                                <?php elseif($d['daftarjenis'] == 'A'):?>
                                                    PANITIA
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
      function reply_coment(useridcoment,usernamecoment, idtextreply) {
          // nonaktif reply active sebelumnya
          var idreplyactive = document.getElementById('idreplyactive');
          var isi_reply = '';
          if(idreplyactive.value !== ''){
            var active_textreply = document.getElementById(idreplyactive.value);
            var active_btntextreply = document.getElementById('btn' + idreplyactive.value);
            var active_tagtextreply = document.getElementById('tag' + idreplyactive.value);
            active_textreply.style.display = 'none';
            active_btntextreply.style.display = 'none';
            active_tagtextreply.value = '';
            active_textreply.placeholder = '';
            isi_reply = active_textreply.value;
          }
          // aktifkan reply active sekarang 
          var textreply = document.getElementById(idtextreply);
          var btntextreply = document.getElementById('btn' + idtextreply);
          var tagtextreply = document.getElementById('tag' + idtextreply);
          textreply.style.display = '';
          btntextreply.style.display = '';
          tagtextreply.value = useridcoment;
          textreply.placeholder = 'Balas @' + usernamecoment;
          textreply.value = isi_reply;
          // set reply active
          idreplyactive.value = idtextreply;
      }

      function post_reply(jenishide, jenistampil, idpostreply) {
          var postreply = document.getElementById(idpostreply);
          var jenishidepostreply = document.getElementById(jenishide + idpostreply);
          var jenistampilpostreply = document.getElementById(jenistampil + idpostreply);
          jenishidepostreply.style.display = 'none';
          jenistampilpostreply.style.display = '';
          if (jenistampil == 'lihat') {
              postreply.style.display = 'none';
          } else if (jenistampil == 'sembunyi') {
              postreply.style.display = '';
          }
      }
  </script>