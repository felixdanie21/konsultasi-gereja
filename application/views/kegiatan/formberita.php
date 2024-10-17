<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold"><?= strtoupper($method) ?> BERITA</h2>
                    <a href="<?= base_url() ?>Kegiatan"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 mx-auto">
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                        <form method="post" action="<?= base_url('kegiatan/form_post') ?>/<?= $method ?>" enctype="multipart/form-data">
                            <input type="hidden" name="beritaid" id="beritaid">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="beritajudul" class="font-weight-normal">JUDUL BERITA</label>
                                    <input class="form-control" type="text" name="beritajudul" id="beritajudul" placeholder="Masukkan Judul Berita" maxlengt="30" required>
                                </div>
                                <div class="form-group">
                                    <label for="beritaisi" class="font-weight-normal">ISI BERITA</label>
                                    <textarea name="beritaisi" id="beritaisi" style="width:100%" rows="10" required><?php if($method == 'edit'):?><?= $mberita->beritaisi ?><?php endif;?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="font-weight-normal">PILIH SAMPUL</label>
                                    <input class="form-control" type="file" name="beritagambar" id="beritagambar" accept="png,jpeg,jpg" required>
                                    <img id="previewfoto" class="mt-2" width="300px" src="" alt="">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">PROSES</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const inputFile = document.getElementById('beritagambar');
    const previewImage = document.getElementById('previewfoto');
    
    inputFile.addEventListener('change', function() {
    const file = inputFile.files[0];
    const reader = new FileReader();
    
    reader.addEventListener('load', function() {
        previewImage.src = reader.result;
    }, false);
    
    if (file) {
        reader.readAsDataURL(file);
    }
    }, false);

    window.onload = function(){
        <?php if($method == 'edit'):?>
            edit_kondisi();
        <?php endif;?>
    }

    <?php if($method == 'edit'):?>
        function edit_kondisi(){
            var previewfoto = document.getElementById('previewfoto');
            var beritaid = document.getElementById('beritaid');
            var beritajudul = document.getElementById('beritajudul');
            var beritaisi = document.getElementById('beritaisi');
            var beritagambar = document.getElementById('beritagambar');
            beritaid.value = '<?= $mberita->beritaid ?>';
            beritagambar.removeAttribute('required',true);
            beritajudul.value = '<?= $mberita->beritajudul ?>';
            previewfoto.setAttribute('src', '<?= base_url() ?>assets/img/berita/<?= $mberita->beritagambar ?>');
        }
    <?php endif;?>
</script>