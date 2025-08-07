
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
                <h3 class="card-title">Edit Order Bengkel</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="form-order">
              <!-- SECURE SECURE SECURE -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id_spkbk" value="<?=$id_spkbk;?>">
              
                <div class="card-body">
                <!-- NAMA BARANG -------->
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                      <input  id="nama_barang" onkeyup="return this.value=this.value.toUpperCase()" name="nama_barang" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
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
                  <!-- SPESIFIKASI -------->
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-4 col-form-label">Spesifikasi</label>
                    <div class="col-sm-8">
                      <input id="spesifikasi" name="spesifikasi" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
                    </div>
                </div> 

                <!-- TARGET -------->
                <div class="form-group row">
                    <label for="status_pesan" class="col-sm-4 col-form-label">Target Selesai</label>
                    <div class="col-sm-8">
                      <input id="status_pesan" name="status_pesan" type="text" class="form-control form-control-sm tanggalan" autocomplete="off" required>
                    </div>
                </div> 
                  
                  <!-- IInstruksi -------->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-4 col-form-label">Instruksi</label>
                    <div class="col-sm-8">
                      <textarea id="note" name="note"  class="form-control form-control-sm" placeholder="" rows="3" spellcheck="false" required></textarea>
                    </div>
                  </div>    
                <!-- QTY MINTA -------->
                <div class="form-group row">
                    <label for="status" class="col-sm-4 col-form-label">Permintaan</label>
                    <div class="col-sm-4">
                    <input onkeypress='return HanyaAngka(event, false)' id="qty_minta" name="qty_minta" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
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
                  <a id="batal" href="<?=base_url('spkbk')?>"><div class='btn btn-danger'>Kembali</div>&nbsp;</a> 
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
          <table class="table table-sm table-hover">
           <thead>
            <tr>
             <th>No</th>
             <th>Nama Barang</th>
             <th>Mesin</th>
             <th>Spek</th>
             <th>Instruksi</th>
             <th>Qty</th>
             <th>Target</th>
             <th>Edit</th><th>Del</th>
            </tr>
           </thead>
           <tbody id="item_edit">
          </tbody>
          </table>
          </div>
          <div class="tombol_order card-footer">
                <div class="float-right">
                  <a href="<?=base_url('spkbk/draft_edit/').$id_spkbk;?>"><button  class="btn btn-warning">Simpan Draft</button></a>&nbsp;
                  <a href="<?=base_url('spkbk/finish_edit/').$id_spkbk;?>"><?php $this->session->userdata('id_level')>5?$tombol="":$tombol='<button  class="btn btn-info">Valid & Simpan SPK</button>';echo $tombol; ?></a>
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
                      <input   id="nama_barang_edit" onkeyup="return this.value=this.value.toUpperCase()" onkeyup="return this.value=this.value.toUpperCase()" name="nama_barang" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
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
                  <!-- SPESIFIKASI -------->
                <div class="form-group row">
                    <label for="spesifikasi" class="col-sm-4 col-form-label">Spesifikasi</label>
                    <div class="col-sm-8">
                      <input id="spesifikasi_edit" name="spesifikasi" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
                    </div>
                </div> 

                <!-- TARGET -------->
                <div class="form-group row">
                    <label for="status_pesan" class="col-sm-4 col-form-label">Target Selesai</label>
                    <div class="col-sm-8">
                      <input id="status_pesan_edit" name="status_pesan" type="text" class="form-control form-control-sm tanggalan" autocomplete="off" required>
                    </div>
                </div> 
                  
                  <!-- IInstruksi -------->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-4 col-form-label">Instruksi</label>
                    <div class="col-sm-8">
                      <textarea id="note_edit" name="note"  class="form-control form-control-sm" placeholder="" rows="3" spellcheck="false" required></textarea>
                    </div>
                  </div>    
                <!-- QTY MINTA -------->
                <div class="form-group row">
                    <label for="status" class="col-sm-4 col-form-label">Permintaan</label>
                    <div class="col-sm-4">
                    <input onkeypress='return HanyaAngka(event, false)' id="qty_minta_edit" name="qty_minta" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off" required>
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
                
                 <input type="hidden" id="id_spkbk" name="id_spkbk">
                 <input type="hidden" id="id_spkbk_detail" name="id_spkbk_detail">

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
     url: "<?=base_url('spkbk/edit_spk/').$id_spkbk;?>",
     data: csrf,
     success: function (response) {
       console.log(response);
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
         $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_barang+'</td><td>'+hasil[i].nama_mesin+'</td><td>'+hasil[i].spesifikasi+'</td><td>'+hasil[i].note+'</td><td>'+hasil[i].qty_minta+' '+hasil[i].kode_satuan+'</td><td>'+hasil[i].status_pesan+'</td><td><button onclick="edit_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
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
     url: "<?=base_url('spkbk/create_detail')?>",
     data: $(this).serialize(),
     success: function (response) {
       $("#item_edit").empty();
       $("#nama_barang").val('');
       $("#id_mesin").val('');
       $("#spesifikasi").val('');
       $("#status_pesan").val('');
       $("#note").val('');
       $("#qty_minta").val('');
       $("#id_satuan").val('');
       $(".tombol_order").show();
       console.log(response);
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
         $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_barang+'</td><td>'+hasil[i].nama_mesin+'</td><td>'+hasil[i].spesifikasi+'</td><td>'+hasil[i].note+'</td><td>'+hasil[i].qty_minta+' '+hasil[i].kode_satuan+'</td><td>'+hasil[i].status_pesan+'</td><td><button onclick="edit_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
 });
 

function hapus_detail(id_spkbk,id_spkbk_detail) {
  if (!confirm('Yakin hapus order ini?')) return false;
  $.ajax({
    type: "POST",
    url: "<?=base_url('spkbk/del_detail/')?>"+id_spkbk+"/"+id_spkbk_detail,
    data: csrf,
    success: function (response) {
      if(response=='[]'){$(".tombol_order").hide();$("#batal").show();$(".item_order").hide();}else{$(".tombol_order").show();$("#batal").hide();}
      $("#item_edit").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
        $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_barang+'</td><td>'+hasil[i].nama_mesin+'</td><td>'+hasil[i].spesifikasi+'</td><td>'+hasil[i].note+'</td><td>'+hasil[i].qty_minta+' '+hasil[i].kode_satuan+'</td><td>'+hasil[i].status_pesan+'</td><td><button onclick="edit_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
    }
  });
}

function edit_detail(id_spkbk,id_spkbk_detail) {
 $("#modal-edit").modal('show');  
 $.ajax({
   type: "POST",
   url: "<?=base_url('spkbk/edit_detail/')?>"+id_spkbk_detail,
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
       $("#qty_minta_edit").val(hasil[i].qty_minta);
       $("#id_satuan_edit").val(hasil[i].id_satuan);
       $("#id_spkbk").val(id_spkbk);
       $("#id_spkbk_detail").val(id_spkbk_detail);
      });
   }
 });
}

$("#form-edit").submit(function (e) { 
   e.preventDefault();
   $.ajax({
     type: "POST",
     url: "<?=base_url('spkbk/update_detail')?>",
     data: $(this).serialize(),
     success: function (response) {
       console.log(response);
       $("#item_edit").empty();
      var hasil = JSON.parse(response);
      var no=0;
      $.each(hasil, function (i, item) { 
        no++;
         $("#item_edit").append('<tr><td>'+no+'</td><td>'+hasil[i].nama_barang+'</td><td>'+hasil[i].nama_mesin+'</td><td>'+hasil[i].spesifikasi+'</td><td>'+hasil[i].note+'</td><td>'+hasil[i].qty_minta+' '+hasil[i].kode_satuan+'</td><td>'+hasil[i].status_pesan+'</td><td><button onclick="edit_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button></td><td><button onclick="hapus_detail('+hasil[i].id_spkbk+','+hasil[i].id_spkbk_detail+');"  class="hapus btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td></tr>');
      });
     }
   });
   $("#modal-edit").modal('hide'); 
 });
 
 function batal_all(id_spkbk){
  if (!confirm('Yakin membatalkan seluruh order bengkel ini?')) return false;
   $.ajax({
     type: "POST",
     url: "<?=base_url('spkbk/batal_all/')?>"+id_spkbk,
     data: csrf,
     success: function()
     {
      window.location.href='<?=base_url("spkbk");?>';
     }
   });
 }
</script>
