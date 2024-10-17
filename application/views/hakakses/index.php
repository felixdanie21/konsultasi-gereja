<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
				<div class="col-12 text-center">
					<h2 class="font-weight-bold">HAK AKSES PANITIA</h2>
					<a href="<?= base_url() ?>Dashboard"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
				</div>
			</div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div style="overflow: auto;height: 75vh" class="col-8 mx-auto">
                    <table id="<?= $idtable ?>" class="table table-sm table-bordered bg-white">
                        <thead class="bg-info">
                            <tr>
                                <th class="text-center align-middle">NOMOR HP</th>
                                <th class="text-center align-middle">NAMA</th>
                                <th class="text-center align-middle">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($muser as $mu):?>
                                <?php 
                                    $is_tampil = $this->PendaftaranModel->status_verifikasi($mu['userid']); 
                                ?>
                                <?php if($is_tampil == 'V'):?>
                                    <tr>
                                        <td class="text-left"><?= strtoupper($mu['userid']) ?></td>
                                        <td class="text-left"><?= strtoupper($mu['username']) ?></td>
                                        <td class="text-left">
                                        <a href="<?= base_url() ?>Hakakses/form/<?= $mu['userid'] ?>/D" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

