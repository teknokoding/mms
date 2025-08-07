<div class="modal fade" id="modal-logout" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fa fa-sign-out"></i> Keluar Aplikasi</h3>
      </div>
      <div class="modal-body">
        <p>
          <b><?= $this->session->userdata('namalengkap'); ?></b>,
          yakin ingin keluar dari aplikasi?<br>
          Pastikan tidak ada transaksi aktif yang sedang anda lakukan&hellip;
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-light pull-left btn-lg" data-dismiss="modal">Batal</button>
        <?= anchor('logout', '<button type="button" class="btn btn-outline-light btn-lg">Keluar</button>'); ?>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline text-small">
    mubudiawan@gramediaprinting.com</div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2013-<?=date('Y');?>
    <a href="http://www.gramediaprinting.com">Gramedia Printing Bandung</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script
  src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js">
</script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- Hanya Angka -->
<script src="<?= base_url();?>assets/dist/js/hanya_angka.js"></script>
<!-- moment -->
<script src="<?= base_url();?>assets/plugins/moment/moment.min.js"></script>
<!-- MASK -->
<script
  src="<?= base_url();?>assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js">
</script>
<!-- date range -->
<script
  src="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.js">
</script>
<!-- Select2 -->
<script src="<?= base_url();?>assets/plugins/select2/js/select2.full.min.js">
</script>
<!-- SweetAlert2 -->
<script src="<?= base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js">
</script>
<!-- PrintThis -->
<script src="<?= base_url();?>assets/plugins/printThis/printThis.js"></script>
<!-- DataTables -->
<script
  src="<?= base_url();?>assets/plugins/datatables/jquery.dataTables.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables/extensions/export/buttons.flash.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables/extensions/export/buttons.html5.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables/extensions/export/buttons.print.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables/extensions/export/dataTables.buttons.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables/extensions/export/jszip.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables/extensions/export/pdfmake.min.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/datatables/extensions/export/vfs_fonts.js">
</script>
<script
  src="<?= base_url();?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js">
</script>
<script>
  $(document).ready(function() {
    bsCustomFileInput.init();
    //SELECT2
    $('.select2').select2({
      placeholder: 'Pilih'
    });
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      maximumSelectionLength: 6
    })
    //TANGGALAN
    $('.tanggalan').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'YYYY-MM-DD'
      }
    });

    //BULANAN
    $('.bulanan').datepicker({
      dateFormat: "yyyy-mm-dd",
      maxViewMode: 2,
      language: "id",
      autoclose: true
    });

  });

  function kembali() {
    window.history.go(-1);
  }
</script>
<script type="text/javascript">
  /*
$(document).ready(function(e) {
   var h = $('nav').height() + 30;
   $('.content-wrapper').animate({ paddingTop: h });
   
});
*/
  var logaudio = document.getElementById("LogoutAudio");

  function PlayLogout() {
    logaudio.play();
  }
  var chataudio = document.getElementById("ChatAudio");

  function PlayChat() {
    chataudio.play();
  }

  //JAM MASK
  $('.jammask').inputmask();
</script>
</body>

</html>