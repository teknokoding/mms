<?php
foreach ($lkh as $item) {
$mesin = $item->nama_mesin;
}
?>
<div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail Laporan </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-sm table-striped">
              <tbody>
              
              <tr>
              <td>Pengisi Laporan</td><td>: <?=$pengisilaporan;?></td>
              </tr>
              <tr>
              <td>Pelaksana</td><td>: <?=$pelaksana1;?>
              <br>&nbsp;&nbsp;<?=$pelaksana2;?>
              <br>&nbsp;&nbsp;<?=$pelaksana3;?>
              <br>&nbsp;&nbsp;<?=$pelaksana4;?>
              <br>&nbsp;&nbsp;<?=$pelaksana5;?>
              <br>&nbsp;&nbsp;<?=$pelaksana6;?></td>
              </tr>
              <tr>
              <td>Acc</td><td>: <?=$nama_acc;?></td>
              </tr>
              <tr>
              <td>Waktu Acc</td><td>: <?php empty($nama_acc)?$acc_time="":$acc_time=$item->acc_time;echo $acc_time;?></td>
              </tr>
              </tbody>
              </table>
              
            </div>
            <div class="modal-footer float-rigt">
            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <script>
$("#modal-detail").modal('show');
</script>