<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Master Durasi</h1>
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
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-formdurasi"><i class="fa fa-plus"></i>&nbsp;Buat Durasi</button>
                    </div>
                    </div>
                    <div class="card-body">
                    <table id="tabel-durasi" class="table  table-striped">
                    <thead>
                    <tr>
                    <th>Kode Durasi</th>
                    <th>Durasi (Hari)</th>
                    <th>Expired (Hari)</th>
                    <th>Note</th>
                    <th>Durasi PHP</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      foreach($durasi as $item)
                      {
                        echo"
                        <tr>
                        <td>$item->kode_durasi</td>
                        <td>$item->durasi</td>
                        <td>$item->expired</td>
                        <td>$item->item_durasi</td>
                        <td>$item->durasi_php</td>
                        <td><button class='btn btn-xs btn-primary editdurasi' id_durasi_cl='$item->id_durasi_cl'>Edit</button></td>
                        <td><a onclick=\"javascript: return confirm('yakin menghapus durasi ini?');\" href='".base_url('masterdurasi/hapus/').$item->id_durasi_cl."'><button class='btn btn-danger btn-xs'>Hapus</button></a></td>
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
<div class="modal fade" id="modal-formdurasi">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Tambah Durasi Baru</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterdurasi/insert')?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="form-group kode_cl">
                    <label for="kode_durasi">Kode Durasi</label>
                    <input type="text" name="kode_durasi" id="kode_durasi" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Durasi (Hari)</label>
                    <input type="text" name="durasi" id="durasi" class="form-control" onkeypress='return HanyaAngka(event, false)' required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Expired (Hari)</label>
                    <input type="text" name="expired" id="expired" class="form-control" onkeypress='return HanyaAngka(event, false)' required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Durasi PHP</label>
                    <input type="text" name="durasi_php" id="durasi_php" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Note Durasi</label>
                    <input type="text" name="item_durasi" id="item_durasi" class="form-control" required>
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
    $("#tabel-durasi").DataTable();
  })
// EDIT DATA
$('.editdurasi').click(function()
{
  var id_durasi_cl = $(this).attr('id_durasi_cl');
  $("#form_edit").load('<?=base_url('masterdurasi/edit_form/');?>'+id_durasi_cl); 
})
</script>