<?php
foreach ($lkh as $item) {
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
          <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit Laporan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST" action="<?= base_url('lkh/update/').$item->id_lkh;?>">
              <!-- SECURE SECURE SECURE -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="reff_id" value="<?=$item->reff_id;?>">
                <div class="card-body">
                  <!-- KEGIATAN -------->
                  <div class="form-group row">
                    <label for="jenislkh" class="col-sm-2 col-form-label">Jenis Kegiatan</label>
                    <div class="col-sm-2">
                    <select name="jenislkh" id="jenislkh" required class="form-control form-control-sm" placeholder="">
                    
                    <option value="PRV", <?php $item->jenislkh=="PRV"?$pilih="selected":$pilih="";echo $pilih;?>>PREVENTIVE</option>
                    <option value="BRK", <?php $item->jenislkh=="BRK"?$pilih="selected":$pilih="";echo $pilih;?>>BREAKDOWN</option>
                    <option value="COR", <?php $item->jenislkh=="COR"?$pilih="selected":$pilih="";echo $pilih;?>>CORRECTIVE</option>
                    <option value="LLN", <?php $item->jenislkh=="LLN"?$pilih="selected":$pilih="";echo $pilih;?>>LAIN-LAIN</option>
                    <option value="INFO", <?php $item->jenislkh=="INFO"?$pilih="selected":$pilih="";echo $pilih;?>>INFORMASI</option>
                    </select>
                    </div>
                  </div>
                  <!-- WAKTU -------->
                  <div class="form-group row">
                    <label for="shift" class="col-sm-2 col-form-label">Waktu</label>
                    <div class="col-sm-2">
                    <select name="shift" id="shift" required class="form-control form-control-sm" placeholder="">
                    <option value="1",<?php $item->shift=="1"?$pilih="selected":$pilih="";echo $pilih;?>>1</option>
                    <option value="2",<?php $item->shift=="2"?$pilih="selected":$pilih="";echo $pilih;?>>2</option>
                    <option value="3",<?php $item->shift=="3"?$pilih="selected":$pilih="";echo $pilih;?>>3</option>
                    </select>
                    </div>
                    
                    <div class="col-sm-2">
                      <input value="<?=$item->tgllkh;?>" name="tgllkh" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                    </div>

                    <div class="col-sm-1">
                      <input value="<?=$item->waktumulai;?>" name="waktumulai" type="text" class="form-control form-control-sm jammask" placeholder="Mulai" data-inputmask="'mask': '99:99'" required>
                    </div>

                    <div class="col-sm-1">
                      <input value="<?=$item->waktuselesai;?>" name="waktuselesai" type="text" class="form-control form-control-sm jammask" placeholder="Selesai" data-inputmask="'mask': '99:99'" required>
                    </div>
                  </div>

                  <!-- MESIN -------->
                  <div class="form-group row">
                    <label for="jenislkh" class="col-sm-2 col-form-label">Mesin</label>
                    <div class="col-sm-2">
                    <select name="id_mesin" id="id_mesin" required class="select2 form-control form-control-sm" placeholder="">
                    <option value=""></option>
                    <?php
                    foreach ($mesin as $itemmesin) 
                    {
                      $item->id_mesin==$itemmesin->id_mesin?$pilih="selected":$pilih="";
                      echo '<option value="'.$itemmesin->id_mesin.'", '.$pilih.'>'.$itemmesin->nama_mesin.'</option>';}
                    ?>
                    </select>
                    </div>
                    <!-- UNIT MESIN------>
                    <div class="col-sm-2" id="div_id_unitmesin animate_animated animate_bounce">
                      <select name="id_unit_mesin" id="id_unit_mesin" required class="form-control form-control-sm" placeholder="">
                      </select>
                    </div>
                    <!-- DETAIL LOKASI -->
                    <div class="col-sm-2">
                      <input value="<?=$item->detail;?>" id="detail" name="detail" type="text" class="form-control form-control-sm" placeholder="Detail Lokasi">
                    </div>
                  </div>
                  <!-- KEGIATAN -------->
                  <div class="form-group row">
                    <label for="jenislkh" class="col-sm-2 col-form-label">Keluhan</label>
                    <div class="col-sm-6">
                      <input value="<?php cetak($item->keluhan);?>" id="keluhan" name="keluhan" type="text" class="form-control form-control-sm" placeholder="" autocomplete="off">
                    </div>
                  </div> 
                  <!-- URAIAN KERJA -------->
                  <div class="form-group row">
                    <label for="uraian" class="col-sm-2 col-form-label">Uraian Kerja</label>
                    <div class="col-sm-6">
                      <textarea id="uraian" name="uraian"  class="form-control form-control-sm" placeholder="" rows="5" spellcheck="false"><?php cetak($item->uraian);?></textarea>
                    </div>
                  </div>    
                <!-- STATUS -------->
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Satus</label>
                    <div class="col-sm-2">
                    <select name="status" id="status" required class="form-control form-control-sm" placeholder="">
                    <option value="OK", <?php $item->status=="OK"?$pilih="selected":$pilih="";echo $pilih;?>>OK</option>
                    <option value="NOK", <?php $item->status=="NOK"?$pilih="selected":$pilih="";echo $pilih;?>>NOK</option>
                    <option value="M", <?php $item->status=="M"?$pilih="selected":$pilih="";echo $pilih;?>>MONITOR</option>
                    </select>
                    </div>
                  </div>  
                <!-- PELAKSANA -------->
                <div class="form-group row">
                    <label for="pelaksana1" class="col-sm-2 col-form-label">Pelaksana</label>
                    <div class="col-sm-6">
                    <select multiple="multiple" class="select2bs4 form-control form-control-sm" id="pelaksana" name="pelaksana[]"  data-placeholder="Pilih Pelaksana" style="width: 100%;" required>
                    <?php
                    foreach ($karyawan as $itemkaryawan) 
                    {
                      
                      for($i=1;$i<=6;$i++)
                    {
                      $pelaksana = "pelaksana".$i;
                      if($item->$pelaksana==$itemkaryawan->nik)
                      {
                        $pilihan[$i]="selected";
                        
                      }
                      else
                      {
                        $pilihan[$i] = "";
                        
                      }
                    }
                    echo '<option value="'.$itemkaryawan->nik.'", '.$pilihan[1].$pilihan[2].$pilihan[3].$pilihan[4].$pilihan[5].$pilihan[6].'>'.$itemkaryawan->nama_karyawan.'</option>';
                    }
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
                    
                    foreach ($karyawan as $itemkaryawan) 
                    { $item->pengisilaporan==$itemkaryawan->nik?$pilih="selected":$pilih="";
                      echo '<option value="'.$itemkaryawan->nik.'", '.$pilih.'>'.$itemkaryawan->nama_karyawan.'</option>';}
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
  var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };

  $(document).ready(function()
  {
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
  
  //sub unit saat ini
var id_mesin = $("#id_mesin").val();
$('#id_unit_mesin').empty();
var pilihmesin;
$.ajax({
        type: "POST",
        url: "<?php echo base_url('unitmesin/readbymesin/'); ?>" + id_mesin,
        data: csrf,
        cache: false,
        success: function(hasil) {
          unitmesin = jQuery.parseJSON(hasil);
          console.log(unitmesin);
          $.each(unitmesin, function(i, item) {
            if(<?=$item->id_unit_mesin;?>==unitmesin[i].id_unitmesin)
            {
              pilihmesin="selected";
            }
            else
            {
              pilihmesin="";
            }
            $('#id_unit_mesin').append('<option value="'+unitmesin[i].id_unitmesin+'", '+pilihmesin+'>'+unitmesin[i].nama_unitmesin+'</option>');
          }); 
        }
      });
  
  });
  </script>
