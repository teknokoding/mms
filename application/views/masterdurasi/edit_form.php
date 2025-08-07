<?php
foreach ($durasiedit as $itemedit) {
}
?>
<div class="modal fade" id="modal-edit">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Edit Durasi</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterdurasi/update/').$itemedit->id_durasi_cl;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group kode_cl">
                    <label for="kode_durasi">Kode Durasi</label>
                    <input value="<?=$itemedit->kode_durasi?>" type="text" name="kode_durasi" id="kode_durasi" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Durasi (Hari)</label>
                    <input value="<?=$itemedit->durasi?>" type="text" name="durasi" id="durasi" class="form-control" onkeypress='return HanyaAngka(event, false)' required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Expired (Hari)</label>
                    <input value="<?=$itemedit->expired?>" type="text" name="expired" id="expired" class="form-control" onkeypress='return HanyaAngka(event, false)' required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Durasi PHP</label>
                    <input value="<?=$itemedit->durasi_php?>" type="text" name="durasi_php" id="durasi_php" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Note Durasi</label>
                    <input value="<?=$itemedit->item_durasi?>" type="text" name="item_durasi" id="item_durasi" class="form-control" required>
                  </div>
                </div>
                <!-- /.modal-body -->

                <div class="modal-footer justify-content-between">
                  <button  type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                  <button id="simpan" type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
              </form>
</div>
</div>
</div>
<script>
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
$(document).ready(function(){
$(".kode_cl").hide();
$("#modal-edit").modal('show');
  //BIKIN FUNGSI BUAT GENERATE KODE
function hasilkankode() {
$("#modal-edit").modal('show');
var id_mesin = $("#id_mesinedit").val();
var kode_durasi = $("#kode_durasiedit").val();
$("#kode_cledit").val(id_mesin+'_'+kode_durasi);
var kode_cl = $('#kode_cledit').val();
$.ajax({
url: "<?=base_url();?>masterdurasi/cek_kode/"+kode_cl,
type: "get",
data: csrf,
success: function(html){
$("#feed_kodeedit").html(html);
}
});
}

// PAS OPSI MESIN GANTI, JALANKAN FUNGSI BIKIN KODE
$("#id_mesinedit").change(function(){
hasilkankode();
});
// PAS OPSI DURASI GANTI, JALANKAN FUNGSI BIKIN KODE
$("#kode_durasiedit").change(function(){
hasilkankode();
});
});
</script>