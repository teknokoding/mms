<!-- Content Wrapper. Contains page content -->
unit<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Master unit mesin</h1>
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
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-formmesin"><i
                    class="fa fa-plus"></i>&nbsp;Tambah Unit Mesin</button>

              </div>
            </div>
            <div class="card-body">
              <table id="tabel-unitmesin" class="table  table-striped">
                <thead> 
                  <tr>
                    <th>No</th>
                    <th>Nama mesin</th>
                    <th>Unit</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no=0;
                      foreach ($unitmesin as $item) {
                          $no++;
                          echo"
                        <tr>
                        <td>$no</td>
                        <td>$item->nama_mesin</td>
                        <td>$item->nama_unitmesin</td>
                        <td><button class='btn btn-xs btn-primary editunitmesin' id_unitmesin='$item->id_unitmesin'>Edit</button></td>
                        <td><a onclick=\"javascript: return confirm('yakin menghapus $item->nama_unitmesin ?');\" href='".base_url('masterunitmesin/hapus/').$item->id_unitmesin."'><button class='btn btn-danger btn-xs'>Hapus</button></a></td>
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
<div class="modal fade" id="modal-formmesin">
i  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <h5>Tambah Unit Mesin</h5>
        </div>
      </div>
      <form role="form" method="post"
        action="<?=base_url('masterunitmesin/insert')?>">
        <div class="modal-body">
          <input type="hidden"
            name="<?php echo $this->security->get_csrf_token_name();?>"
            value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="form-group">
            <label for="id_mesin">Mesin</label>
            <select name="id_mesin" class="form-control form-control-sm" required>
              <option value="">Pilih Mesin</option>
              <?php
                    foreach ($mesin as $itemmesin) {
                        echo"
                      <option value='$itemmesin->id_mesin'>$itemmesin->nama_mesin</option>
                      ";
                    }
                    ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama_unitmesin">Nama Unit</label>
            <input type="text" name="nama_unitmesin" id="nama_unitmesin" class="form-control form-control-sm" required>
          </div>
        </div>
        <!-- /.modal-body -->

        <div class="modal-footer justify-content-between">
          <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
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
  $(document).ready(function() {
    document.title = 'MMS V3.0 - Daftar Unit Mesin';
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
    // BUAT DATA TABLE
    $("#tabel-unitmesin").DataTable({
      "info": false,
      "paging": false,
      "searching": true,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'print'
      ]
    });
  });
  // EDIT DATA
  $('.editunitmesin').click(function() {
    var id_unitmesin = $(this).attr('id_unitmesin');
    $("#form_edit").load(
      '<?=base_url('masterunitmesin/edit_form/');?>' +
      id_unitmesin);
  })
  $("#nama_unitmesin").keyup(function(e) {
    $(this).val($(this).val().toUpperCase());

  });
</script>