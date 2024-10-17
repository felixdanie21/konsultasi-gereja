<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-12 text-center">
					<h2 class="font-weight-bold">KEGIATAN KBPS 2023</h2>
					<a href="<?= base_url() ?>Dashboard"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="table-responsive">
                    <a href="<?= base_url('kegiatan/tambahberita')?>" class="btn btn-primary mb-1">Tambah Berita <i class="fas fa-plus"></i></a>
                    <table id="<?= $idtable ?>" style="font-size:14px;" id="example1" class="table table-sm table-bordered bg-white">
						<thead class="bg-info">
							<tr>
								<th class="text-center align-middle">NO</th>
								<th class="text-center align-middle">JUDUL</th>
								<th width="40%" class="text-center align-middle">ISI</th>
								<th class="text-center align-middle">SAMPUL</th>
								<th width="10%" class="text-center align-middle">USER</th>
								<th width="10%" class="text-center align-middle">AKSI</th>
								
							</tr>
						</thead>
                        <?php $i=1; ?>
						<?php foreach ($table as $row):?>
							<tbody>

								<tr>
                                    <td><?=$i++;?></td>
									<td><?=$row['beritajudul'];?></td>
									<td><?= $this->RyuModel->maxtext($row['beritaisi'],300);?></td>
									<td><img style="width:200px;" src="<?= base_url() ?>assets/img/berita/<?=$row['beritagambar'];?>" alt=""></td>
									<td><?=$row['beritauser'];?></td>
									<td>
									
                                    <a href="<?= base_url('kegiatan/tambahberita/edit/?beritaid=' . $row['beritaid']) ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
										<a href="<?= base_url('kegiatan/hapus/' . $row['beritaid']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')"><i class="fas fa-trash"></i></a>
                                </td>
								</tr>
							</tbody>
						<?php endforeach;?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
