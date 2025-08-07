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
            <?php foreach ($riwayat as $item1) {
}
            if (empty($riwayat)) {
                echo "<div class='alert alert-info'>Belum ada tindakan release</div>";
                $btn_release="";
            } else {
                ?>
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
              </div>
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
          <?php
          if ($itemriwayat->id_pic==$this->session->userdata('id_sect')) {
              $btn_release = "<button class='btn-release btn btn-success judul' id_tag='$itemriwayat->id_tag'>Release</button>";
          } else {
              $btn_release="";
          }
            }?>
          <!-- /.col -->
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <?=$btn_release;?>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  $(document).ready(function() {
    $("#modal-riwayat").modal('show');
    // RELEASE
    $('.btn-release').click(function() {
      $("#modal-riwayat").modal('hide');
      var id_tag = $(this).attr('id_tag');
      $("#release").load(
        '<?=base_url('tpm/release/');?>' + id_tag);
    })
  });
</script>