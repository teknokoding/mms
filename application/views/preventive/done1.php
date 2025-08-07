<?php
foreach ($paket as $itempaket) {
}
foreach ($prev as $itemprev) {
}
$start_date = date('Y-m-d', strtotime('+'.$itempaket->durasi_php, strtotime($itempaket->start_cl)));
$end_date = date('Y-m-d', strtotime('+'.$itempaket->expired.' day', strtotime($start_date)));
?>

?>
<div class="modal fade" id="modal-done">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?=$itempaket->nama_mesin.'/'.$itempaket->kode_cl?>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="form-done">
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
            <label for="done_cl" class="col-sm-3 col-form-label">Tanggal</label>
            <div class="col-sm-8">
              <?php
              if ($itemprev->done_cl!="0000-00-00") {
                  $tgl_done = $itemprev->done_cl;
              } else {
                  $tgl_done= date('Y-m-d');
              }
            ?>
              <input value="<?=$tgl_done?>" name="done_cl"
                type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="uraian_cl" class="col-sm-3 col-form-label">Uraian</label>
            <div class="col-sm-8">
              <textarea id="uraian_cl" name="uraian_cl" class="form-control form-control-sm" placeholder="" rows="5"
                spellcheck="false" required>
                <?php if ($itemprev->uraian_cl!="") {
                $uraian_cl = $itemprev->uraian_cl;
            } else {
                $uraian_cl = $itempaket->note_cl;
            }
//echo $uraian_cl;
                ?>
                </textarea>
              <script>
                $("#uraian_cl").val("<?=$uraian_cl;?>");
              </script>
            </div>
          </div>

          <!-- PELAKSANA -------->
          <div class="form-group row">
            <label for="pelaksana1" class="col-sm-3 col-form-label">Pelaksana</label>
            <div class="col-sm-8">
              <select multiple="multiple" class="select2bs4 form-control form-control-sm" id="pelaksana"
                name="pelaksana[]" data-placeholder="Pilih Pelaksana" style="width: 100%;" required>
                <?php
                    foreach ($karyawan as $itemkaryawan) {
                        for ($i=1;$i<=6;$i++) {
                            $pelaksana = "pelaksana".$i;
                            if ($itemprev->$pelaksana==$itemkaryawan->nik) {
                                $pilihan[$i]="selected";
                            } else {
                                $pilihan[$i] = "";
                            }
                        }
                        echo '<option value="'.$itemkaryawan->nik.'", '.$pilihan[1].$pilihan[2].$pilihan[3].$pilihan[4].$pilihan[5].$pilihan[6].'>'.$itemkaryawan->nama_karyawan.'</option>';
                    }
                    ?>
              </select>
            </div>
          </div>
          <!-- INPUT BY -------->
          <div class="form-group row">
            <label for="pelaksana1" class="col-sm-3 col-form-label">Input By</label>
            <div class="col-sm-8">
              <select class="select2bs4 form-control form-control-sm" id="input" name="input"
                data-placeholder="Pilih Pelaksana" style="width: 100%;" required>
                <?php
                    foreach ($karyawan as $iteminput) {
                        if ($this->session->userdata('username')==$iteminput->nik) {
                            $pilih="selected";
                        } else {
                            $pilih="";
                        }
                        echo '<option value="'.$iteminput->nik.'", '.$pilih.'>'.$iteminput->nama_karyawan.'</option>';
                    }
                    ?>
              </select>
            </div>
          </div>

          <!-- Modal body -->
        </div>
        <div class="modal-footer float-rigt">

          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;Check</button>
        </div>
      </form>
    </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
  $(document).ready(function() {

    //TANGGALAN
    $('.tanggalan').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'YYYY-MM-DD'
      }
    });
    //SELECT2
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      maximumSelectionLength: 6
    })

    // GESER JADWALNYA ===================================
    $("#form-done").submit(function(e) {
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "<?=base_url('preventive/done1/').$itempaket->id_jadwal_cl?>",
        data: $(this).serialize(),
        cache: false,
        success: function() {
          location.reload();
        }
      });
    });
  });
  $("#modal-done").modal('show');
</script>