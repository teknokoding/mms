<script>showLoader();</script>
<div id="done_cl"></div>
<div id="geser_cl"></div>
<div id="skip_cl"></div>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h5 class="m-0 text-dark"></h5>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content"  id="printpage">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
            <div class="card-header">
                <div class="card-tool">
                <!-- ROW-->
                <div class="row">
                <div class="col-md-8">
                <h5>Data Preventive <?=date('d M Y',strtotime($mulai))?> s/d <?=date('d M Y',strtotime($selesai))?> </h5>
                </div>
                <div class="col-md-4" id="tool-button">
                <div class="float-right">
                <button id="cetak" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Cetak</button>&nbsp;
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-search"><i class="fas fa-search"></i> Cari Data</button>&nbsp;
                <a href="<?= base_url('preventiveday'); ?>"><button class="btn btn-sm btn-success"><i class="far fa-calendar"></i> Jadwal Hari Ini</button></a> &nbsp;
                </div>
                </div>
                </div>
                <!-- ROW -->
                </div>
                </div>
                <div class="card-body">                   
<div class="table-responsive">
<h5>Harian dan Mingguan</h5>
<table class="table table-sm table-bordered">
  <thead class="table-primary">
    <tr>
      <th>Mesin</th>
      <th>Item</th>
      <th class="noprint">Dokumen</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Check</th>
      <th class="noprint">Acc</th>
      <th class="noprint">Tindakan</th>
    </tr>
  </thead>
  <tbody>
  <?php
foreach ($mingguan as $itemmingguan)
{
  
  // TANDAI KALO ROW KLO UDAH DI ACC
  if($itemmingguan->acc>0){$acc_status="checked";}else{$acc_status="";}
  if($itemmingguan->done_cl=='0000-00-00')
  {
    $done_cl="";
    $cek = "";
    $kelas = "";
    $acc_cek="";
    $geser="";
  }
  else
  {
  $done_cl=date('d-M-y',strtotime($itemmingguan->done_cl));
  $cek = "checked";
  $acc_cek="<div  onclick=\"acc_cl('$itemmingguan->id_jadwal_cl','".$this->session->userdata('id_level')."');\" class='icheck-success d-inline'>
  <input type='checkbox'  $acc_status>
  <label>
  </label>
  </div>"; 
  $geser = "onclick='javascript: return(false);'";
}
// BUAT BIKIN STATUS DONE CHECK DAN SKIP
if($itemmingguan->skip_cl!='1'){
  $done_skip = "<div title='$itemmingguan->done_cl' id_jadwal_cl='$itemmingguan->id_jadwal_cl' class='cek_cl icheck-primary d-inline'>
  <input type='checkbox' $cek>
  <label>
  </label>
  </div>";}
  else {
    $done_skip = "<span class='badge badge-danger'>skiped</span>";
  }
  echo"
<tr>
<td>$itemmingguan->nama_mesin</td>
<td>$itemmingguan->note_cl</td>
<td class='noprint'><a href='".base_url()."assets/isodoc/$itemmingguan->kode_cl.pdf' target='_blank'><i class='fa fa-file-pdf-o'></i>&nbsp;$itemmingguan->kode_cl.pdf</a></td>
<td>".date('d M y',strtotime($itemmingguan->start_cl))."</td>
<td>".date('d M y',strtotime($itemmingguan->stop_cl))."</td>
<td>
$done_skip
</td>
<td class='noprint'>$acc_cek</td>
<td class='noprint'>
<div class='input-group-prepend'>
<button type='button' class='btn btn-block btn-outline-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
Tindakan
</button>
<div class='dropdown-menu' style=''>
<a  class='dropdown-item' href=\"javascript:skip_cl('".$itemmingguan->id_jadwal_cl."','".$cek."')\">Skip</a>
<a  class='dropdown-item' href=\"javascript:geser_cl('".$itemmingguan->id_jadwal_cl."')\" ".$geser.">Jadwal Ulang</a>
<a  class='dropdown-item' href=\"javascript:hapus_cl('".$itemmingguan->id_jadwal_cl."','".$this->session->userdata('id_level')."')\">Hapus</a>
</div>
</div>
</td>
</tr>
  ";
}
  ?>
  </tbody>
</table>
</div>
<div class="table-responsive">
<h5>Bulanan dan Tahunan</h5>
<table class="table table-sm table-bordered">
<thead class="table-primary">
<tr>
      <th>Mesin</th>
      <th>Item</th>
      <th class="noprint">Dokumen</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Check</th>
      <th class="noprint">Acc</th>
      <th class="noprint">Tindakan</th>
</tr>
</thead>
<tbody>
<?php
// BULANAN
foreach ($bulanan as $itembulanan) {
  // BUAT ENABLE DISABLE TOMBOL MENU
  if($itembulanan->skip_cl=='1'){$tombol_menu='disabled';} elseif($itembulanan->skip_cl!='1' AND $this->session->userdata('id_level')<6){$tombol_menu='';}else{$tombol_menu='disabled';}
  // TANDAI KALO ROW KLO UDAH DI ACC
  if($itembulanan->acc>0){$acc_status="checked";}else{$acc_status="";}
  if($itembulanan->done_cl=='0000-00-00')
  {
    $done_cl="";
    $cekbulan = "";
    $kelas = "";
    $acc_cek="";
    $geser="";
  }
  else
  {
  $done_cl=date('d-M-y',strtotime($itembulanan->done_cl));
  $cekbulan = "checked";
  $acc_cek="<div  onclick=\"acc_cl('$itembulanan->id_jadwal_cl','".$this->session->userdata('id_level')."');\" class='icheck-success d-inline'>
  <input  type='checkbox'  $acc_status>
  <label>
  </label>
  </div>"; 
  $geser = "onclick='javascript: return(false);'";
 }
// BUAT BIKIN STATUS DONE CHECK DAN SKIP
if($itembulanan->skip_cl!='1'){
  $done_skipbulan = "<div title='$itembulanan->done_cl' id_jadwal_cl='$itembulanan->id_jadwal_cl' class='cek_cl icheck-primary d-inline'>
  <input type='checkbox' $cekbulan>
  <label>
  </label>
  </div>";}
  else {
    $done_skipbulan = "<span class='badge badge-danger'>skiped</span>";
  }
  echo"
<tr>
<td>$itembulanan->nama_mesin</td>
<td>$itembulanan->note_cl</td>
<td class='noprint'><a href='".base_url()."assets/isodoc/$itembulanan->kode_cl.pdf' target='_blank'><i class='fa fa-file-pdf-o'></i>&nbsp;$itembulanan->kode_cl.pdf</a></td>
<td>".date('d M y',strtotime($itembulanan->start_cl))."</td>
<td>".date('d M y',strtotime($itembulanan->stop_cl))."</td>
<td>
$done_skipbulan
</td>
<td class='noprint'>$acc_cek</td>
<td class='noprint'>
<div class='input-group-prepend'>
<button type='button' class='btn btn-block btn-outline-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
Tindakan
</button>
<div class='dropdown-menu' style=''>
<a  class='dropdown-item' href=\"javascript:skip_cl('".$itembulanan->id_jadwal_cl."','".$cek."')\">Skip</a>
<a  class='dropdown-item' href=\"javascript:geser_cl('".$itembulanan->id_jadwal_cl."')\" ".$geser.">Jadwal Ulang</a>
<a  class='dropdown-item' href=\"javascript:hapus_cl('".$itembulanan->id_jadwal_cl."','".$this->session->userdata('id_level')."')\">Hapus</a>
</div>
</div>
</td>
</tr>
  ";
}
// INDEPENDEN ===============================
foreach ($independen as $itemindependen) {
  // BUAT ENABLE DISABLE TOMBOL MENU
  if($itemindependen->skip_cl=='1'){$tombol_menu='disabled';} elseif($itemindependen->skip_cl!='1' AND $this->session->userdata('id_level')<6){$tombol_menu='';}else{$tombol_menu='disabled';}
  // TANDAI KALO ROW KLO UDAH DI ACC
  if($itemindependen->acc>0){$acc_status="checked";}else{$acc_status="";}
  if($itemindependen->done_cl=='0000-00-00')
  {
    $done_cl="";
    $cekbulan = "";
    $kelas = "";
    $acc_cek="";
    $geser="";
  }
  else
  {
  $done_cl=date('d-M-y',strtotime($itemindependen->done_cl));
  $cekbulan = "checked";
  $acc_cek="<div  onclick=\"acc_cl('$itemindependen->id_jadwal_cl','".$this->session->userdata('id_level')."');\" class='icheck-success d-inline'>
  <input  type='checkbox'  $acc_status>
  <label>
  </label>
  </div>"; 
  $geser = "onclick='javascript: return(false);'";
 }
// BUAT BIKIN STATUS DONE CHECK DAN SKIP
if($itemindependen->skip_cl!='1'){
  $done_skipbulan = "<div title='$itemindependen->done_cl' id_jadwal_cl='$itemindependen->id_jadwal_cl' class='cek_cl icheck-primary d-inline'>
  <input type='checkbox' $cekbulan>
  <label>
  </label>
  </div>";}
  else {
    $done_skipbulan = "<span class='badge badge-danger'>skiped</span>";
  }
  echo"
<tr>
<td>$itemindependen->nama_mesin</td>
<td>$itemindependen->note_cl</td>
<td class='noprint'><a href='".base_url()."assets/isodoc/$itemindependen->kode_cl.pdf' target='_blank'><i class='fa fa-file-pdf-o'></i>&nbsp;$itemindependen->kode_cl.pdf</a></td>
<td>".date('d M y',strtotime($itemindependen->start_cl))."</td>
<td>".date('d M y',strtotime($itemindependen->stop_cl))."</td>
<td>
$done_skipbulan
</td>
<td class='noprint'>$acc_cek</td>
<td class='noprint'>
<div class='input-group-prepend'>
<button type='button' class='btn btn-block btn-outline-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
Tindakan
</button>
<div class='dropdown-menu' style=''>
<a  class='dropdown-item' href=\"javascript:skip_cl('".$itemindependen->id_jadwal_cl."','".$cek."')\">Skip</a>
<a  class='dropdown-item' href=\"javascript:geser_cl('".$itemindependen->id_jadwal_cl."')\" ".$geser.">Jadwal Ulang</a>
<a  class='dropdown-item' href=\"javascript:hapus_cl('".$itemindependen->id_jadwal_cl."','".$this->session->userdata('id_level')."')\">Hapus</a>
</div>
</div>
</td>
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
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
<div id="done_cl"></div>
<div id="geser_cl"></div>
<div id="skip_cl"></div>

<!---------------- UNTUK MENU PENCARIAN --------------------------------------------------------------->
<div class="modal fade" id="modal-search">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari Checklist</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?=base_url('preventive/searchdata')?>">
            <div class="modal-body">            
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <!-- CARI AWAL -->
            <div class="form-group row">
                    <label for="start_cl" class="col-sm-3 col-form-label">Mulai</label>
                    <div class="col-sm-9">
                      <input value="" name="start_cl" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                    </div>
            </div>
            <!-- CARI AKHIR -->
            <div class="form-group row">
                    <label for="stop_cl" class="col-sm-3 col-form-label">Sampai</label>
                    <div class="col-sm-9">
                      <input value="" name="stop_cl" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                    </div>
            </div>

            <!-- MESIN -------->
            <div class="form-group row">
                    <label for="jenislkh" class="col-sm-3 col-form-label">Mesin</label>
                    <div class="col-sm-9">
                    <select name="id_mesin" id="id_mesin" required class="select2 form-control form-control-sm" placeholder="">
                    <option value="ALL">SEMUA MESIN</option>
                    <?php
                    foreach ($mesin as $item) 
                    {echo '<option value="'.$item->id_mesin.'">'.$item->nama_mesin.'</option>';}
                    ?>
                    </select>
            </div>
            <!-- Modal body -->
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn  btn-block btn-primary">Tampilkan</button> 
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- MENU PENCARIAN SAMPAI SINI-->

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
$("document").ready(function(){
  hideLoader();
//CETAK DIV DOKUMEN
$("#cetak").click(function()
{
  $(".noprint").hide();
  $("#tool-button").hide(); 
  $("#printpage").printThis();
  $("#tool-button").show(3000).delay(1).queue(function() {
            $(".noprint").show();
            $(this).dequeue();
        });        
});
// BUAT TAMPILIN SWEAT ALERT 
<?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
$(".cek_cl").tooltip();
});
 var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
// ACC
function acc_cl(id_jadwal_cl,level)
{
  if (level>5)
  {
    alert('Forbidden Access Level');
  }
  else
  {
  $.ajax({ 
   type: "POST",
   url: "<?=base_url('preventive/acc/')?>"+id_jadwal_cl, 
   data:csrf, 
   cache: false, 
   success: function(tampil){ 
  location.reload();
   } 
  });
  }
  
}
// GESER CL
function geser_cl(id_jadwal_cl,start_cl,kode_cl)
{
$("#geser_cl").load('<?=base_url('preventive/geser_form/')?>'+id_jadwal_cl); 
}
// SKIP CL
function skip_cl(id_jadwal_cl,cek)
{
  if(cek=="checked")
  {
    Swal.fire(
        'Checklist sudah dilakukan',
        '',
        'error'
    );
  }
  else
  {
$("#skip_cl").load('<?=base_url('preventive/skip_form/')?>'+id_jadwal_cl);
  }
}
// HAPUS CL
function hapus_cl(id_jadwal_cl,level)
{
  if (level>5)
  {
    alert('Forbidden Access Level');
  }
  else
  {
  var tanyahapus = confirm('Anda akan menghapus jadwal?');
  if(tanyahapus==true)
  {
  $.ajax({ 
   type: "POST",
   url: "<?=base_url('preventive/hapus/')?>"+id_jadwal_cl,
   data: csrf,
   cache: false, 
   success: function(tampil){ 
  location.reload();
   } 
  });
  }
  }
}
//============ FUNGSI CHECK
$(".cek_cl").click(function()
{
var id_jadwal_cl = $(this).attr("id_jadwal_cl");
$("#done_cl").load('<?=base_url('preventive/done_form/')?>'+id_jadwal_cl);
});

// INPUT JADWAL ITEMNYA ===================================
$("#input_jadwal").submit(function(e){
e.preventDefault();
$.ajax({ 
   type: "POST",
   url: "<?=base_url('preventive/input')?>", 
   data: $(this).serialize(), 
   cache: false, 
   success: function(tampil){ 
  location.reload();
   } 
});

});
</script>
