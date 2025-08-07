<div id="modal-riwayat" class="modal fade show" id="modal-lg" aria-modal="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Riwayat Perbaikan Mesin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
 <div class="row">
          <div class="col-md-12">
            <div class="timeline">
            <?php foreach ($riwayat as $item1) {
            }?>
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-red">Laporan Awal</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-flag-checkered bg-red"></i>
                <div class="timeline-item">
                <span class="time"></span>
                  <h3 class="timeline-header"><a href="#"><?=$item1->nama_mesin;?></a> <i><?=$item1->nama_unitmesin;?></i></h3>
                  <div class="timeline-body">
                    <b><?=$item1->keluhan;?></b>
                  </div>
                  <div class="timeline-footer">
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
            <?php foreach($riwayat as $itemriwayat)
            {?>
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-lightblue"><?=date('d M Y',strtotime($itemriwayat->tgllkh))?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-file-alt bg-navy"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i>&nbsp;<?=$itemriwayat->waktumulai.' - '.$itemriwayat->waktuselesai;?></span>
                  <h3 class="timeline-header"><a href="#"><?=$itemriwayat->namalengkap;?></a> membuat laporan</h3>
                  <div class="timeline-body">
                    <?=$itemriwayat->uraian;?>
                  </div>
                  <div class="timeline-footer">
                    <span class="badge bg-danger"><?=$itemriwayat->status;?></span>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
            <?php }?>
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <a href="<?=base_url('monitor/createnextmonitor/').$itemriwayat->reff_id."/".$this->secure->encrypt($itemriwayat->id_mesin);?>"><button class='btn btn-sm btn-success'><i class='far fa-arrow-alt-circle-right'></i>&nbsp;Lanjutkan</button></a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<script>
$(document).ready(function()
{
$("#modal-riwayat").modal('show');
});
</script>