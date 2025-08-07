<?php
foreach ($breakdown as $breakdownsingle) {
  # code...
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$breakdownsingle->nama_mesin;?> </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid" style="padding:0px;">
                <div class="card card-danger">
                    <div class="card-header">
                    <div class="card-tool">
                      Data Breakdown
                    </div>
                    </div>
                    <div class="card-body" style="padding:0px;">
                    <div class="table-responsive">
                      <table class="table">
                       <thead>
                        <tr>
                          <th>Tgl</th>
                          <th>Kerusakan</th>
                          <th>Lacak</th>
                        </tr>
                       </thead>
                       <tbody>
                        <?php 
                        $no=0;
                        foreach ($breakdown as $item) {
                          $no++;
                          echo "
                          <tr>
                          <td>".date('d/M/y',strtotime($item->tgllkh))."</td>
                          <td>$item->keluhan</td>
                          <td><button class='btn-riwayat btn btn-sm btn-outline-info' reff_id='$item->reff_id'><i class='far fa-clock'></i></button></td>
                          </tr>
                          ";
                        }
                        if(!isset($item->keluhan)){
                          echo"
                          <tr class='table-danger' style='text-align:center;'><td colspan='3'><b>Tidak Ada Data Kerusakan</b></td></tr>
                          ";
                        }
                        ?>
                       </tbody>
                       </table>
                    </div>
                    </div>
                </div>
                <div id="riwayat"></div>
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
  // RIWAYAT
$('.btn-riwayat').click(function()
{
  var reff_id = $(this).attr('reff_id');
  $("#riwayat").load('<?=base_url('monitor/riwayat/');?>'+reff_id); 
})
</script>