</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Default script -->
<script src="<?= base_url() ?>assets/js/script.js?n=1"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- onload script -->
<script>
  $(function() {
    // integerasi input type
    inputType();
    // toastr
    <?php if ($this->session->userdata('successmsg')) : ?>
      toastr.success('<?= $this->session->userdata('successmsg') ?>');
      <?php
        $this->session->unset_userdata('successmsg');
      ?>
    <?php endif; ?>
    <?php if ($this->session->userdata('errormsg')) : ?>
      toastr.error('<?= $this->session->userdata('errormsg') ?>');
      <?php
        $this->session->unset_userdata('errormsg');
      ?>
    <?php endif; ?>
    <?php if ($this->session->userdata('infomsg')) : ?>
      toastr.info('<?= $this->session->userdata('infomsg') ?>');
      <?php
        $this->session->unset_userdata('infomsg');
      ?>
    <?php endif; ?>
    // pengaturan class menu
    <?php if ($indukmenu) : ?>
        var menu = document.getElementById('<?= $indukmenu ?>');
        menu.removeAttribute('class', true);
        menu.setAttribute('class', 'nav-link active');
    <?php endif; ?>
    <?php if ($submenu) : ?>
        var menu = document.getElementById('<?= $submenu ?>');
        menu.removeAttribute('class', true);
        menu.setAttribute('class', 'nav-link active');
        <?php if ($indukmenu) : ?>
            var tree = document.getElementById('<?= $indukmenu ?>tree');
            tree.removeAttribute('class', true);
            tree.setAttribute('class', 'nav-item menu-open');
            menuOpen('<?= $indukmenu ?>');
        <?php endif; ?>
    <?php endif; ?>
    // data table
    <?php if ($idtable == 'mdaftar') : ?>
        $("#mdaftar").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
            "info": false,
            "paging": false,
        });
    <?php endif; ?>
    <?php if ($idtable == 'hakaksespanitia') : ?>
        $("#hakaksespanitia").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
            "info": false,
            "paging": false,
        });
    <?php endif; ?>
  });
</script>
<!-- Menu Open -->
<script>
   function menuOpen(kodemenu) {
        var icon = document.getElementById(kodemenu + 'icon');
        if (icon.className == 'nav-icon fas fa-folder') {
            icon.removeAttribute('class', true);
            icon.setAttribute('class', 'nav-icon fas fa-folder-open');
        } else if (icon.className == 'nav-icon fas fa-folder-open') {
            icon.removeAttribute('class', true);
            icon.setAttribute('class', 'nav-icon fas fa-folder');
        }
    }
</script>
</body>
</html>
