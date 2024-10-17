
<script>
        
        window.onload = function(){
        <?php if($this->session->userdata('successmsg')):?>
            toastr.success('<?=  $this->session->userdata('successmsg') ?>');
            <?php $this->session->unset_userdata('successmsg')  ?>
        <?php endif;?>
        <?php if($this->session->userdata('errormsg')):?>
            toastr.error('<?=  $this->session->userdata('errormsg') ?>');
            <?php $this->session->unset_userdata('errormsg')  ?>
        <?php endif;?>
        <?php if($this->session->userdata('infomsg')):?>
            toastr.info('<?=  $this->session->userdata('infomsg') ?>');
            <?php $this->session->unset_userdata('infomsg')  ?>
        <?php endif;?>
        }

        function reply_coment(useridcoment,usernamecoment, idtextreply) {
            // nonaktif reply active sebelumnya
            var idreplyactive = document.getElementById('idreplyactive');
            var nama_ygreply = '';
            var isi_reply = '';
            if(idreplyactive.value !== ''){
            var active_textreply = document.getElementById(idreplyactive.value);
            var active_namatextreply = document.getElementById('nama' + idreplyactive.value);
            var active_btntextreply = document.getElementById('btn' + idreplyactive.value);
            var active_tagtextreply = document.getElementById('tag' + idreplyactive.value);
            active_textreply.style.display = 'none';
            active_namatextreply.style.display = 'none';
            active_btntextreply.style.display = 'none';
            active_tagtextreply.value = '';
            active_textreply.placeholder = '';
            nama_ygreply = active_namatextreply.value;
            isi_reply = active_textreply.value;
            }
            // aktifkan reply active sekarang 
            var textreply = document.getElementById(idtextreply);
            var namatextreply = document.getElementById('nama' + idtextreply);
            var btntextreply = document.getElementById('btn' + idtextreply);
            var tagtextreply = document.getElementById('tag' + idtextreply);
            textreply.style.display = '';
            namatextreply.style.display = '';
            btntextreply.style.display = '';
            tagtextreply.value = useridcoment;
            textreply.placeholder = 'Balas @' + usernamecoment;
            textreply.value = isi_reply;
            namatextreply.value = nama_ygreply;
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

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
</body>
</html>