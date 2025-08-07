<?php
foreach ($mesin as $itemmesin) {
  
}
$id_mesin_enc = $this->secure->encrypt($itemmesin->id_mesin);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="fas fa-qrcode"></i>&nbsp;<?=$itemmesin->nama_mesin?> </h1>
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
                    <div class="card-header">
                    <div class="card-tool">
                      Pilih Jenis Monitoring
                    </div>
                    </div>
                    <div class="card-body">

                    <div class="row">

                    <div class="col-md-6">
                    <a href="<?=base_url('monitor/preventive/').$id_mesin_enc;?>">
                    <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-clipboard"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Preventive</span>
                <span class="info-box-number">Paket Rawat Hari Ini</span>
              </div>
              <!-- /.info-box-content -->
            </div>
                    </div>
                    </a>


                    <div class="col-md-6">
                    <a href="<?=base_url('monitor/breakdown/').$id_mesin_enc;?>">
                    <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fa fa-bolt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Corrective & Breakdown</span>
                <span class="info-box-number">Corrective & Breakdown Saat Ini</span>
              </div>
              <!-- /.info-box-content -->
            </div>
                    </div>
                    </a>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <a href="<?=base_url('monitor/tpm/').$id_mesin_enc;?>">
                    <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fa fa-tags"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">TPM</span>
                <span class="info-box-number">Tag TPM Belum Release</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
                    </div>


                    <div class="col-md-6">
                    </div>
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
<script>
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
$(document).ready(function () {
  <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
});

</script>