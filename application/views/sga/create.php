  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/summernote/summernote-bs4.css">
<div class="modal fade show" id="modal-sga" aria-modal="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">SGA / Horenso</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="row">
        <div class="col-md-12">
         
            <div class="card-body pad">
              <div class="mb-3">
                <textarea class="textarea" placeholder=""
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<!-- Summernote -->
<script src="<?=base_url('assets/');?>/plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(document).ready(function () {
  $("#modal-sga").modal('show');
});

  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>