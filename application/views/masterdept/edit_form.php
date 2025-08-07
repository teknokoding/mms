<?php
foreach ($deptedit as $itemedit) {
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
<form role="form" method="post" action="<?=base_url('masterdept/update/').$itemedit->id_dept;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group kode_cl">
                    <label for="nama_dept">Nama Department</label>
                    <input value="<?=$itemedit->nama_dept?>" type="text" name="nama_dept" id="nama_dept" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="note">Keterangan</label>
                    <input value="<?=$itemedit->note?>" type="text" name="note" id="note" class="form-control" required>
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