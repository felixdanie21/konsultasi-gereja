<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold"><?= strtoupper($method) ?> FOTO</h2>
                    <a href="<?= base_url() ?>Galeri"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                        <form method="post" action="<?= base_url('galeri/tambah_post') ?>/<?= $method ?>" enctype="multipart/form-data">
                            <input type="hidden" name="galeriid" id="galeriid">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="foto" class="font-weight-normal">PILIH FOTO</label>
                                    <input class="form-control" type="file" name="galerifile" id="galerifile" accept="png,jpeg,jpg" required>
                                    <img id="previewfoto" class="mt-2" width="300px" src="" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="galeriket" class="font-weight-normal">KETERANGAN</label>
                                    <input class="form-control" type="text" name="galeriket" id="galeriket"" placeholder="Masukkan keterangan foto" maxlength="50">
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
    const inputFile = document.getElementById('galerifile');
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
            var galeriid = document.getElementById('galeriid');
            var galerifile = document.getElementById('galerifile');
            var galeriket = document.getElementById('galeriket');
            galeriid.value = '<?= $mgaleri->galeriid ?>';
            galerifile.removeAttribute('required',true);
            galeriket.value = '<?= $mgaleri->galeriket ?>';
            previewfoto.setAttribute('src', '<?= base_url() ?>assets/img/galeri/<?= $mgaleri->galerifile ?>');
        }
    <?php endif;?>
</script>