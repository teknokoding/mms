<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Breakdown Existing </h1>
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
                    <!--
                    <div class="card-header">
                    <div class="card-tool">
                    <h5>Daftar Kerusakan Mesin Masih Berlangsung</h5>
                    </div>
                    </div>
                    -->
                    <div class="card-body">
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
                    <th>Lanjutkan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=0;
                    foreach ($breakdown as $item) {
                    $no++;
                      echo "
                    <tr>
                    <td>$no</td>
                    <td>".date('d M Y',strtotime($item->tgllkh))."</td>
                    <td>$item->nama_mesin</td>
                    <td>$item->nama_unitmesin</td>
                    <td>$item->keluhan</td>
                    <td><button class='btn-riwayat btn btn-sm btn-outline-info' reff_id='$item->reff_id'><i class='far fa-clock'></i></button></td>
                    <td><a href='".base_url('lkh/createnext/').$item->reff_id."'><button class='btn btn-sm btn-outline-success'><i class='fas fa-arrow-right'></i></button></a></td>
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
$(document).ready(function()
{
$("#table-breakdown").dataTable();
});
// RIWAYAT
$('.btn-riwayat').click(function()
{
  var reff_id = $(this).attr('reff_id');
  $("#riwayat").load('<?=base_url('breakdown/riwayat/');?>'+reff_id); 
})
</script>