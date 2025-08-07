<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Surat Jalan Rekanan</h1>
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
                    <a href="<?= base_url('sjrekanan/create');?>"><button class="btn btn-sm btn-success"><i class="far fa-edit"></i> Buat Surat Jalan</button></a> &nbsp;
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-search"><i class="fas fa-search"></i> Cari Data</button>&nbsp;
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
<table id="table-sjrekanan" class="table table-bordered">
  <thead class='thead-dark'>
    <tr>
      <th>Tgl</th>
      <th>Rekanan</th>
      <th>Mesin</th>
      <th>Nama Barang</th>
      <th>Keterangan</th>
      <th>Qty</th>
      <th>Unit</th>
      <th>Doc</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=0;
    $jum_tgl=1;
    $jum_pdf=1;
    foreach($sjrekanan as $itemsjrekanan)
    {
  // Tampilin tombol PDF
  $tombol_pdf="<button class='btn btn-xs btn-default'><i class='fa fa-file-pdf'></i></button>";
  // BIKIN NO sesuai SPAN
    if($jum_no <= 1) {
      $no++;
      $jum_no = $itemsjrekanan->jumlah;   
               
  } else {
      $jum_no = $jum_no - 1;
  }
    echo"
    <tr>";

    if($jum_tgl <= 1) {
      echo " <td rowspan='$itemsjrekanan->jumlah'>".date('d/m/y',strtotime($itemsjrekanan->tgl_kirim))."</td>
      <td rowspan='$itemsjrekanan->jumlah'>$itemsjrekanan->nama_relasi</td>";
      $jum_tgl = $itemsjrekanan->jumlah;   
               
  } else {
      $jum_tgl = $jum_tgl - 1;
  }
  echo"
     
      <td>$itemsjrekanan->nama_mesin</td>
      <td>$itemsjrekanan->nama_barang</td>
      <td>$itemsjrekanan->note</td>
      <td>$itemsjrekanan->qty_kirim</td>
      <td> $itemsjrekanan->kode_satuan</td>";
      if($jum_pdf <= 1) {
        echo "<td rowspan='$itemsjrekanan->jumlah'><a href='".base_url('sjrekanan/doprint/').$this->secure->encrypt($itemsjrekanan->id_lain)."' target='blank'>$tombol_pdf</a></td>
        <td rowspan='$itemsjrekanan->jumlah'>
      <div class='input-group-prepend'>
                    <button type='button' class='btn btn-block btn-secondary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                      Aksi
                    </button>
                    <div class='dropdown-menu' style=''>
                    <a class='dropdown-item' href='".base_url('sjrekanan/form_edit/').$itemsjrekanan->id_lain."'><i class='fa fa-edit'></i>&nbsp;Edit</a>
                    <a  class='dropdown-item' onclick='return confirm(\"Anda yakin menghapus Surat Jalan ".$itemsjrekanan->id_lain."?\")' href='".base_url('sjrekanan/del_all/').$itemsjrekanan->id_lain."'><i class='fa fa-trash'></i>&nbsp;Hapus Surat Jalan</a>
                      
                    </div>
                  </div>
      </td>";
        $jum_pdf = $itemsjrekanan->jumlah;   
                 
    } else {
        $jum_pdf = $jum_pdf - 1;
    }
      echo"
    </tr>";
    $id_now=$itemsjrekanan->id_lain;
    }
    ?>
  </tbody>
</table>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!---------------- UNTUK MENU PENCARIAN --------------------------------------------------------------->
<div class="modal fade" id="modal-search">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari Data Surat Jalan </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?=base_url('sjrekanan')?>">
            <div class="modal-body">            
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <!-- CARI AWAL -->
            <div class="form-group row">
                    <label for="start_cl" class="col-sm-3 col-form-label">Mulai</label>
                    <div class="col-sm-9">
                      <input value="" name="start" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                    </div>
            </div>
            <!-- CARI AKHIR -->
            <div class="form-group row">
                    <label for="stop_cl" class="col-sm-3 col-form-label">Sampai</label>
                    <div class="col-sm-9">
                      <input value="" name="stop" type="text" class="form-control form-control-sm tanggalan" placeholder="" required>
                    </div>
            </div>

            <!-- MESIN -------->
            <div class="form-group row">
                    <label for="jenislkh" class="col-sm-3 col-form-label">Tujuan</label>
                    <div class="col-sm-9">
                    <select name="id_relasi" id="id_relasi" required class="select2 form-control form-control-sm" placeholder="">
                    <option value="ALL">SEMUA TUJUAN</option>
                    <?php
                    foreach ($relasi as $item) 
                    {echo '<option value="'.$item->id_relasi.'">'.$item->nama_relasi.'</option>';}
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
      </div>
    <!-- MENU PENCARIAN SAMPAI SINI-->

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
  //$("#table-sjrekanan").dataTable();
  <?=$this->session->userdata('swal');$this->session->unset_userdata('swal');?>
});
</script>