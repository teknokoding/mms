<?php 
foreach ($paket as $itempaket) {
}
$start_date = date('Y-m-d',strtotime('-'.$itempaket->expired.' day',strtotime($itempaket->start_cl)));
$end_date = date('Y-m-d',strtotime('+'.$itempaket->expired.' day',strtotime($itempaket->start_cl)));
//$start_date = date('Y-m-d',strtotime('+1 day',strtotime($start_date)));
//$end_date = date('Y-m-d',strtotime('+1 day',strtotime($end_date)));

?>
<div class="modal fade" id="modal-geser">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Penjadwalan Ulang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" id="form-geser">
            <div class="modal-body">
            
            <table class="table table-sm table-bordered table-striped">
            <tr><td>Mesin</td><td>:</td><td><?=$itempaket->nama_mesin?></td></tr>
            <tr><td>Paket</td><td>:</td><td><?=$itempaket->kode_cl?></td></tr>
            <tr><td>Item</td><td>:</td><td><?=$itempaket->note_cl?></td></tr>
            <tr><td>Dijadwalkan</td><td>:</td><td><?=$itempaket->start_cl?> s/d <?=$itempaket->stop_cl?></td></tr>
            </table>
            
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            
            <div class="form-group row">
                    <label for="start_cl" class="col-sm-3 col-form-label">Jadwal Ulang</label>
                    <div class="col-sm-8">
                      <input value="<?=$itempaket->start_cl?>" name="start_cl" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                      <input type="hidden" name="geser_cl" value="<?=$itempaket->start_cl?>">
                    </div>
            </div>

            <div class="form-group row">
                    <label for="note_geser" class="col-sm-3 col-form-label">Catatan</label>
                    <div class="col-sm-8">
                      <textarea name="note_geser" class="form-control form-control-sm" placeholder="" rows="2" spellcheck="false" required></textarea>
                    </div>
            </div>


            <!-- Modal body -->
            </div>
            <div class="modal-footer float-rigt">
            
            <button type="submit" class="btn btn-success"><i class="fa fa-thumbtack"></i>&nbsp;Jadwalkan</button> 
            </div>
            </form>
          </div>
         
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script>
$("#modal-geser").modal('show');
var start_date = '<?=$start_date?>';
var end_date = '<?=$end_date?>'
$(document).ready(function()
{
  //TANGGALAN
  $('.tanggalan').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minDate:new Date(start_date),
    maxDate:new Date(end_date),
    locale: {
        format: "YYYY-MM-DD",
        }
  });

// GESER JADWALNYA ===================================
$("#form-geser").submit(function(e){
e.preventDefault();
$.ajax({ 
   type: "POST",
   url: "<?=base_url('preventive/geser/').$itempaket->id_jadwal_cl?>", 
   data: $(this).serialize(), 
   cache: false, 
   success: function(tampil){ 
  location.reload();
   } 
});

});
});



</script>