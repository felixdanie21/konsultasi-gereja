<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold text-uppercase">HAK AKSES <?= $muser->username ?></h2>
                    <a href="<?= base_url() ?>Hakakses"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 mx-auto">
                    <div class="card">
                        <form action="<?= base_url() ?>Hakakses/post/<?= $muser->userid ?>/D" method="POST">
                            <div class="card-body">
                                <table>
                                    <thead>
                                        <tr>
                                            <td>
                                                <button onclick="pilihsemua()" type="button" class="btn btn-primary">PILIH SEMUA</button>
                                            </td>
                                            <td>
                                                <button onclick="hapussemua()" type="button" class="btn btn-dark">HAPUS SEMUA</button>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                <hr>
                                <?php foreach($mmenu as $m):?>
                                    <?php 
                                    $indukmenu = $this->db->get_where('musmenu',['userid'=>$muser->userid,'kodemenu'=>$m['indukmenu']])->row();
                                    $musmenu = $this->db->get_where('musmenu',['userid'=>$muser->userid,'kodemenu'=>$m['kodemenu']])->row();
                                    ?>
                                    <table>
                                        <thead>
                                            <tr>
                                                <td <?php if($m['levelmenu'] == '2'):?>class="pl-3"<?php endif;?>>
                                                    <input levelmenu='<?= $m['levelmenu'] ?>' <?php if($m['levelmenu'] == '1'):?>onclick="ubahSubmenu('<?= $m['kodemenu'] ?>')"<?php endif;?> style="width:30px;height:30px;" type="checkbox" class="menu sub<?= $m['indukmenu'] ?>" name="<?= $m['kodemenu'] ?>" id="<?= $m['kodemenu'] ?>" <?php if($m['levelmenu'] == '2' && !$indukmenu):?>disabled<?php endif;?> <?php if($musmenu):?>checked<?php endif;?>>
                                                </td>
                                                <td>
                                                    <span class="ml-2" style="font-size:15px"><?= $m['namamenu'] ?></span>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                <?php endforeach;?>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </form>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    function pilihsemua()
    {
        var menu = document.getElementsByClassName('menu');

        for(var i=0;i<menu.length;i++){
            if(menu[i].getAttribute('levelmenu') == '2'){
                menu[i].removeAttribute('disabled',true);
            }
            menu[i].checked = true ;
        }
    }

    function hapussemua()
    {
        var menu = document.getElementsByClassName('menu');

        for(var i=0;i<menu.length;i++){
            if(menu[i].getAttribute('levelmenu') == '2'){
                menu[i].setAttribute('disabled',true);
            }
            menu[i].checked = false ;
        }
    }

    function ubahSubmenu(id)
    {
        var kodemenu = document.getElementById(id);
        var submenu  = document.getElementsByClassName('sub'+id);

        if(kodemenu.checked == true){
            for(var i=0;i < submenu.length; i++){
                submenu[i].removeAttribute('disabled',true);
            }
        } else {
            for(var i=0;i < submenu.length; i++){
                submenu[i].setAttribute('disabled',true);
                submenu[i].checked = false ;
            }
        }
    }
</script>