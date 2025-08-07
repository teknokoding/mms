
<div class="modal fade" id="modal-create">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Buat Jadwal Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" id="form-create">
            <div class="modal-body">
            
            <table class="table table-sm table-bordered table-striped">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            
            <div class="form-group row">
                    <label for="start_cl" class="col-sm-3 col-form-label">Tgl. Rencana</label>
                    <div class="col-sm-8">
                      <input name="start_cl" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                    </div>
            </div>

            <!-- MESIN -------->
            <div class="form-group row">
                    <label for="jenislkh" class="col-sm-3 col-form-label">Mesin</label>
                    <div class="col-sm-8">
                    <select name="id_mesin" id="id_mesin" required class="select2 form-control form-control-sm" placeholder="">
                    <option value="">Pilih Mesin</option>
                    <?php
                    foreach ($mesin as $item) 
                    {echo '<option value="'.$item->id_mesin.'">'.$item->nama_mesin.'</option>';}
                    ?>
                    </select>
                    </div>
            </div>

            <!-- PAKET -------->
            <div class="form-group row" id="paket">
                    <label for="kode_cl" class="col-sm-3 col-form-label">Paket</label>
                    <div class="col-sm-8">
                    <select name="kode_cl" id="kode_cl" required class="select2 form-control form-control-sm" placeholder="">
                    </select>
                    </div>
            </div>
            
            <!-- Modal body -->
            </div>
            <div class="modal-footer float-rigt">
            <button type="submit" class="btn btn-success">Simpan</button> 
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script>
$("#modal-create").modal('show');
$("#paket").hide();
$(document).ready(function()
{
// KLIK MESIN KELUAR PAKET
$('#id_mesin').change(function()
{
$('#paket').show();
var id_mesin = $(this).val();
$('#kode_cl').empty();
$('#kode_cl').append('<option value="">Pilih Paket</option>');
$.ajax({
        type: "POST",
        url: "<?php echo base_url('preventive/readpaketbymesin/'); ?>" + id_mesin,
        data: csrf,
        cache: false,
        success: function(hasil) {
          paket = jQuery.parseJSON(hasil);
          console.log(paket);
          $.each(paket, function(i, item) {
            $('#kode_cl').append('<option value="'+paket[i].kode_cl+'">'+paket[i].note_cl+'</option>');
          }); 
        }
      });
    });

  //TANGGALAN
  $('.tanggalan').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        format: "YYYY-MM-DD",
        }
  });

// SUBMIT JADWALNYA ===================================
$("#form-create").submit(function(e){
e.preventDefault();
$.ajax({ 
   type: "POST",
   url: "<?=base_url('preventive/create_cl')?>", 
   data: $(this).serialize(), 
   cache: false, 
   success: function(){ 
  location.reload();
   } 
});

});
});



</script>