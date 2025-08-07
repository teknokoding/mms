<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Master Paket </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="card-tool">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-formpaket"><i class="fa fa-plus"></i>&nbsp;Buat Paket Rawat</button>
                    </div>
                    </div>
                    <div class="card-body">
                    <table id="tabel-paket" class="table  table-striped">
                    <thead>
                    <tr>
                    <th>Mesin</th>
                    <th>Kode CL</th>
                    <th>Item Checklist</th>
                    <th>Dokumen</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      foreach($paket as $item)
                      {
                        echo"
                        <tr>
                        <td>$item->nama_mesin</td>
                        <td>$item->kode_cl</td>
                        <td>$item->note_cl</td>
                        <td><a href='".base_url('assets/isodoc/').$item->kode_cl.".pdf' target='_blank>'<button class='btn btn-xs btn-warning'><i class='fa fa-file-pdf'></i> Pdf</button></a></td>
                        <td><button class='btn btn-xs btn-primary editpaket' id_cl='$item->id_cl'>Edit</button></td>
                        <td><a onclick=\"javascript: return confirm('yakin menghapus master paket ini?');\" href='".base_url('masterpaket/hapus/').$item->id_cl."/".$item->kode_cl."'><button class='btn btn-danger btn-xs'>Hapus</button></a></td>
                        </tr>
                        ";
                      }
                    ?>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
     <!-- CONTAINER FLUID --> 
      </div>
    <!-- CONTENT -->
    </div>
<!-- CONTENT WRAPPER -->
</div>
<div class="modal fade" id="modal-formpaket">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Tambah Paket Baru</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterpaket/insert')?>" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <label for="id_mesin">Mesin</label>
                    <select name="id_mesin" id="id_mesin" class="form-control select2" required>
                    <option value="">Pilih Mesin</option>
                    <?php
                    foreach($mesin as $itemmesin)
                    {
                    echo"<option value='$itemmesin->id_mesin'>$itemmesin->nama_mesin</option>";
                    }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kode_durasi">Jenis Paket</label>
                    <select name="kode_durasi" id="kode_durasi" class="form-control form-control-sm" required>
                    <option value="">Pilih Jenis Paket</option>
                    <?php
                    foreach($durasi as $itemdurasi)
                    {
                    echo"<option value='$itemdurasi->kode_durasi'>$itemdurasi->item_durasi</option>";
                    }
                    ?>
                    </select>
                  </div>
                  <div class="form-group kode_cl">
                    <label for="kode_durasi">Kode CL</label>
                    <input type="text" name="kode_cl" id="kode_cl" class="form-control form-control-sm" disabled>
                  </div>
                  <div id="feed_kode"></div>
                  <div class="form-group">
                    <label for="note_cl">Uraian Checklist</label>
                    <input type="text" name="note_cl" id="note_cl" class="form-control form-control-sm" required>
                  </div>
                 
                  <div class="form-group">
                    <label for="dokumen_cl">Dokumen Checklist (PDF)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="dokumen_cl" class="custom-file-input" id="dokumen_cl" accept=".pdf" required>
                        <label class="custom-file-label" for="dokumen_cl">Pilih File</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.modal-body -->

                <div class="modal-footer justify-content-between">
                  <button  type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                  <button id="simpan" type="submit" class="btn btn-sm btn-success" disabled>Submit</button>
                </div>
              </form>
</div>
</div>
</div>
<div id="form_edit"></div>
<script>
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
  $(document).ready(function()
  {
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
    // BUAT DATA TABLE
    $("#tabel-paket").DataTable();
  })
$(document).ready(function(){
  //BIKIN FUNGSI BUAT GENERATE KODE
function hasilkankode() {
var id_mesin = $("#id_mesin").val();
var kode_durasi = $("#kode_durasi").val();
$("#kode_cl").val(id_mesin+'_'+kode_durasi);
var kode_cl = $('#kode_cl').val();
$.ajax({
url: "<?=base_url();?>masterpaket/cek_kode/"+kode_cl,
type: "get",
data: csrf,
success: function(html){
$("#feed_kode").html(html);
}
});
}

// PAS OPSI MESIN GANTI, JALANKAN FUNGSI BIKIN KODE
$("#id_mesin").change(function(){
hasilkankode();
});
// PAS OPSI DURASI GANTI, JALANKAN FUNGSI BIKIN KODE
$("#kode_durasi").change(function(){
hasilkankode();
});
});
// EDIT DATA
$('.editpaket').click(function()
{
  var id_cl = $(this).attr('id_cl');
  $("#form_edit").load('<?=base_url('masterpaket/edit_form/');?>'+id_cl); 
})
</script>