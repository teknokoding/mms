<div class="modal fade" id="modal-release">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5><i class="fas fa-paper-plane"></i>&nbsp;Release Tag No:<?=$id_tag;?></h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('tpm/do_release/').$id_tag;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="tgl_rel">Tanggal</label>
                    <input type="text" name="tgl_rel" id="tgl_rel" class="form-control form-control-sm tanggalan" required>
                </div>
                <div class="form-group">
                    <label for="action">Action</label>
                    <textarea id="action" name="action"  class="form-control form-control-sm" placeholder="" rows="3" spellcheck="false" required></textarea>
                </div>
                <!-- STATUS -------->
                <div class="form-group">
                    <label for="rel_stat">Satus</label>
                    <select name="rel_stat" id="rel_stat" required class="form-control form-control-sm" placeholder="">
                    <option value="">Pilih Status</option>
                    <option value="OK">OK</option>
                    <option value="NOK">NOK</option>
                    <option value="M">MONITOR</option>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="id_mesin">Pelaksana</label>
                    <select multiple="multiple" class="select2bs4 form-control form-control-sm" id="pelaksana" name="pelaksana[]"  data-placeholder="Pilih Pelaksana" style="width: 100%;" required>
                    <?php
                    foreach ($karyawan as $item) 
                    {echo '<option value="'.$item->nik.'">'.$item->nama_karyawan.'</option>';}
                    ?>
                    </select>
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
$("#modal-release").modal('show');
});
</script>