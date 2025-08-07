<?php
foreach ($relasiedit as $itemedit) {
}
?>
<div class="modal fade" id="modal-edit">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Edit Rekanan</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterrekanan/update/').$itemedit->id_relasi;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="nama_relasi">Nama Rekanan</label>
                    <input value="<?=$itemedit->nama_relasi;?>" type="text" name="nama_relasi" id="nama_relasi" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group">
                    <label for="nama_relasi">Alamat</label>
                    <textarea name="alamat_relasi" id="nama_relasi" rows="4" class="form-control"><?=$itemedit->alamat_relasi;?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="pic_relasi">Person</label>
                    <input value="<?=$itemedit->pic_relasi;?>" type="text" name="pic_relasi" id="pic_relasi" class="form-control form-control-sm">
                  </div>
                  <div class="form-group">
                    <label for="jabatan_pic">Jabatan/Posisi</label>
                    <input value="<?=$itemedit->jabatan_relasi;?>" type="text" name="jabatan_relasi" id="jabatan_relasi" class="form-control form-control-sm">
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
</script>