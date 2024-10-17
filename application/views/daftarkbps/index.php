<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-12 text-center">
					<h2 class="font-weight-bold">DATA PENDAFTARAN</h2>
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
						<table id="<?= $idtable ?>" style="font-size:12px;" id="example1" class="table table-sm table-bordered bg-white">
						<thead class="bg-info">
							<tr>
								<th class="text-center align-middle">NO.HP</th>
								<th class="text-center align-middle">NAMA</th>
								<th class="text-center align-middle">TGL LAHIR</th>
								<th class="text-center align-middle">L/P</th>
								<th class="text-center align-middle">SIDANG</th>
								<th class="text-center align-middle">JNS PESERTA</th>
								<th class="text-center align-middle">KD PESERTA</th>
								<th class="text-center align-middle">STS DAFTAR</th>
								<th class="text-center align-middle">FUNGSI HP</th>
								<!-- <th class="text-center align-middle">EMAIL</th> -->
								<?php if($this->session->userdata('userlevel') == '0'):?>
									<th class="text-center align-middle">PASSWORD</th>
									<th class="text-center align-middle">AKSI</th>
								<?php else:?>
									<th class="text-center align-middle">STS VERIFIKASI</th>
								<?php endif;?>
							</tr>
						</thead>
						<?php foreach ($table as $row):?>
							<tbody>
								<?php
									switch($row['daftarverif']){
										case 'B':
											$color_body = 'bg-white';
											break;
										case 'S':
											$color_body = 'bg-success';
											break;
										default :
											$color_body = 'bg-white';
											break;
									}
								?>
								<tr class="<?= $color_body ?>">
									<td><?=$row['daftarhp'];?></td>
									<td>
										<?php if($row['daftarmajelis'] == 'P'):?>
											PNT.
										<?php elseif($row['daftarmajelis'] == 'D'):?>
											DKN.
										<?php endif;?>
										<?=$row['daftarnama'];?>
									</td>
									<td><?= date('d-m-Y',strtotime($row['daftartglhr']));?></td>
									<td class="text-center"><?=$row['daftarjk'];?></td>
									<td><?= strtoupper(str_replace(';','',$row['sidanglengkap']));?></td>
									<td><?= $this->PendaftaranModel->jenispeserta($row['daftarjenis']);?></td>
									<td><?=$row['daftarkp'];?></td>
									<td><?= $this->PendaftaranModel->statuspendaftaran($row['daftarstat']);?></td>
									<td class="text-center"><?= $this->PendaftaranModel->fungsihp($row['daftarfungsi'],'icon');?></td>
									<!-- <td><?=$row['daftaremail'];?></td> -->
									<?php if($this->session->userdata('userlevel') == '0'):?>
										<td><?=$row['password'];?></td>
										<td>
											<?php if($row['daftarverif'] == 'B'):?>
												<a style="font-size:12px" onclik="return confirm('Anda yakin ingin memverifikasi?')" href="<?= base_url() ?>Daftarkbps/verifikasi/<?= $row['daftarkp'] ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
												<?php else:?>
													<a style="font-size:12px" onclik="return confirm('Anda yakin ingin membatalkan verifikasi?')" href="<?= base_url() ?>Daftarkbps/verifikasi_batal/<?= $row['daftarkp'] ?>" class="btn btn-sm btn-dark"><i class="fas fa-times"></i></a>
											<?php endif;?>
										</td>
									<?php else:?>
										<td class="text-center">
											<?= $this->PendaftaranModel->jenisverifikasi($row['daftarverif']);?>
										</td>
									<?php endif;?>
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
