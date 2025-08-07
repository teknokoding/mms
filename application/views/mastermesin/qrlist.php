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
                    <th>Link</th>
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
                        <td><a href='".base_url('monitor/qrlink/').$item->id_mesin."'>".base_url('monitor/qrlink/').$item->id_mesin."</a></td>
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
</script>