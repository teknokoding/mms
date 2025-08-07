<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Master mesin</h1>
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
                    class="fa fa-plus"></i>&nbsp;Tambah Mesin</button>

              </div>
            </div>
            <div class="card-body">
              <table id="tabel-mesin" class="table  table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama mesin</th>
                    <th>Section</th>
                    <th>Aktif</th>
                    <th>As Preventive</th>
                    <th>As Breakdown</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no=0;
                      foreach ($mesin as $item) {
                          $no++;
                          echo"
                        <tr>
                        <td>$no</td>
                        <td>$item->nama_mesin</td>
                        <td>$item->nama_sect</td>
                        <td>$item->aktif</td>
                        <td>$item->prv</td>
                        <td>$item->brk</td>
                        <td><button class='btn btn-xs btn-primary editmesin' id_mesin='$item->id_mesin'>Edit</button></td>
                        <td><a onclick=\"javascript: return confirm('yakin menghapus $item->nam_mesin ?');\" href='".base_url('mastermesin/hapus/').$item->id_mesin."'><button class='btn btn-danger btn-xs'>Hapus</button></a></td>
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
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <h5>Tambah Mesin Baru</h5>
        </div>
      </div>
      <form role="form" method="post"
        action="<?=base_url('mastermesin/insert')?>">
        <div class="modal-body">
          <input type="hidden"
            name="<?php echo $this->security->get_csrf_token_name(); ?>"
            value="<?php echo $this->security->get_csrf_hash(); ?>">
          <div class="form-group">
            <label for="id_sect">Section</label>
            <select name="id_sect" class="form-control form-control-sm" required>
              <option value="">Pilih Section</option>
              <?php
                    foreach ($sect as $itemsect) {
                        echo"
                      <option value='$itemsect->id_sect'>$itemsect->nama_sect</option>
                      ";
                    }
                    ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama_mesin">Nama mesin</label>
            <input type="text" name="nama_mesin" id="nama_mesin" class="form-control form-control-sm" required>
          </div>
          <div class="form-group">
            <div class="icheck-success d-inline judul" title="Mesin masuk dalam paket perawatan">
              <input name="prv" type="checkbox" id="check-prv">
              <label for="check-prv"> As Preventive
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="icheck-danger d-inline judul" title="Mesin masuk dalam kategori breakdown">
              <input name="brk" type="checkbox" id="check-brk">
              <label for="check-brk"> As Breakdown
              </label>
            </div>
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
    document.title = 'MMS V3.0 - Daftar Mesin';
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
    // BUAT DATA TABLE
    $("#tabel-mesin").DataTable({
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
  $('.editmesin').click(function() {
    var id_mesin = $(this).attr('id_mesin');
    $("#form_edit").load(
      '<?=base_url('mastermesin/edit_form/');?>' +
      id_mesin);
  })
  $("#nama_mesin").keyup(function(e) {
    $(this).val($(this).val().toUpperCase());

  });
</script>