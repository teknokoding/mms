<?php
$id_reform = random_string('numeric',8);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">

      <!-- KOLOM  ------>
          <div class="col-lg-4">
          <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Form Surat Jalan Pisau</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                 <!-- relasi -->
                 <div class="form-group row">
                    <label for="jenislkh" class="col-sm-4 col-form-label">Tujuan</label>
                    <div class="col-sm-8">
                    <select name="id_klien" id="id_klien" required class="form-control form-control-sm" placeholder="" required>
                    <option value="">Pilih Tujuan</option>
                    <?php
                    foreach ($klien as $itemklien) {
                      echo"
                      <option value='$itemklien->id_klien'>$itemklien->nama_klien</option>
                      ";
                    }
                    ?>
                    </select>
                    </div>
                  </div>
                  <form class="form-horizontal" id="form-order">
              <!-- SECURE SECURE SECURE -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id_reform" value="<?=$id_reform;?>">
              
                  <!-- pisau -->
                <div class="form-group row">
                    <label for="jenislkh" class="col-sm-4 col-form-label">Pisau</label>
                    <div class="col-sm-8">
                    <select name="id_pisau" id="id_pisau" required class=" form-control form-control-sm" placeholder="">
                    <option value="">Pilh Pisau</option>
                    <?php
                    foreach ($pisau as $item) 
                    {echo '<option value="'.$item->id_pisau.'">'.$item->nama_pisau.'</option>';}
                    ?>
                    </select>
                    </div>
                  </div>
                  <!-- Keterangan  -------->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea id="note" name="note"  class="form-control form-control-sm" placeholder="" rows="3" spellcheck="false" required>Pisau Tajam</textarea>
                    </div>
                  </div>    
                <!-- QTy Kirim -------->
                <div class="form-group row">
                    <label for="status" class="col-sm-4 col-form-label">Jumlah</label>
                    <div class="col-sm-4">
                    <input onkeypress='return HanyaAngka(event, false)' id="qty_kirim" name="qty_kirim" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
                    </div>
                  </div>  
                
                 

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <div class="float-right">
                  <a id="batal" href="<?=base_url('sjreform')?>"><div class='btn btn-danger'>Batal</div>&nbsp;</a> 
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
          <!-- DIATAS END KOLOM ---->
          <div class="col-lg-8">
          <div class="card item_order">
          <div class="card-header bg-info">
          <div class="card-title">
          Item Order
          </div>
          </div>
          <div class="card-body">
          <table class="table table-sm table-hover">
           <thead>
            <tr>
             <th>No</th>
             <th>Pisau</th>
             <th>Jumlah</th>
             <th>Keterangan</th>
             <th>Edit</th><th>Del</th>
            </tr>
           </thead>
           <tbody id="item_temp">
          </tbody>
          </table>
          </div>
          <div class="tombol_order card-footer">
                <div class="float-right">
                  <button onclick="batal_all(<?=$id_reform;?>);" class='btn btn-danger'>Batal</button></td><td>
                  <button onclick="finish(<?=$id_reform;?>);" class='btn btn-info'>Simpan Surat Jalan</button></td><td>
                </div>
                </div>
          </div>
          </div>

        </div>
        <!-- /.row -->

        </div>
     <!-- CONTAINER FLUID --> 
      </div>
    <!-- CONTENT -->
    </div>
<!-- CONTENT WRAPPER -->
</div>

<!-- UNTUK EDIT BROOO -->
<div class="modal fade show" id="modal-edit" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Item</h5>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" id="form-edit">
              <!-- SECURE SECURE SECURE -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="card-body">
                
                  <!-- pisau -->
                <div class="form-group row">
                    <label for="jenislkh" class="col-sm-4 col-form-label">Pisau</label>
                    <div class="col-sm-8">
                    <select name="id_pisau" id="id_pisau_edit" required class=" form-control form-control-sm" placeholder="">
                    
                    <?php
                    foreach ($pisau as $item) 
                    {echo '<option value="'.$item->id_pisau.'">'.$item->nama_pisau.'</option>';}
                    ?>
                    </select>
                    </div>
                  </div>
                  
                  
                  <!-- Keterangan -------->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea id="note_edit" name="note"  class="form-control form-control-sm" placeholder="" rows="3" spellcheck="false" required></textarea>
                    </div>
                  </div>    
                <!-- QTY MINTA -------->
                <div class="form-group row">
                    <label for="status" class="col-sm-4 col-form-label">Jumlah</label>
                    <div class="col-sm-4">
                    <input onkeypress='return HanyaAngka(event, false)' id="qty_kirim_edit" name="qty_kirim" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="col-sm-4">
                    </div>
                  </div>  
                
                 <input type="hidden" id="id_reform" name="id_reform">
                 <input type="hidden" id="id_reform_temp" name="id_reform_temp">

                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                <div class="float-right">
                  <div data-dismiss="modal" class='btn btn-danger'>Batal</div>&nbsp;
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </div>
                <!-- /.card-footer -->
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
</div>
<script>

$(".item_order").hide();
 $(".tombol_order").hide();
  $("#status_pesan").val('');
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
$(document).ready(function () {
  <?=$this->session->userdata('swal');$this->session->unset_userdata('swal');?>
});
 $("#form-order").submit(function (e) { 
   $(".item_order").show();
   e.preventDefault();
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjreform/create_temp')?>",
     data: $(this).serialize(),
     success: function (response) {
       $("#id_klien").attr('disabled',true);
       $("#item_temp").empty();
       $("#id_pisau").val('');
       $("#qty_kirim").val('');
       $("#batal").hide();
       $(".tombol_order").show();
       console.log(response);
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
         $("#item_temp").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_pisau+'</td><td>'+hasil[i].qty_kirim+'</td><td>'+hasil[i].note+'</td><td><button onclick="edit_temp('+hasil[i].id_reform+','+hasil[i].id_reform_temp+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_temp('+hasil[i].id_reform+','+hasil[i].id_reform_temp+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
 });
 

function hapus_temp(id_reform,id_reform_temp) {
  if (!confirm('Yakin hapus item ini?')) return false;
  $.ajax({
    type: "POST",
    url: "<?=base_url('sjreform/del_temp/')?>"+id_reform+"/"+id_reform_temp,
    data: csrf,
    success: function (response) {
      if(response=='[]'){$(".tombol_order").hide();$("#batal").show();$(".item_order").hide();}else{$(".tombol_order").show();$("#batal").hide();}
      $("#item_temp").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_temp").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_pisau+'</td><td>'+hasil[i].qty_kirim+'</td><td>'+hasil[i].note+'</td><td><button onclick="edit_temp('+hasil[i].id_reform+','+hasil[i].id_reform_temp+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_temp('+hasil[i].id_reform+','+hasil[i].id_reform_temp+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
    }
  });
}

function edit_temp(id_reform,id_reform_temp) {
 $("#modal-edit").modal('show');  
 $.ajax({
   type: "POST",
   url: "<?=base_url('sjreform/edit/')?>"+id_reform_temp,
   data: csrf,
   success: function (response) {
    var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
       $("#nama_barang_edit").val(hasil[i].nama_barang);
       $("#id_pisau_edit").val(hasil[i].id_pisau);
       $("#spesifikasi_edit").val(hasil[i].spesifikasi);
       $("#status_pesan_edit").val(hasil[i].status_pesan);
       $("#note_edit").val(hasil[i].note);
       $("#qty_kirim_edit").val(hasil[i].qty_kirim);
       $("#id_klien_edit").val(hasil[i].id_klien);
       $("#id_reform").val(id_reform);
       $("#id_reform_temp").val(id_reform_temp);
      });
   }
 });
}

$("#form-edit").submit(function (e) { 
   e.preventDefault();
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjreform/update_temp')?>",
     data: $(this).serialize(),
     success: function (response) {
       $("#item_temp").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_temp").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_pisau+'</td><td>'+hasil[i].qty_kirim+'</td><td>'+hasil[i].note+'</td><td><button onclick="edit_temp('+hasil[i].id_reform+','+hasil[i].id_reform_temp+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_temp('+hasil[i].id_reform+','+hasil[i].id_reform_temp+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
   $("#modal-edit").modal('hide'); 
 });
 
 function batal_all(id_reform){
  if (!confirm('Yakin membatalkan seluruh Surat Jalan ini?')) return false;
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjreform/batal_all/')?>"+id_reform,
     data: csrf,
     success: function()
     {
      window.location.href='<?=base_url("sjreform");?>';
     }
   });
 }
 function finish(id_reform)
  {
    var id_klien = $("#id_klien").val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('sjreform/finish/')?>"+id_reform+'/'+id_klien,
      data: csrf,
      success: function (response) {
        window.location.href='<?=base_url("sjreform");?>';
      }
    });
  }
</script>
