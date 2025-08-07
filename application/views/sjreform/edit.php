
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
              <div class="card-header bg-orange">
                <h3 class="card-title">Tambah Item</h3>
              </div>
              <div class="card-body">
                 
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
          <div class="card-header bg-orange">
          <div class="card-title">
          Item Order 
          </div>
          </div>
          <div class="card-body">
          <!-- relasi -->
          <div class="form-group row">
                    <label for="jenislkh" class="col-sm-2 col-form-label">Tujuan</label>
                    <div class="col-sm-6">
                    <select name="id_klien" id="id_klien" required class="form-control form-control-sm" placeholder="" required>
                  
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
          <table class="table table-sm table-hover">
           <thead>
            <tr>
             <th>No</th>
             <th>Pisau</th>
             <th>Jumlah</th>
             <th>Keterangan</th>
             <th></th>
            </tr>
           </thead>
           <tbody id="item_edit">
          </tbody>
          </table>
          </div>
          <div class="tombol_order card-footer">
                <div class="float-right">
                <button  id="finish_edit" onclick="finish_edit(<?=$id_reform;?>)" class="btn btn-info">Simpan Surat Jalan</button>
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
              <h5 class="modal-title">Tambah Item</h5>
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
                 <input type="hidden" id="id_reform_detail" name="id_reform_detail">

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
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
$.ajax({
     type: "POST",
     url: "<?=base_url('sjreform/edit_sjreform/').$id_reform;?>",
     data: csrf,
     success: function (response) {
       console.log(response);
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_pisau+'</td><td>'+hasil[i].qty_kirim+'</td><td>'+hasil[i].note+'</td><td><button onclick="edit_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
        $("#id_klien").val(hasil[i].id_klien).change();
      });
     }
   });
 
  $("#status_pesan").val('');

$(document).ready(function () {
  
  <?=$this->session->userdata('swal');$this->session->unset_userdata('swal');?>
});
 $("#form-order").submit(function (e) { 
   $(".item_order").show(); 
   e.preventDefault();
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjreform/create_detail')?>",
     data: $(this).serialize(),
     success: function (response) {
       $("#item_edit").empty();
       $("#id_pisau").val('');
       $("#note").val('');
       $("#qty_kirim").val('');
       $(".tombol_order").show();
       console.log(response);
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_pisau+'</td><td>'+hasil[i].qty_kirim+'</td><td>'+hasil[i].note+'</td><td><button onclick="edit_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
 });
 

function hapus_detail(id_reform,id_reform_detail) {
  if (!confirm('Yakin hapus order ini?')) return false;
  $.ajax({
    type: "POST",
    url: "<?=base_url('sjreform/del_detail/')?>"+id_reform+"/"+id_reform_detail,
    data: csrf,
    success: function (response) {
      if(response=='[]'){$(".tombol_order").hide();$("#batal").show();$(".item_order").hide();}else{$(".tombol_order").show();$("#batal").hide();}
      $("#item_edit").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_pisau+'</td><td>'+hasil[i].qty_kirim+'</td><td>'+hasil[i].note+'</td><td><button onclick="edit_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
    }
  });
}

function edit_detail(id_reform,id_reform_detail) {
 $("#modal-edit").modal('show');  
 $.ajax({
   type: "POST",
   url: "<?=base_url('sjreform/edit_detail/')?>"+id_reform_detail,
   data: csrf,
   success: function (response) {
    var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
       $("#nama_barang_edit").val(hasil[i].nama_barang);
       $("#id_pisau_edit").val(hasil[i].id_pisau);
       $("#note_edit").val(hasil[i].note);
       $("#qty_kirim_edit").val(hasil[i].qty_kirim);
       $("#id_reform").val(id_reform);
       $("#id_reform_detail").val(id_reform_detail);
      });
   }
 });
}

$("#form-edit").submit(function (e) { 
   e.preventDefault();
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjreform/update_detail')?>",
     data: $(this).serialize(),
     success: function (response) {
       console.log(response);
       $("#item_edit").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_pisau+'</td><td>'+hasil[i].qty_kirim+'</td><td>'+hasil[i].note+'</td><td><button onclick="edit_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_reform+','+hasil[i].id_reform_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
   $("#modal-edit").modal('hide'); 
 });
 
 function batal_all(id_reform){
  if (!confirm('Yakin membatalkan seluruh order reform ini?')) return false;
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

 function finish_edit(id_reform) {
   var id_klien = $("#id_klien").val();
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjreform/finish_edit/')?>"+id_reform+'/'+id_klien,
     data: csrf,
     success: function (response) {
      window.location.href='<?=base_url("sjreform");?>';
     }
   });
 }
</script>
