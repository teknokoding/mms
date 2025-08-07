<?php
foreach ($paket as $itempaket) {
}
$start_date = date('Y-m-d', strtotime('+'.$itempaket->durasi_php, strtotime($itempaket->start_cl)));
$end_date = date('Y-m-d', strtotime('+'.$itempaket->expired.' day', strtotime($start_date)));


?>
<div class="modal fade" id="modal-skip">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Skip Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="form-geser">
        <div class="modal-body">
          <input type="hidden" name="start_cl"
            value="<?=$start_date?>">
          <input type="hidden" name="stop_cl" value="<?=$end_date?>">
          <input type="hidden" name="kode_cl"
            value="<?=$itempaket->kode_cl?>">
          <input type="hidden" name="id_mesin"
            value="<?=$itempaket->id_mesin?>">
          <input type="hidden"
            name="<?php echo $this->security->get_csrf_token_name(); ?>"
            value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label">Dijadwalkan kembali</label>
            <div class="col-sm-7">
              <input
                value="<?=date('d-m-Y', strtotime($start_date));?>"
                name="" type="text" class="form-control form-control-sm" placeholder="" disabled>

            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label">Masa Berlaku</label>
            <div class="col-sm-7">
              <input
                value="<?=date('d-m-Y', strtotime($end_date));?>"
                name="" type="text" class="form-control form-control-sm" placeholder="" disabled>

            </div>
          </div>
          <div class="form-group row">
            <label for="note_skip" class="col-sm-4 col-form-label">Catatan</label>
            <div class="col-sm-7">
              <textarea name="note_skip" class="form-control form-control-sm" placeholder="" rows="2" spellcheck="false"
                required></textarea>
            </div>
          </div>


          <!-- Modal body -->
        </div>
        <div class="modal-footer float-rigt">

          <button type="submit" class="btn btn-danger"><i class="fa fa-bolt"></i>&nbsp;Skip</button>
        </div>
      </form>
    </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  $("#modal-skip").modal('show');
  $(document).ready(function() {

    // GESER JADWALNYA ===================================
    $("#form-geser").submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?=base_url('preventive/skip/').$itempaket->id_jadwal_cl?>",
        data: $(this).serialize(),
        cache: false,
        success: function(tampil) {
          location.reload();
        }
      });

    });
  });
</script>