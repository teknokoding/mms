<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
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
                        <a href="<?=base_url('penjadwalan/form')?>"><button class="btn btn-sm btn-success"><i class="fas fa-upload"></i> Upload Jadwal</button></a>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                            <tr class="table-primary">
                            <th>Tgl Upload</th>
                            <th>Nama File</th>
                            <th>Upload By</th>
                            <th>Detail</th>
                            <th>Hapus</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($upload as $item) {
                                    echo"
                                    <tr>
                                        <td>$item->tgl_upload</td>
                                        <td>$item->nama_file</td>
                                        <td>$item->upload_by</td>
                                        <td><button class='btn btn-xs btn-secondary detail' id_upload='$item->id_upload'>Detail</button></td>
                                        <td><a  href=\"javascript:hapus_upload('".$item->id_upload."','".$this->session->userdata('id_level')."')\"><button class='btn btn-xs btn-danger'>Hapus</button></a></td>
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
        </div>
         <!-- MODAL DETAIL -->
        <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
              <h4 class="modal-title">Detail Upload </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
        <table class="table table-sm">
        <thead>
        <tr class="table-active">
        <th>Mesin</th><th>Mulai</th><th>Selesai</th><th>Kode CL</th><th>Item</th><th>Hapus</th>
        </tr>
        </thead>
        <tbody id="detail-item">
        </tbody>
        </table>
        <!-- Modal body -->
        </div>
        <!-- Modal content -->
        </div>
        <!-- Modal dialog -->
        </div>
        <!-- Modal --> 
        </div>

        
     <!-- CONTAINER FLUID --> 
      </div>
    <!-- CONTENT -->
    </div>
<!-- CONTENT WRAPPER -->
</div>
<script>
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
$(document).ready(function()
{
// BUAT TAMPILIN SWEAT ALERT 
<?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>

$(".detail").click(function()
{
    var id_upload = $(this).attr('id_upload');
    $('#detail-item').empty();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('penjadwalan/readbyidupload/'); ?>" + id_upload,
        data: csrf,
        cache: false,
        success: function(hasil) {
          jadwal = jQuery.parseJSON(hasil);
          console.log(jadwal);
          $.each(jadwal, function(i, item) {
            $('#detail-item').append('<tr><td>'+jadwal[i].nama_mesin+'</td><td>'+jadwal[i].start_cl+'</td><td>'+jadwal[i].stop_cl+'</td><td>'+jadwal[i].kode_cl+'</td><td>'+jadwal[i].note_cl+'</td><td><a  href="javascript:hapus_cl(\''+jadwal[i].id_jadwal_cl+'\',\'<?=$this->session->userdata("id_level")?>\')"><button class="btn btn-xs btn-danger">Hapus</button></a></td></tr>');
          }); 
        }
      });
    $("#modal-detail").modal('show');
    
    
});

});
// HAPUS CL
function hapus_cl(id_jadwal_cl,level)
{
  if (level>5)
  {
    alert('Forbidden Access Level');
  }
  else
  {
  var tanyahapus = confirm('Anda akan menghapus jadwal?');
  if(tanyahapus==true)
  {
  $.ajax({ 
   type: "POST",
   url: "<?=base_url('preventive/hapus/')?>"+id_jadwal_cl,
   data: csrf,
   cache: false, 
   success: function(tampil){ 
  location.reload();
   } 
  });
  }
  }
}

// HAPUS UPLOAD
function hapus_upload(id_upload,level)
{
  if (level>5)
  {
    alert('Forbidden Access Level');
  }
  else
  {
  var tanyahapus = confirm('Anda akan menghapus satu set jadwal terupload?');
  if(tanyahapus==true)
  {
  $.ajax({ 
   type: "POST",
   url: "<?=base_url('penjadwalan/hapus_upload/')?>"+id_upload,
   data: csrf,
   cache: false, 
   success: function(tampil){ 
  location.reload();
   } 
  });
  }
  }
}
</script>