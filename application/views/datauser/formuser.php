<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold"><?= strtoupper($method) ?> DATA USER</h2>
                    <a href="<?= base_url() ?>Datauser"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
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
                        <form method="post" action="<?= base_url('datauser/form_post') ?>/<?= $method ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="userid" class="font-weight-normal">ID USER</label>
                                    <input onchange="cek_userid()" class="form-control" type="text" name="userid" id="userid"" placeholder="Masukkan UserId" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="font-weight-normal">USERNAME</label>
                                    <input  class="form-control" type="text" name="username" id="username" placeholder="Masukkan Username" maxlength="50" required >
                                </div>
                                <div class="form-group">
                                    <label for="galeriket" class="font-weight-normal">STATUS</label>
                                    <select class="form-control" name="userlevel" id="userlevel">
                                        <option value="">-- PILIH --</option>
                                        <option value="0">ADMIN</option>
                                        <option value="1">PANITIA</option>
                                    </select>             
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
window.onload = function() {
    <?php if ($method == 'edit'): ?>
        edit_kondisi();
    <?php endif; ?>
}

<?php if ($method == 'edit'): ?>
    function edit_kondisi() {
        var userid = document.getElementById('userid');
        var username = document.getElementById('username');
        var userlevel = document.getElementById('userlevel');
        
        userid.readOnly = true;
        userid.value = '<?= $muser->userid ?>';
        username.value = '<?= $muser->username ?>';
        userlevel.value = '<?= $muser->userlevel ?>';
    
    }
<?php endif; ?>

function cek_userid()
{
    var userid = document.getElementById('userid');
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            var response = ajax.responseText;
            console.log(response);
            // alert(response);
            if(response == '1'){
                toastr.error('ID USER SUDAH DIGUNAKAN');
                userid.setAttribute('placeholder',userid.value);
                userid.value = '';
            }
        }
    }
    ajax.open('POST','<?= base_url() ?>Datauser/ajax_datauser_cek_userid',true);
    ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
    ajax.send('userid='+userid.value);
}

</script>