<div class="modal fade show" id="modal-sesi" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <center><h4><br>Pilih Sesi Anda <br><br></h4></center>
              <div class="row">
              <div class="col-sm-6">
              <div class="small-box bg-info mme1">
              <div class="inner">
                <h3>MME 1</h3>
                <p>Masuk Sebagai MME 1</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-cog"></i>
              </div>
            </div>
              </div>

              <div class="col-sm-6">
              <div class="small-box bg-info mme2">
              <div class="inner">
                <h3>MME 2</h3>
                <p>Masuk Sebagai MME 2</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-cog"></i>
              </div>
            </div>
              </div>
              <div class="col-sm-12">
              <a onclick="PlayLogout();" href="#" data-toggle="modal" data-target="#modal-logout"><button class="btn btn-danger btn-lg btn-block"><i class="fas fa-power-off"></i>&nbsp;Logout</button></a>
              </div>
<h4>&nbsp;<br></h4>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<script>
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
$(document).ready(function()
{
PlayChat();
$("#modal-sesi").modal({
            backdrop: 'static',
            keyboard: false
        });

$(".mme1").click(function(){
$.ajax({ 
   type: "POST",
   url: '<?=base_url('sesi/set_sesi/5');?>',
   data: csrf,
   cache: false,
    success: function(html){
window.location.reload();
                }

    });
    });
$(".mme2").click(function(){
$.ajax({ 
   type: "POST",
   url: '<?=base_url('sesi/set_sesi/6');?>',
   data: csrf,
   cache: false,
    success: function(html){
window.location.reload();
                }

    });
    });
});
</script>