 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 text-center">
            <h2 class="font-weight-bold">IMPORT CSV</h2>
            <a href="<?= base_url() ?>Dashboard"><i class="fas fa-long-arrow-alt-left"></i> KEMBALI</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-info">
                    <div class="card-header">
                    </div>
                    <form action="<?= base_url() ?>SuperAdmin/importcsv_post" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile" class="font-weight-normal">FILE CSV</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <select class="form-control" name="file" required>
                                            <option value="">-- PILIH --</option>
                                            <?php $jml = count($file) - 1; ?>
                                            <?php for ($i = 2; $i <= $jml; $i++) : ?>
                                                <option value="<?= $file[$i]; ?>"><?= $file[$i] ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" class="font-weight-normal">TABLE</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <select class="form-control" name="table" required>
                                            <option value="">-- PILIH --</option>
                                            <?php foreach ($table as $t) : ?>
                                                <option value="<?= $t; ?>"><?= $t ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">PROSES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->