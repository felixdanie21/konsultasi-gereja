<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-12 text-center">
					<h2 class="font-weight-bold">DATA USER</h2>
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
                        <a href="<?= base_url('Datauser/form')?>" class="btn btn-primary mb-1">Tambah User <i class="fas fa-plus"></i></a>
						<table id="<?= $idtable ?>" class="table table-sm table-bordered bg-white">
						<thead class="bg-info">
							<tr>
								<th class="text-center align-middle">NO</th>
								<th class="text-center align-middle">USERID</th>
								<th class="text-center align-middle">USERNAME</th>
								<th class="text-center align-middle">PASSWORD</th>
								<th class="text-center align-middle">STATUS USER</th>
								<th class="text-center align-middle">AKSI</th>
							</tr>
						</thead>
                        <?php $i = 1; ?>
						<?php foreach ($table as $row):?>
							<tbody>
								<tr >
									<td><?=$i++;?></td>
									<td><?= strtoupper($row['userid']) ?></td>
									<td><?= strtoupper($row['username']) ?></td>
									<td><?=$row['password'];?></td>
									<td><?=$row['userlevel']?></td>
									<td>
										<a href="<?= base_url('datauser/form/edit/?userid=' . $row['userid']) ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
										<?php if($row['userid'] == $row['password']):?>
											<a href="<?= base_url('datauser/hapus/' . $row['userid']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')"><i class="fas fa-trash"></i></a>
										<?php endif;?>
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
