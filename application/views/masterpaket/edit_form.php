<?php
foreach ($paketedit as $itemedit) {
}
?>
<div class="modal fade" id="modal-edit">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Edit Paket</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterpaket/update/').$itemedit->id_cl;?>" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <label for="id_mesin">Mesin <?=$itemedit->id_mesin;?></label>
                    <select name="id_mesin" id="id_mesinedit" class="form-control select2 form-control-sm" required>
                    <?php
                    foreach($mesinedit as $itemmesinedit)
                    {
                    $itemmesinedit->id_mesin==$itemedit->id_mesin?$pilih="selected":$pilih="";
                    echo"<option value='$itemmesinedit->id_mesin', $pilih>$itemmesinedit->nama_mesin</option>";
                    }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kode_durasi">Jenis Paket</label>
                    <select name="kode_durasi" id="kode_durasiedit" class="form-control form-control-sm" required>
                    <option value="">Pilih Jenis Paket</option>
                    <?php
                    foreach($durasiedit as $itemdurasiedit)
                    {
                    $itemedit->kode_durasi==$itemdurasiedit->kode_durasi?$pilih="selected":$pilih="";
                    echo"<option value='$itemdurasiedit->kode_durasi', $pilih>$itemdurasiedit->item_durasi</option>";
                    }
                    ?>
                    </select>
                  </div>
                  <div class="form-group kode_cl">
                    <label for="kode_durasi">Kode CL</label>
                    <input type="text" name="kode_cl" id="kode_cledit" class="form-control form-control-sm" disabled>
                  </div>
                  <div id="feed_kodeedit"></div>
                  <div class="form-group">
                    <label for="note_cl">Uraian Checklist</label>
                    <input type="text" name="note_cl" id="note_cledit" class="form-control form-control-sm" value="<?=$itemedit->note_cl;?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="dokumen_cl">Dokumen Checklist (PDF)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="dokumen_cl" class="custom-file-input" id="dokumen_cl"  accept=".pdf">
                        <label class="custom-file-label" for="dokumen_cl">Pilih File</label>
                      </div>
                    </div>
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
  bsCustomFileInput.init();
  $('.select2').select2({
  placeholder: 'Pilih'
  });
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
url: "<?=base_url();?>masterpaket/cek_kode/"+kode_cl,
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