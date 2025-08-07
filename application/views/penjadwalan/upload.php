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

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="card-tool">
                    <h5>Form Upload Jadwal</h5>
                    </div>
                    </div>
                    <div class="card-body">
  <a href="<?php echo base_url("assets/excel/template.xlsx"); ?>" target="_blank">Download Format</a>
  <br>
  <br>
  
  <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
  <form method="post" action="<?php echo base_url("penjadwalan/form"); ?>" enctype="multipart/form-data">
    <!-- 
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
    <div class="row">
    <div class="col-md-4">
    <div class="custom-file">
                        
                    <div class="form-group">
                    <label for="exampleInputFile">File Jadwal (xlsx)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exelfile" name="file" accept=".xlsx">
                        <label class="custom-file-label" for="exampleInputFile">Pilh File</label>
                      </div>
                      <div class="input-group-append">
                      <button id="preview" class='input-group-text btn btn-xs btn-warning' type="submit" name="preview">&nbsp;Preview&nbsp;</button>
                      </div>
                    </div>
                  </div>
                  </div>
    </div>
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    
    <!--
    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
    <div class="col-md-2">
    
    </div>
    </div>
  </form>
  <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }
    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url("penjadwalan/import")."'>";
    echo "<br>";
    // Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red;' id='kosong'>
    Ada data yang belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
    </div>";
    
    echo "<table border='1' cellpadding='8'>
    <tr>
      <th colspan='5'>Preview Data</th>
    </tr>
    <tr>
      <th>Mesin</th>
      <th>Kode CL</th>
      <th>Tgl Mulai</th>
      <th>Bulan Mulai</th>
      <th>Tahun Mulai</th>
    </tr>";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di excel
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // Ambil data pada excel sesuai Kolom
      $mesin = $row['B']; // Ambil data mesin
      $kode_cl = $row['C']; // Ambil data kode_cl
      $date_start = $row['D']; // Ambil data tgl
      $month_start = $row['E']; // Ambil data bln
      $year_start = $row['F']; // Ambil data thn
      
      
      // Cek jika semua data tidak diisi
      if($mesin == "" && $kode_cl == "" && $date_start == "" && $month_start == "" &&  $year_start == "")
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $mesin_td = ( ! empty($mesin))? "" : " style='background: #E07171;'"; 
        $kode_cl_td = ( ! empty($kode_cl))? "" : " style='background: #E07171;'"; 
        $date_start_td = ( ! empty($date_start))? "" : " style='background: #E07171;'"; 
        $month_start_td = ( ! empty($month_start))? "" : " style='background: #E07171;'"; 
        $year_start_td = ( ! empty($year_start))? "" : " style='background: #E07171;'"; 
        
        // Jika salah satu data ada yang kosong
        if($mesin == "" || $kode_cl == "" || $date_start == "" || $month_start == "" ||  $year_start == ""){
          $kosong++; // Tambah 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$mesin_td.">".$mesin."</td>";
        echo "<td".$kode_cl_td.">".$kode_cl."</td>";
        echo "<td".$date_start_td.">".$date_start."</td>";
        echo "<td".$month_start_td.">".$month_start."</td>";
        echo "<td".$year_start_td.">".$year_start."</td>";
        echo "</tr>";
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 0
    // Jika lebih dari 0, berarti ada data yang masih kosong
    if($kosong > 0){
    ?>	
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      echo'<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">';
      echo "<input type='hidden' name='nama_file' value='$nama_file'>";
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button id='import' class='btn btn-sm btn-success' type='submit' name='import'><i class='fa fa-download'></i>&nbsp;&nbsp;Import</button>";
      
    }
    
    echo "</form>";
  }
  ?>
  &nbsp;<br><a href='<?=base_url("penjadwalan")?>'><button class="btn btn-sm btn-danger"><i class="fa fa-undo"></i>&nbsp;Batal</button></a><br><br>
  <!-- CARD BODY -->
</div>
  <!-- CARD -->
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
$(document).ready(function () {
  $("#preview").hide();
  $("#exelfile").change(function (e) { 
    e.preventDefault();
    $("#preview").show();
    $("#import").hide();
  });
});
</script>