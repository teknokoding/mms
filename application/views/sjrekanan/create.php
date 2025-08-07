<?php
$id_lain = random_string('numeric',8);
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
                <h3 class="card-title">Form Surat Jalan Rekanan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              
                <div class="card-body">
                 <!-- relasi -->
                 <div class="form-group row">
                    <label for="jenislkh" class="col-sm-4 col-form-label">Tujuan</label>
                    <div class="col-sm-8">
                    <select name="id_relasi" id="id_relasi" required class="form-control form-control-sm" placeholder="" required>
                    <option value="">Pilih Tujuan</option>
                    <?php
                    foreach ($relasi as $itemrelasi) {
                      echo"
                      <option value='$itemrelasi->id_relasi'>$itemrelasi->nama_relasi</option>
                      ";
                    }
                    ?>
                    </select>
                    </div>
                  </div>
                <form class="form-horizontal" id="form-order">
              <!-- SECURE SECURE SECURE -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id_lain" value="<?=$id_lain;?>">
                <!-- NAMA BARANG -------->
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                      <input   id="nama_barang" onkeyup="return this.value=this.value.toUpperCase()" onkeyup="return this.value=this.value.toUpperCase()" name="nama_barang" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
                    </div>
                </div> 
                  <!-- MESIN -->
                <div class="form-group row">
                    <label for="jenislkh" class="col-sm-4 col-form-label">Mesin</label>
                    <div class="col-sm-8">
                    <select name="id_mesin" id="id_mesin" required class=" form-control form-control-sm" placeholder="">
                    <option value="">Pilh Mesin</option>
                    <?php
                    foreach ($mesin as $item) 
                    {echo '<option value="'.$item->id_mesin.'">'.$item->nama_mesin.'</option>';}
                    ?>
                    </select>
                    </div>
                  </div>
                  <!-- Keterangan  -------->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea id="note" name="note"  class="form-control form-control-sm" placeholder="" rows="3" spellcheck="false" required></textarea>
                    </div>
                  </div>    
                <!-- QTy Kirim -------->
                <div class="form-group row">
                    <label for="status" class="col-sm-4 col-form-label">Jumlah</label>
                    <div class="col-sm-4">
                    <input onkeypress='return HanyaAngka(event, false)' id="qty_kirim" name="qty_kirim" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="col-sm-4">
                    <select name="id_satuan" id="id_satuan" required class="form-control form-control-sm" placeholder="" required>
                    <option value="">Satuan</option>
                    <?php
                    foreach ($satuan as $itemsatuan) {
                      echo"
                      <option value='$itemsatuan->id_satuan'>$itemsatuan->nama_satuan</option>
                      ";
                    }
                    ?>
                    </select>
                    </div>
                  </div>  
                
                 

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <div class="float-right">
                  <a id="batal" href="<?=base_url('sjrekanan')?>"><div class='btn btn-danger'>Batal</div>&nbsp;</a> 
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
             <th>Nama Barang</th>
             <th>Mesin</th>
             <th>Keterangan</th>
             <th>Jumlah</th>
             <th>Edit</th><th>Del</th>
            </tr>
           </thead>
           <tbody id="item_temp">
          </tbody>
          </table>
          </div>
          <div class="tombol_order card-footer">
                <div class="float-right">
                  <button onclick="batal_all(<?=$id_lain;?>);" class='btn btn-danger'>Batal</button></td><td>
                  <button  onclick="finish(<?=$id_lain;?>);" class="btn btn-info">Simpan Surat Jalan</button>
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
                <!-- NAMA BARANG -------->
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                      <input id="nama_barang_edit" name="nama_barang" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
                    </div>
                </div> 
                  <!-- MESIN -->
                <div class="form-group row">
                    <label for="jenislkh" class="col-sm-4 col-form-label">Mesin</label>
                    <div class="col-sm-8">
                    <select name="id_mesin" id="id_mesin_edit" required class=" form-control form-control-sm" placeholder="">
                    <option value="">Pilh Mesin</option>
                    <?php
                    foreach ($mesin as $item) 
                    {echo '<option value="'.$item->id_mesin.'">'.$item->nama_mesin.'</option>';}
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
                    <select name="id_satuan" id="id_satuan_edit" required class="form-control form-control-sm" placeholder="" required>
                    <option value="">Satuan</option>
                    <?php
                    foreach ($satuan as $itemsatuan) {
                      echo"
                      <option value='$itemsatuan->id_satuan'>$itemsatuan->nama_satuan</option>
                      ";
                    }
                    ?>
                    </select>
                    </div>
                  </div>  
                
                 <input type="hidden" id="id_lain" name="id_lain">
                 <input type="hidden" id="id_lain_temp" name="id_lain_temp">

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
     url: "<?=base_url('sjrekanan/create_temp')?>",
     data: $(this).serialize(),
     success: function (response) {
      $("#id_relasi").attr('disabled',true);
       $("#item_temp").empty();
       $("#nama_barang").val('');
       $("#id_mesin").val('');
       $("#note").val('');
       $("#qty_kirim").val('');
       $("#id_satuan").val('');
       $("#batal").hide();
       $(".tombol_order").show();
       console.log(response);
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
         $("#item_temp").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_barang+'</td><td>'+hasil[i].nama_mesin+'</td><td>'+hasil[i].note+'</td><td>'+hasil[i].qty_kirim+' '+hasil[i].kode_satuan+'</td><td><button onclick="edit_temp('+hasil[i].id_lain+','+hasil[i].id_lain_temp+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_temp('+hasil[i].id_lain+','+hasil[i].id_lain_temp+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
 });
 

function hapus_temp(id_lain,id_lain_temp) {
  if (!confirm('Yakin hapus item ini?')) return false;
  $.ajax({
    type: "POST",
    url: "<?=base_url('sjrekanan/del_temp/')?>"+id_lain+"/"+id_lain_temp,
    data: csrf,
    success: function (response) {
      if(response=='[]'){$(".tombol_order").hide();$("#batal").show();$(".item_order").hide();}else{$(".tombol_order").show();$("#batal").hide();}
      $("#item_temp").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_temp").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_barang+'</td><td>'+hasil[i].nama_mesin+'</td><td>'+hasil[i].note+'</td><td>'+hasil[i].qty_kirim+' '+hasil[i].kode_satuan+'</td><td><button onclick="edit_temp('+hasil[i].id_lain+','+hasil[i].id_lain_temp+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_temp('+hasil[i].id_lain+','+hasil[i].id_lain_temp+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
    }
  });
}

function edit_temp(id_lain,id_lain_temp) {
 $("#modal-edit").modal('show');  
 $.ajax({
   type: "POST",
   url: "<?=base_url('sjrekanan/edit/')?>"+id_lain_temp,
   data: csrf,
   success: function (response) {
    var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
       $("#nama_barang_edit").val(hasil[i].nama_barang);
       $("#id_mesin_edit").val(hasil[i].id_mesin);
       $("#spesifikasi_edit").val(hasil[i].spesifikasi);
       $("#status_pesan_edit").val(hasil[i].status_pesan);
       $("#note_edit").val(hasil[i].note);
       $("#qty_kirim_edit").val(hasil[i].qty_kirim);
       $("#id_satuan_edit").val(hasil[i].id_satuan);
       $("#id_lain").val(id_lain);
       $("#id_lain_temp").val(id_lain_temp);
      });
   }
 });
}

$("#form-edit").submit(function (e) { 
   e.preventDefault();
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjrekanan/update_temp')?>",
     data: $(this).serialize(),
     success: function (response) {
       $("#item_temp").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
         $("#item_temp").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_barang+'</td><td>'+hasil[i].nama_mesin+'</td><td>'+hasil[i].note+'</td><td>'+hasil[i].qty_kirim+' '+hasil[i].kode_satuan+'</td><td><button onclick="edit_temp('+hasil[i].id_lain+','+hasil[i].id_lain_temp+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_temp('+hasil[i].id_lain+','+hasil[i].id_lain_temp+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
   $("#modal-edit").modal('hide'); 
 });
 
 function batal_all(id_lain){
  if (!confirm('Yakin membatalkan seluruh Surat Jalan ini?')) return false;
   $.ajax({
     type: "POST",
     url: "<?=base_url('sjrekanan/batal_all/')?>"+id_lain,
     data: csrf,
     success: function()
     {
      window.location.href='<?=base_url("sjrekanan");?>';
     }
   });
 }
 function finish(id_lain)
  {
    var id_relasi = $("#id_relasi").val();
    $.ajax({
      type: "POST",
      url: "<?=base_url('sjrekanan/finish/')?>"+id_lain+'/'+id_relasi,
      data: csrf,
      success: function (response) {
        window.location.href='<?=base_url("sjrekanan");?>';
      }
    });
  }
</script>
