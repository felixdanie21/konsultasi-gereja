<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-12 text-center">
					<h2 class="font-weight-bold">GALERI FOTO</h2>
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
				<div class="col-sm-7 mx-auto">
					<div class="table-responsive">
                        <a href="<?= base_url('Galeri/tambahfoto')?>" class="btn btn-primary mb-1">Tambah Foto <i class="fas fa-plus"></i></a>
						<table id="<?= $idtable ?>" class="table table-sm table-bordered bg-white">
						<thead class="bg-info">
							<tr>
								<th class="text-center align-middle">NO</th>
								<th class="text-center align-middle">FOTO</th>
								<th class="text-center align-middle">KETERANGAN</th>
								<th class="text-center align-middle">AKSI</th>
							</tr>
						</thead>
                        <?php $i = 1; ?>
						<?php foreach ($table as $row):?>
							<tbody>
								<tr >
									<td><?=$i++;?></td>
									<td>
										<img style="width:200px" src="<?= base_url() ?>assets/img/galeri/<?=$row['galerifile'];?>" alt="">
									</td>
									<td><?=$row['galeriket'];?></td>
									<td>
										<a href="<?= base_url('galeri/tambahfoto/edit/?galeriid=' . $row['galeriid']) ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
										<a href="<?= base_url('galeri/hapus/' . $row['galeriid']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')"><i class="fas fa-trash"></i></a>
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
