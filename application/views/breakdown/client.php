<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"></h5>
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
          <div class="card-shadow-primary border mb-3 card card-body ">

            <div class="">
              <div class="card-tool">
                <select name="id_mesin" id="setid_mesin" required class="select2 form-control form-control-sm"
                  placeholder="">
                  <option value="ALL">PILIH MESIN</option>
                  <?php
                    foreach ($mesin as $itemmesin) {
                        echo '<option value="'.$itemmesin->id_mesin.'" '.$pilih.'>'.$itemmesin->nama_mesin.'</option>';
                    }
                    ?>
                </select>
              </div>
            </div>
            <br>
            <div class="">
              <div class="table-responsive">
                <table id="table-breakdown" class="table table-hover table-sm table-bordered">
                  <thead>
                    <tr class='table-danger'>
                      <th>No</th>
                      <th>Tgl Laporan</th>
                      <th>Mesin</th>
                      <th>Unit</th>
                      <th>Keluhan</th>
                      <th>Riwayat</th>
                    </tr>
                  </thead>
                  <tbody id="data_breakdown">

                  </tbody>
                </table>
              </div>
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
<div id="riwayat"></div>
<script>
  var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
  $(document).ready(function() {
    // FILTER MESINNYA
    $("#setid_mesin").change(function() {
      $("#data_breakdown").empty();
      var id_mesin = $(this).val();
      $.getJSON(
        "<?=base_url('breakdown/search_mesin/')?>" +
        id_mesin, csrf,
        function(data, textStatus, jqXHR) {
          console.log(data);
          $.each(data, function(i, item) {
            $('#data_breakdown').append('<tr><td>' + (i + 1) + '</td><td>' + data[i].tgllkh +
              '</td><td>' + data[i]
              .nama_mesin + '</td><td>' + data[i].nama_unitmesin + '</td><td>' + data[i].keluhan +
              '</td><td><button onclick="riwayat(\'' + data[i].reff_id +
              '\')" class="btn btn-sm btn-outline-info"><i class="far fa-clock"></i></button></td></tr>'
            );
          });
        }
      );
    });
    $("#table-breakdown").dataTable();
  });
  // RIWAYAT
  function riwayat(reff_id) {

    $("#riwayat").load(
      '<?=base_url('breakdown/riwayat/');?>' + reff_id
    );
  }
</script>