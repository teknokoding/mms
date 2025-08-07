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
  <div class="content" id="printpage">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <div class="card-tool">
                <!-- ROW-->
                <div class="row">
                  <div class="col-md-8">
                    <h5>Laporan Preventive</h5>
                  </div>
                  <div class="col-md-4" id="tool-button">
                    <div class="float-right">
                      <button style="display:none;" id="btn-cari-pojok" class="btn btn-sm btn-primary"
                        data-toggle="modal" data-target="#modal-search"><i class="fas fa-search"></i> Cari
                        Data</button>&nbsp;
                    </div>
                  </div>
                </div>
                <!-- ROW -->
              </div>
            </div>
            <div class="card-body">


              <div class="row infolaporan">


                <div class="col-md-6">

                  <div class="small-box bg-gray">
                    <div class="inner">
                      <h3>Laporan Preventive</h3>

                      <p>Mulai lihat laporan dengan klik tombol "Cari Data"</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="small-box-footer"><br>
                      <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#modal-search"><i
                          class="fas fa-search"></i> Cari Data</button>
                      <br><br>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="small-box bg-orange">
                    <div class="inner">
                      <h3>Pencapaian Preventive</h3>

                      <p>Laporan menyajikan pencapaian dalam bentuk tabel dan grafik</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="small-box-footer"><br>
                      <button
                        onclick="javascript:window.location.href='<?=base_url('laporanpreventive/pencapaian');?>';"
                        class="btn btn-lg btn-primary"><i class="fas fa-chart-bar"></i> Lihat Pencapaian</button>
                      <br><br>
                    </div>
                  </div>
                </div>


              </div>



              <div id="isilaporan" class="body table-responsive">

              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
  <!---------------- UNTUK MENU PENCARIAN --------------------------------------------------------------->
  <div class="modal fade" id="modal-search">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari Checklist</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" id="form-search">
          <div class="modal-body">
            <input type="hidden"
              name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">
            <!-- CARI AWAL -->
            <div class="form-group row">
              <label for="start_cl" class="col-sm-3 col-form-label">Mulai</label>
              <div class="col-sm-9">
                <input id="start_cl" name="start_cl" type="text" class="form-control form-control-sm tanggalan"
                  placeholder="" required>
              </div>
            </div>
            <!-- CARI AKHIR -->
            <div class="form-group row">
              <label for="stop_cl" class="col-sm-3 col-form-label">Sampai</label>
              <div class="col-sm-9">
                <input id="stop_cl" name="stop_cl" type="text" class="form-control form-control-sm tanggalan"
                  placeholder="" required>
              </div>
            </div>

            <!-- MESIN -------->
            <div class="form-group row">
              <label for="jenislkh" class="col-sm-3 col-form-label">Mesin</label>
              <div class="col-sm-9">
                <select name="id_mesin" id="id_mesin" required class="select2 form-control form-control-sm"
                  placeholder="">
                  <option value="ALL">SEMUA MESIN</option>
                  <?php
                    foreach ($mesin as $item) {
                        echo '<option value="'.$item->id_mesin.'">'.$item->nama_mesin.'</option>';
                    }
                    ?>
                </select>
              </div>
              <!-- Modal body -->
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn  btn-block btn-primary">Tampilkan</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- MENU PENCARIAN SAMPAI SINI-->

</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#btn-cari-pojok").hide();
    // INPUT SEARCH ITEMNYA ===================================
    $("#form-search").submit(function(e) {
      $("#btn-cari-pojok").show();
      $(".infolaporan").empty();
      $("#isilaporan").empty();
      $("#isilaporan").append(
        '<div id="pesan"></div><table class="table dataTable table-sm table-bordered table-striped"><thead><tr class="table-info"><th>Mesin</th><th>Kode</th><th>Item</th><th>Start</th><th>Stop</th><th>Done</th><th>Skip</th><th>Note</th><th>Pelaksana1</th><th>Pelaksana2</th><th>Pelaksana3</th><th>Pelaksana4</th><th>Pelaksana5</th><th>Pelaksana6</th></tr></thead><tbody id="tampildata">'
      );
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?=base_url('laporanpreventive/searchdata')?>",
        data: $(this).serialize(),
        cache: false,
        beforeSend: function() {
          showLoader();
        },
        success: function(hasil) {
          hideLoader();
          $("#pesan").empty();
          $("#tampildata").empty();
          if (hasil == '[]') {
            $("#pesan").append('<div class="alert alert-danger">Data tidak ditemukan</div>');

          } else {
            jadwal = jQuery.parseJSON(hasil);
            console.log(jadwal);
            $.each(jadwal, function(i, item) {
              $('#tampildata').append('<tr><td>' + jadwal[i].nama_mesin + '</td><td>' + jadwal[i]
                .kode_cl + '</td><td>' + jadwal[i].note_cl + '</td><td>' + moment(jadwal[i]
                  .start_cl).format('DD/MM/YY') + '</td><td>' + moment(jadwal[i].stop_cl).format(
                  'DD/MM/YY') + '</td><td>' + moment(jadwal[i].done_cl).format('DD/MM/YY') +
                '</td><td>' + jadwal[i].skip_cl + '</td><td>' + jadwal[i].uraian_cl + jadwal[i].note_skip+'</td><td>' +
                jadwal[i].pelaksana1 + '</td><td>' + jadwal[i].pelaksana2 + '</td><td>' + jadwal[i]
                .pelaksana3 + '</td><td>' + jadwal[i].pelaksana4 + '</td><td>' + jadwal[i]
                .pelaksana5 + '</td><td>' + jadwal[i].pelaksana6 + '</td></tr>');
            });
          }
          $("#isilaporan").append('</tbody></table>');
          table = $('.dataTable').DataTable({
            "info": false,
            "paging": false,
            "searching": false,
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'print'
            ]
          });
        }
      });
      $("#modal-search").modal('hide');
      document.title = "Laporan Preventive " + $("#start_cl").val() + " s/d " + $("#stop_cl").val();;
    });
  })
</script>