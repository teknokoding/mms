<?php
foreach ($prev_last as  $obj) {
  foreach ($obj as $itemlast) {
  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$itemlast->nama_mesin;?> </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid" style="padding:0px;">
                <div class="card card-success">
                    <div class="card-header">
                    <div class="card-tool">
                      Paket Belum Dilaksanakan Per <?=date('d M Y');?>
                    </div>
                    </div>
                    <div class="card-body" style="padding:0px;">
                    <div class="table-responsive">
                      <table class="table">
                       <thead>
                        <tr>
                          <th>No</th>
                          <th>Item Perawatan</th>
                          <th>Expired</th>
                        </tr>
                       </thead>
                       <tbody>
                        <?php 
                        $no=0;
                        foreach ($prev_mingguan as $item) {
                          $no++;
                          echo "
                          <tr>
                          <td>$no</td>
                          <td>$item->note_cl</td>
                          <td>".date('d M Y',strtotime($item->stop_cl))."</td>
                          </tr>
                          ";
                        }
                        foreach ($prev_bulanan as $itembulan) {
                          $no++;
                          echo "
                          <tr>
                          <td>$no</td>
                          <td>$itembulan->note_cl</td>
                          <td>".date('d M Y',strtotime($itembulan->stop_cl))."</td>
                          </tr>
                          ";
                        }
                        
                        if($item->note_cl=='' AND $itembulan->note_cl=='')
                        {
                          echo"
                          <tr class='table-danger' style='text-align:center;'><td colspan='3'><b>Tidak Ada Paket Untuk Hari Ini</b></td></tr>
                          ";
                        }
                        ?>
                       </tbody>
                       </table>
                    </div>
                    </div>
                        </div>
                    <div class="card card-success">
                    <div class="card-header">
                    <div class="card-tool">
                      Perawatan Terakhir
                    </div>
                    </div>
                    <div class="card-body" style="padding:0px;">
                    <div class="table-responsive">
                      <table class="table">
                       <thead>
                        <tr>
                          <th>No</th>
                          <th>Item Perawatan</th>
                          <th>Done</th>
                        </tr>
                       </thead>
                       <tbody>
                        <?php 
                        $no=0;
                        foreach ($prev_last as  $obj) {
                          $no++;
                          foreach ($obj as $itemlast) {
                            echo "
                            <tr>
                            <td>$no</td>
                            <td>$itemlast->note_cl</td>
                            <td>".date('d M Y',strtotime($itemlast->stop_cl))."</td>
                            </tr>
                            ";
                          }
                        }
                        ?>
                       </tbody>
                       </table>
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
</script>