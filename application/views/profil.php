<?php
foreach ($user as $item) {
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
        <div class="card card-primary card-outline">
        
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?= base_url();?>assets/dist/img/avatar5.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$item->namalengkap;?></h3>

                <p class="text-muted text-center"><?=$item->nama_level;?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Departmen</b> <a class="float-right"><?=$item->nama_dept;?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Section</b> <a class="float-right"><?=$item->nama_sect;?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Login Terakhir</b> <a class="float-right"><?=$item->last_login;?></a>
                  </li>
                </ul>
                <button class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#modal-password"> Ganti Password</button>
              </div>
              
              <!-- /.card-body -->
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
<div class="modal fade" id="modal-password">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Ganti Password</h5>
<div id="pesan"></div>
</div>
</div>
<form role="form" id="form-password">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="form-group">
                    <label for="pass_lama">Masukkan Password Lama</label>
                    <input type="password" name="pass_lama" id="pass_lama" class="form-control form-control-sm" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="pass_baru">Masukkan Password Baru</label>
                    <input type="password" name="pass_baru" id="pass_baru" class="form-control form-control-sm" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Ulangi Password Baru</label>
                    <input type="password" name="pass_ulang" id="pass_ulang" class="form-control form-control-sm" autocomplete="off" required>
                  </div>
                </div>
                <!-- /.modal-body -->

                <div class="modal-footer justify-content-between">
                  <button  type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                  <button  type="reset" class="btn btn-sm btn-warning">Clear</button>
                  <button id="simpan" type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
              </form>
</div>
</div>
</div>
<script>
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
  $(document).ready(function()
  {
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
    // BUAT DATA TABLE
 
  })
  // SUBMIT  ===================================
$("#form-password").submit(function(e){
e.preventDefault();
$.ajax({ 
   type: "POST",
   url: "<?=base_url('profil/gantipass/').$item->iduser?>", 
   data: $(this).serialize(), 
   cache: false, 
   success: function(tampil){
  $("#pesan").empty();
  $("#pesan").append(tampil);
  if(tampil=="sukses")
  location.reload();
   } 
});
});

</script>