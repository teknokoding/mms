<?php
foreach ($unitmesin_edit as $itemedit) {
}
?>
<div class="modal fade" id="modal-edit">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Edit Unit Mesin</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterunitmesin/update/').$itemedit->id_unitmesin;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="id_mesin">Mesin</label>
                    <select name="id_mesin" class="form-control form-control-sm" required>
                    <option value="">Pilih Mesin</option>
                    <?php
                    
                    foreach ($mesin_edit as $itemmesin_edit) {
                      $itemmesin_edit->id_mesin==$itemedit->id_mesin?$pilih="selected":$pilih="";
                      echo"
                      <option value='$itemmesin_edit->id_mesin', $pilih>$itemmesin_edit->nama_mesin</option>
                      ";
                    }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama_unitmesin">Nama unit mesin</label>
                    <input value="<?=$itemedit->nama_unitmesin;?>" type="text" name="nama_unitmesin" id="nama_unitmesinedit" class="form-control form-control-sm" required>
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
$('#modal-edit').modal('show');
$(".judul").tooltip();
$("#nama_unitmesinedit").keyup(function (e) { 
  $(this).val($(this).val().toUpperCase());

});
</script>