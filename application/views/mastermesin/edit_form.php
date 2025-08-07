<?php
foreach ($mesinedit as $itemedit) {
}
?>
<div class="modal fade" id="modal-edit">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Edit Departmen</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('mastermesin/update/').$itemedit->id_mesin;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="id_sect">Section</label>
                    <select name="id_sect" class="form-control form-control-sm" required>
                    <option value="">Pilih Section</option>
                    <?php
                    
                    foreach ($sect as $itemsect) {
                      $itemedit->id_sect==$itemsect->id_sect?$pilih="selected":$pilih="";
                      echo"
                      <option value='$itemsect->id_sect', $pilih>$itemsect->nama_sect</option>
                      ";
                    }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nama_mesin">Nama mesin</label>
                    <input value="<?=$itemedit->nama_mesin;?>" type="text" name="nama_mesin" id="nama_mesinedit" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group">
                  <?php $itemedit->prv=="Y"?$pilih="checked":$pilih="";?>
                    <div class="icheck-success d-inline judul" title="Mesin masuk dalam paket perawatan">
                        <input name="prv" type="checkbox"  id="check-prvedit" <?=$pilih?>>
                        <label for="check-prvedit"> As Preventive
                        </label>
                      </div>
                  </div>
                  <div class="form-group">
                  <?php $itemedit->brk=="Y"?$pilih="checked":$pilih="";?>
                    <div class="icheck-danger d-inline judul" title="Mesin masuk dalam kategori breakdown">
                        <input name="brk" type="checkbox"  id="check-brkedit" <?=$pilih?>>
                        <label for="check-brkedit"> As Breakdown
                        </label>
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
$('#modal-edit').modal('show');
$(".judul").tooltip();
$("#nama_mesinedit").keyup(function (e) { 
  $(this).val($(this).val().toUpperCase());

});
</script>