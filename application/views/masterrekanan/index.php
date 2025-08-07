<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Master Rekanan</h1>
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
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-formrelasi"><i class="fa fa-plus"></i>&nbsp;Tambah Rekanan</button>
                    </div>
                    </div>
                    <div class="card-body">
                    <table id="tabel-relasi" class="table  table-striped">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Rekanan</th>
                    <th>Alamat</th>
                    <th>Person</th>
                    <th>Posisi</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=0;
                      foreach($relasi as $item)
                      {
                        $no++;
                        echo"
                        <tr>
                        <td>$no</td>
                        <td>$item->nama_relasi</td>
                        <td>$item->alamat_relasi</td>
                        <td>$item->pic_relasi</td>
                        <td>$item->jabatan_relasi</td>
                        <td><button class='btn btn-xs btn-primary editrelasi' id_relasi='$item->id_relasi'>Edit</button></td>
                        <td><a onclick=\"javascript: return confirm('yakin menghapus $item->nama_relasi ?');\" href='".base_url('masterrekanan/hapus/').$item->id_relasi."'><button class='btn btn-danger btn-xs'>Hapus</button></a></td>
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
<div class="modal fade" id="modal-formrelasi">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Tambah Rekanan Baru</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterrekanan/insert')?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="form-group">
                    <label for="nama_relasi">Nama Rekanan</label>
                    <input type="text" name="nama_relasi" id="nama_relasi" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group">
                    <label for="nama_relasi">Alamat</label>
                    <textarea name="alamat_relasi" id="nama_relasi" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="pic_relasi">Person</label>
                    <input type="text" name="pic_relasi" id="pic_relasi" class="form-control form-control-sm">
                  </div>
                  <div class="form-group">
                    <label for="jabatan_pic">Jabatan/Posisi</label>
                    <input type="text" name="jabatan_relasi" id="jabatan_relasi" class="form-control form-control-sm">
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
    $("#tabel-relasi").DataTable();
  })
// EDIT DATA
$('.editrelasi').click(function()
{
  var id_relasi = $(this).attr('id_relasi');
  $("#form_edit").load('<?=base_url('masterrekanan/edit_form/');?>'+id_relasi); 
})
</script>