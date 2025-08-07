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
                    <h5>Laporan Pencapaian Preventive Tahun <?=$tahun;?>
                    </h5>
                  </div>
                  <div class="col-md-4" id="tool-button">
                    <div class="float-right">
                      <select name="tahun" id="tahun" class="form-control input-sm">
                        <option value="">Tahun</option>
                        <?php
                        $tahun_pilih=date('Y');
                        for ($tahun_pilih=$tahun;$tahun_pilih>=2017;$tahun_pilih--) {
                            echo"<option value='$tahun_pilih'>$tahun_pilih</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- ROW -->
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <table class="table table-sm table-striped table-bordered">
                    <tr>
                      <th>Bulan</th>
                      <th>Qty</th>
                      <th>Done</th>
                      <th>Not Done</th>
                      <th>Achv</th>
                    </tr>
                    <?php
                  $bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                  echo"<br>";
                  for ($i=0;$i<12;$i++) {
                    $bln=$i+1;
                    if($bln<10){$bln='0'.$bln;}
                      foreach ($raw[$i] as $item) {
                          echo"<tr><td>".($bulan[$i])."</td><td>".number_format($item->jumlah)."</td><td>".number_format($item->terlaksana)."</td><td class='not_done' periode='".$tahun."-".$bln."'>".($item->jumlah-$item->terlaksana)."</td><td>".number_format(($item->terlaksana/$item->jumlah)*100,2,'.','')."%</td></tr>";
                          $data_chart[].=number_format(($item->terlaksana/$item->jumlah)*100,2,'.','');
                      }
                  }
                  ?>

                  </table>
                </div>
                <div class="col-lg-8">
                  <canvas id="myChart" style="height:230px"></canvas>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

</div>
<!-- /.content-wrapper -->
<script src="<?= base_url();?>assets/plugins/chart.js/Chart.min.js">
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#tahun').change(function() {
      var tahun = $(this).val();
      window.location.replace(
        '<?php echo base_url('laporanpreventive/pencapaian/')?>' +
        tahun);
    });
    $('.not_done').click(function()
    {
      var periode = $(this).attr('periode');
      window.open('<?php echo base_url('laporanpreventive/notdone/')?>' +
        periode,'_blank');
    });
  })
</script>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'],
      datasets: [{
        label: 'Pencapaian %',
        data: [
          <?php
                   $i = 0;
                 foreach ($data_chart as $item_chart) {
                     echo "'".$data_chart[$i]."',";
                     $i++;
                 } ?>
        ],
        backgroundColor: 'rgba(0, 93, 255, 0.21)',
        borderColor: 'rgba(0, 93, 255, 0.62)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      scaleBeginAtZero: true,
    }
  });
</script>