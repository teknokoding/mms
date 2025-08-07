<div id="modal-riwayat" class="modal fade show" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Riwayat Release TAG</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <?php foreach ($riwayat as $item1) {?>
            <div class="timeline">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-purple"><?=date('d M Y', strtotime($item1->tgl_tag))?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-user bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"></span>
                  <h3 class="timeline-header"><a href="#"><?=$item1->namalengkap; ?></a> membuat tag</h3>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-tag bg-red"></i>
                <div class="timeline-item">
                  <span class="time"></span>
                  <h3 class="timeline-header"><a href="#"><?=$item1->nama_mesin; ?></a> :: <?=$item1->nama_unitmesin; ?>
                  </h3>
                  <div class="timeline-body">
                    <b><?=$item1->deskripsi; ?></b>
                  </div>
                  <div class="timeline-footer">
                  </div>
                </div>
              </div><?php } ?>
              <!-- END timeline item -->
              <?php foreach ($riwayat as $itemriwayat) {?>
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-blue"><?=date('d M Y', strtotime($itemriwayat->tgl_rel))?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-paper-plane bg-navy"></i>
                <div class="timeline-item">
                  <span class="time"></span>
                  <h3 class="timeline-header"><a href="#"><?=$itemriwayat->nama_karyawan;?></a> melakukan
                    release</h3>
                  <div class="timeline-body">
                    <?=$itemriwayat->action;?>
                  </div>
                  <div class="timeline-footer">
                    <span class="badge bg-danger"><?=$itemriwayat->rel_stat;?></span>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <?php } ?>
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>

          <!-- /.col -->
        </div>

      </div>
      <?php echo'
      <div class="modal-footer justify-content-between">
        <button class="btn-reject btn btn-danger" id_tag="'.$itemriwayat->id_tag.'"><i class="fa fa-thumbs-down"></i>&nbsp;Reject</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <a href="'.base_url('tpm2acc/do_acc/').$itemriwayat->id_tag.'"><button class="btn-acc btn btn-success" id_tag="'.$itemriwayat->id_tag.'"><i class="fa fa-thumbs-up"></i>&nbsp;Acc</button></a>
      </div>';?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  $(document).ready(function() {
    $("#modal-riwayat").modal('show');
  });
</script>