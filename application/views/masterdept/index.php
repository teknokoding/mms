<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Master Department</h1>
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
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-formdept"><i class="fa fa-plus"></i>&nbsp;Buat Departmen</button>
                    </div>
                    </div>
                    <div class="card-body">
                    <table id="tabel-dept" class="table  table-striped">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Departmen</th>
                    <th>Keterangan</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=0;
                      foreach($dept as $item)
                      {
                        $no++;
                        echo"
                        <tr>
                        <td>$no</td>
                        <td>$item->nama_dept</td>
                        <td>$item->note</td>
                        <td><button class='btn btn-xs btn-primary editdept' id_dept='$item->id_dept'>Edit</button></td>
                        <td><a onclick=\"javascript: return confirm('yakin menghapus $item->nama_dept ?');\" href='".base_url('masterdept/hapus/').$item->id_dept."'><button class='btn btn-danger btn-xs'>Hapus</button></a></td>
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
<div class="modal fade" id="modal-formdept">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Tambah Department Baru</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterdept/insert')?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="form-group kode_cl">
                    <label for="nama_dept">Nama Department</label>
                    <input type="text" name="nama_dept" id="nama_dept" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="note">Note Departmen</label>
                    <input type="text" name="note" id="note" class="form-control" required>
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
    $("#tabel-dept").DataTable();
  })
// EDIT DATA
$('.editdept').click(function()
{
  var id_dept = $(this).attr('id_dept');
  $("#form_edit").load('<?=base_url('masterdept/edit_form/');?>'+id_dept); 
})
</script>