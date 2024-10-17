 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 text-center">
            <h2 class="m-0 text-uppercase font-weight-bold">Konsultasi</h2>
            <h4 class="m-0 text-uppercase font-weight-bold">Badan Pimpinan Sidang Se KGPM Tahun 2023</h4>
            <span>
                Tema : “Satu Kasih, Satu Jiwa, Satu Tujuan” (Filipi 2 : 2b)
            </span>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="alert alert-info mx-auto" role="alert">
                    Akun anda akan diverifikasi oleh admin 1x24 Jam.
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
      function reply_coment(useridcoment,usernamecoment, idtextreply) {
          // nonaktif reply active sebelumnya
          var idreplyactive = document.getElementById('idreplyactive');
          var isi_reply = '';
          if(idreplyactive.value !== ''){
            var active_textreply = document.getElementById(idreplyactive.value);
            var active_btntextreply = document.getElementById('btn' + idreplyactive.value);
            var active_tagtextreply = document.getElementById('tag' + idreplyactive.value);
            active_textreply.style.display = 'none';
            active_btntextreply.style.display = 'none';
            active_tagtextreply.value = '';
            active_textreply.placeholder = '';
            isi_reply = active_textreply.value;
          }
          // aktifkan reply active sekarang 
          var textreply = document.getElementById(idtextreply);
          var btntextreply = document.getElementById('btn' + idtextreply);
          var tagtextreply = document.getElementById('tag' + idtextreply);
          textreply.style.display = '';
          btntextreply.style.display = '';
          tagtextreply.value = useridcoment;
          textreply.placeholder = 'Balas @' + usernamecoment;
          textreply.value = isi_reply;
          // set reply active
          idreplyactive.value = idtextreply;
      }

      function post_reply(jenishide, jenistampil, idpostreply) {
          var postreply = document.getElementById(idpostreply);
          var jenishidepostreply = document.getElementById(jenishide + idpostreply);
          var jenistampilpostreply = document.getElementById(jenistampil + idpostreply);
          jenishidepostreply.style.display = 'none';
          jenistampilpostreply.style.display = '';
          if (jenistampil == 'lihat') {
              postreply.style.display = 'none';
          } else if (jenistampil == 'sembunyi') {
              postreply.style.display = '';
          }
      }
  </script>