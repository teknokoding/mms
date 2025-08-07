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
          <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Buat Laporan Lanjutan</h3>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-6">
                <div class="callout callout-info">
                <?php
                foreach ($lkh as $iteminfo) {
                
                }
                echo'<b>'.$iteminfo->nama_mesin.'</b> / '.$iteminfo->nama_unitmesin.' / '.$iteminfo->detail.'&nbsp;&nbsp;<button class="btn btn-xs btn-info float-right" id="btnhistori"><i class="far fa-clock"></i> riwayat</button><br>
                '.$iteminfo->keluhan.'<br><br>';
                ?>
                
                <table class="table table-sm table-striped" id="histori">
                <thead>
                <tr>
                <th>Waktu</th><th>Uraian Kerja</th><th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($lkh as $itemlkh) {
                    echo'
                    <tr><td>'.$itemlkh->tgllkhformat.'<br>'.date("H:i",strtotime($itemlkh->waktumulai)).'-'.date("H:i",strtotime($itemlkh->waktuselesai)).'</td>
                    <td>';cetak($itemlkh->uraian);echo'</td><td>'.$itemlkh->status.'</td></tr>
                    ';
                  }
                ?>
                </tbody>
                </table>
                </div>
                </div>
                </div>  
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST" action="<?= base_url('monitor/inputmonitor');?>">
              <!-- SECURE SECURE SECURE -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id_sect" value="<?= $this->session->userdata('id_sect');?>">
              <input type="hidden" name="id_dept" value="<?= $this->session->userdata('id_dept');?>">
              <input type="hidden" name="reff_id" value="<?=$reff_id;?>">
              <input type="hidden" name="id_mesin" value="<?=$itemlkh->id_mesin;?>">
              <input type="hidden" name="id_unit_mesin" value="<?=$itemlkh->id_unit_mesin;?>">
              <input type="hidden" name="detail" value="<?=$itemlkh->detail;?>">
              <input type="hidden" name="keluhan" value="<?=$itemlkh->keluhan;?>">
                  <!-- KEGIATAN -------->
                  <div class="form-group row">
                    <label for="jenislkh" class="col-sm-2 col-form-label">Jenis Kegiatan</label>
                    <div class="col-sm-2">
                    <select name="jenislkh" id="jenislkh" required class="form-control form-control-sm" placeholder="">
                    <option value="">Pilih Kegiatan</option>
                    <option value="PRV">PREVENTIVE</option>
                    <option value="BRK">BREAKDOWN</option>
                    <option value="COR">CORRECTIVE</option>
                    <option value="LLN">LAIN-LAIN</option>
                    <option value="INFO">INFORMASI</option>
                    </select>
                    </div>
                  </div>
                  <!-- WAKTU -------->
                  <div class="form-group row">
                    <label for="shift" class="col-sm-2 col-form-label">Waktu</label>
                    <div class="col-sm-2">
                    <select name="shift" id="shift" required class="form-control form-control-sm" placeholder="">
                    <option value="">Shift</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    </select>
                    </div>
                    
                    <div class="col-sm-2">
                      <input name="tgllkh" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                    </div>

                    <div class="col-sm-1">
                      <input name="waktumulai" type="text" class="form-control form-control-sm jammask" placeholder="Mulai" data-inputmask="'mask': '99:99'" required>
                    </div>

                    <div class="col-sm-1">
                      <input name="waktuselesai" type="text" class="form-control form-control-sm jammask" placeholder="Selesai" data-inputmask="'mask': '99:99'" required>
                    </div>
                  </div>

                  <!-- URAIAN KERJA -------->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-2 col-form-label">Uraian Kerja</label>
                    <div class="col-sm-6">
                      <textarea id="uraian" name="uraian"  class="form-control form-control-sm" placeholder="" rows="5" spellcheck="false"></textarea>
                    </div>
                  </div>    
                <!-- STATUS -------->
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Satus</label>
                    <div class="col-sm-2">
                    <select name="status" id="status" required class="form-control form-control-sm" placeholder="">
                    <option value="">Pilih Status</option>
                    <option value="OK">OK</option>
                    <option value="NOK">NOK</option>
                    <option value="M">MONITOR</option>
                    </select>
                    </div>
                  </div>  
                <!-- PELAKSANA -------->
                <div class="form-group row">
                    <label for="pelaksana1" class="col-sm-2 col-form-label">Pelaksana</label>
                    <div class="col-sm-6">
                    <select multiple="multiple" class="select2bs4 form-control form-control-sm" id="pelaksana" name="pelaksana[]"  data-placeholder="Pilih Pelaksana" style="width: 100%;" required>
                    <?php
                    foreach ($karyawan as $item) 
                    {echo '<option value="'.$item->nik.'">'.$item->nama_karyawan.'</option>';}
                    ?>
                    </select>
                  </div> 
                </div> 
                <!-- INPUT -------->
                <div class="form-group row">
                    <label for="pengisilaporan" class="col-sm-2 col-form-label">Pembuat Laporan</label>
                    <div class="col-sm-2">
                    <select class="form-control form-control-sm" id="pengisilaporan" name="pengisilaporan">
                    <?php
                    
                    foreach ($karyawan as $item) 
                    { $item->nik==$this->session->userdata('username')?$pilih="selected":$pilih="";
                    
                      echo '<option value="'.$item->nik.'", '.$pilih.'>'.$item->nama_karyawan.'</option>';}
                    ?>
                    </select>
                  </div> 
                </div> 

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <div class="float-right">
                  <button onclick="kembali();" type="reset" class="btn btn-danger">Batal</button>&nbsp;
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  $('#histori').hide();
  var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };

  $(document).ready(function()
  {

$('#btnhistori').click(function()
{
  $('#histori').toggle();
});
//
$('#id_unit_mesin').hide();
$('#detail').hide();
//mesin di klik
$('#id_mesin').change(function()
{
  $('#id_unit_mesin').show();
  $('#detail').show();
var id_mesin = $(this).val();
$('#id_unit_mesin').empty();
$('#id_unit_mesin').append('<option value="">Pilih Unit</option>');
$.ajax({
        type: "POST",
        url: "<?php echo base_url('unitmesin/readbymesin/'); ?>" + id_mesin,
        data: csrf,
        cache: false,
        success: function(hasil) {
          unitmesin = jQuery.parseJSON(hasil);
          console.log(unitmesin);
          $.each(unitmesin, function(i, item) {
            $('#id_unit_mesin').append('<option value="'+unitmesin[i].id_unitmesin+'">'+unitmesin[i].nama_unitmesin+'</option>');
          }); 
        }
      });
    });
  });
  </script>
