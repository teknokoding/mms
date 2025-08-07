<div id="done_cl"></div>
<div id="geser_cl"></div>
<div id="skip_cl"></div>
<div id="input_cl"></div>
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
  <div class="content" id="printpage">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <div class="card-tool">
                <!-- ROW-->
                <div class="row">
                  <div class="col-md-8">
                    <h5>Jadwal Perawatan <?=date('d M Y');?>
                    </h5>
                  </div>
                  <div class="col-md-4" id="tool-button">
                    <div class="float-right">
                      <button id="cetak" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Cetak</button>&nbsp;
                      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-search"><i
                          class="fas fa-search"></i> Cari Data</button>&nbsp;
                      <button id="create_cl" class="btn btn-sm btn-success"><i class="far fa-edit"></i> Buat
                        Jadwal</button>&nbsp;
                    </div>
                  </div>
                </div>
                <!-- ROW -->
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
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
foreach ($paket as $itempaket) {
  
  // TANDAI KALO ROW KLO UDAH DI ACC
    if ($itempaket->acc>0) {
        $acc_status="checked";
    } else {
        $acc_status="";
    }
    if ($itempaket->done_cl=='0000-00-00') {
        $done_cl="";
        $cek = "";
        $kelas = "";
        $acc_cek="";
        $geser="";
    } else {
        $done_cl=date('d-M-y', strtotime($itempaket->done_cl));
        $cek = "checked";
        $acc_cek="<div  onclick=\"acc_cl('$itempaket->id_jadwal_cl','".$this->session->userdata('id_level')."');\" class='icheck-success d-inline'>
  <input type='checkbox'  $acc_status>
  <label>
  </label>
  </div>";
        $geser = "onclick='javascript: return(false);'";
    }
    // BUAT BIKIN STATUS DONE CHECK DAN SKIP
    if ($itempaket->skip_cl!='1') {
        $done_skip = "<div title='$itempaket->done_cl' id_jadwal_cl='$itempaket->id_jadwal_cl' class='cek_cl icheck-primary d-inline'>
  <input type='checkbox' $cek>
  <label>
  </label>
  </div>";
    } else {
        $done_skip = "<span class='badge badge-danger'>skiped</span>";
    }
    echo"
<tr>
<td>$itempaket->nama_mesin</td>
<td>$itempaket->note_cl</td>
<td class='noprint'><a href='".base_url()."assets/isodoc/$itempaket->kode_cl.pdf' target='_blank'><i class='fa fa-file-pdf-o'></i>&nbsp;$itempaket->kode_cl.pdf</a></td>
<td>".date('d M y', strtotime($itempaket->start_cl))."</td>
<td>".date('d M y', strtotime($itempaket->stop_cl))."</td>
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
<a  class='dropdown-item' href=\"javascript:skip_cl('".$itempaket->id_jadwal_cl."','".$cek."')\">Skip</a>
<a  class='dropdown-item' href=\"javascript:geser_cl('".$itempaket->id_jadwal_cl."')\" ".$geser.">Jadwal Ulang</a>
<a  class='dropdown-item' href=\"javascript:hapus_cl('".$itempaket->id_jadwal_cl."','".$this->session->userdata('id_level')."')\">Hapus</a>
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
                <h5>Jadwal Perawatan Terlewat</h5>
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
foreach ($paketpass as $itempaketpass) {
  
  // TANDAI KALO ROW KLO UDAH DI ACC
      if ($itempaketpass->acc>0) {
          $acc_status="checked";
      } else {
          $acc_status="";
      }
      if ($itempaketpass->done_cl=='0000-00-00') {
          $done_cl="";
          $cek = "";
          $kelas = "";
          $acc_cek="";
          $geser="";
      } else {
          $done_cl=date('d-M-y', strtotime($itempaketpass->done_cl));
          $cek = "checked";
          $acc_cek="<div  onclick=\"acc_cl('$itempaketpass->id_jadwal_cl','".$this->session->userdata('id_level')."');\" class='icheck-success d-inline'>
  <input type='checkbox'  $acc_status>
  <label>
  </label>
  </div>";
          $geser = "onclick='javascript: return(false);'";
      }
      // BUAT BIKIN STATUS DONE CHECK DAN SKIP
      if ($itempaketpass->skip_cl!='1') {
          $done_skip = "<div title='$itempaketpass->done_cl' id_jadwal_cl='$itempaketpass->id_jadwal_cl' class='cek_cl icheck-primary d-inline'>
  <input type='checkbox' $cek>
  <label>
  </label>
  </div>";
      } else {
          $done_skip = "<span class='badge badge-danger'>skiped</span>";
      }
      echo"
<tr>
<td>$itempaketpass->nama_mesin</td>
<td>$itempaketpass->note_cl</td>
<td class='noprint'><a href='".base_url()."assets/isodoc/$itempaketpass->kode_cl.pdf' target='_blank'><i class='fa fa-file-pdf-o'></i>&nbsp;$itempaketpass->kode_cl.pdf</a></td>
<td>".date('d M y', strtotime($itempaketpass->start_cl))."</td>
<td>".date('d M y', strtotime($itempaketpass->stop_cl))."</td>
<td>
$done_skip
</td>
<td  class='noprint'>$acc_cek</td>
<td  class='noprint'>
<div class='input-group-prepend'>
<button type='button' class='btn btn-block btn-outline-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
Tindakan
</button>
<div class='dropdown-menu' style=''>
<a  class='dropdown-item' href=\"javascript:skip_cl('".$itempaketpass->id_jadwal_cl."','".$cek."')\">Skip</a>
<a  class='dropdown-item' href=\"javascript:geser_cl('".$itempaketpass->id_jadwal_cl."')\" ".$geser.">Jadwal Ulang</a>
<a  class='dropdown-item' href=\"javascript:hapus_cl('".$itempaketpass->id_jadwal_cl."','".$this->session->userdata('id_level')."')\">Hapus</a>
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
        <form class="form-horizontal" method="POST"
          action="<?=base_url('preventive/searchdata1')?>">
          <div class="modal-body">
            <input type="hidden"
              name="<?php echo $this->security->get_csrf_token_name(); ?>"
              value="<?php echo $this->security->get_csrf_hash(); ?>">
            <!-- CARI AWAL -->
            <div class="form-group row">
              <label for="start_cl" class="col-sm-3 col-form-label">Mulai</label>
              <div class="col-sm-9">
                <input value="" name="start_cl" type="text" class="form-control form-control-sm tanggalan"
                  placeholder="" required>
              </div>
            </div>
            <!-- CARI AKHIR -->
            <div class="form-group row">
              <label for="stop_cl" class="col-sm-3 col-form-label">Sampai</label>
              <div class="col-sm-9">
                <input value="" name="stop_cl" type="text" class="form-control form-control-sm tanggalan" placeholder=""
                  required>
              </div>
            </div>

            <!-- MESIN -------->
            <div class="form-group row">
              <label for="jenislkh" class="col-sm-3 col-form-label">Mesin</label>
              <div class="col-sm-9">
                <select name="id_mesin" id="id_mesin" required class="select2 form-control form-control-sm"
                  placeholder="">
                  <option value="ALL">SEMUA MESIN</option>
                  <?php
                    foreach ($mesin as $item) {
                        echo '<option value="'.$item->id_mesin.'">'.$item->nama_mesin.'</option>';
                    }
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
  $("document").ready(function() {
    //CETAK DIV DOKUMEN
    $("#cetak").click(function() {
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
    // BUAT JADWAL
    $("#create_cl").click(function() {
      $("#input_cl").load(
        '<?=base_url('preventive/create_form');?>'
        );
    });
    $(".cek_cl").tooltip();
  });
  var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
  // ACC
  function acc_cl(id_jadwal_cl, level) {
    if (level > 5) {
      alert('Forbidden Access Level');
    } else {
      $.ajax({
        type: "POST",
        url: "<?=base_url('preventive/acc/')?>" +
          id_jadwal_cl,
        data: csrf,
        cache: false,
        success: function(tampil) {
          location.reload();
        }
      });
    }

  }
  // GESER CL
  function geser_cl(id_jadwal_cl, start_cl, kode_cl) {
    $("#geser_cl").load(
      '<?=base_url('preventive/geser_form/')?>' +
      id_jadwal_cl);
  }
  // SKIP CL
  function skip_cl(id_jadwal_cl, cek) {
    if (cek == "checked") {
      Swal.fire(
        'Checklist sudah dilakukan',
        '',
        'error'
      );
    } else {
      $("#skip_cl").load(
        '<?=base_url('preventive/skip_form/')?>' +
        id_jadwal_cl);
    }
  }
  // HAPUS CL
  function hapus_cl(id_jadwal_cl, level) {
    if (level > 5) {
      alert('Forbidden Access Level');
    } else {
      var tanyahapus = confirm('Anda akan menghapus jadwal?');
      if (tanyahapus == true) {
        $.ajax({
          type: "POST",
          url: "<?=base_url('preventive/hapus/')?>" +
            id_jadwal_cl,
          data: csrf,
          cache: false,
          success: function(tampil) {
            location.reload();
          }
        });
      }
    }
  }
  //============ FUNGSI CHECK
  $(".cek_cl").click(function() {
    var id_jadwal_cl = $(this).attr("id_jadwal_cl");
    $("#done_cl").load(
      '<?=base_url('preventive/done1_form/')?>' +
      id_jadwal_cl);
  });

  // INPUT JADWAL ITEMNYA ===================================
  $("#input_jadwal").submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "<?=base_url('preventive/input')?>",
      data: $(this).serialize(),
      cache: false,
      success: function(tampil) {
        location.reload();
      }
    });

  });
</script>