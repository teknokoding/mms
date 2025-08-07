<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> SPK Bengkel </h1>
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
                    <a href="<?= base_url('spkbk/create');?>"><button class="btn btn-sm btn-success"><i class="far fa-edit"></i> Buat SPK</button></a> &nbsp;
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-search"><i class="fas fa-search"></i> Cari Data</button>&nbsp;
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
<table id="table-spk" class="table table-bordered">
  <thead class='thead-dark'>
    <tr>
      <th>Tgl</th>
      <th>Mesin</th>
      <th>Nama Barang</th>
      <th>Spesifikasi</th>
      <th>Instruksi</th>
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
    foreach($spk as $itemspk)
    {
  // Tampilin tombol PDF
    $itemspk->valid=="Y"?$tombol_pdf="<button class='btn btn-xs btn-default'><i class='fa fa-file-pdf'></i></button>":$tombol_pdf="";
  // BIKIN NO sesuai SPAN
    if($jum_no <= 1) {
      $no++;
      $jum_no = $itemspk->jumlah;   
               
  } else {
      $jum_no = $jum_no - 1;
  }
  /*/ BIKIN STRIP
  if($no==1)
    {
      $id=$itemspk->id_spkbk;
    }
    else
    {
      $id=$id_now;
    }
    $id!=$itemspk->id_spkbk?$mod++:$mod=$mod;
    if($mod%2==0){$class="warning";}else{$class="";}
    /*/
    echo"
    <tr class='table-$class'>
    ";

    if($jum_tgl <= 1) {
      echo " <td rowspan='$itemspk->jumlah'>".date('d/m/y',strtotime($itemspk->tgl_spk))."</td>";
      $jum_tgl = $itemspk->jumlah;   
               
  } else {
      $jum_tgl = $jum_tgl - 1;
  }
  echo"
      <td>$itemspk->nama_mesin</td>
      <td>$itemspk->nama_barang</td>
      <td>$itemspk->spesifikasi</td>
      <td>$itemspk->note</td>
      <td>$itemspk->qty_minta</td>
      <td> $itemspk->kode_satuan</td>";
      if($jum_pdf <= 1) {
        echo "<td rowspan='$itemspk->jumlah'><a href='".base_url('spkbk/doprint/').$this->secure->encrypt($itemspk->id_spkbk)."' target='blank'>$tombol_pdf</a></td>
        <td rowspan='$itemspk->jumlah'>
      <div class='input-group-prepend'>
                    <button type='button' class='btn btn-block btn-secondary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                      Aksi
                    </button>
                    <div class='dropdown-menu' style=''>
                    <a class='dropdown-item' href='".base_url('spkbk/form_edit/').$itemspk->id_spkbk."'><i class='fa fa-edit'></i>&nbsp;Edit / Validasi</a>
                    <a  class='dropdown-item' onclick='return confirm(\"Anda yakin menghapus SPK ".$itemspk->id_spkbk."?\")' href='".base_url('spkbk/del_all/').$itemspk->id_spkbk."'><i class='fa fa-trash'></i>&nbsp;Hapus SPK</a>
                      
                    </div>
                  </div>
      </td>";
        $jum_pdf = $itemspk->jumlah;   
                 
    } else {
        $jum_pdf = $jum_pdf - 1;
    }
      echo"
    </tr>";
    $id_now=$itemspk->id_spkbk;
    }
    ?>
  </tbody>
</table>
<?=$pagination?>

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
              <h5 class="modal-title"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari Data SPK </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?=base_url('spkbk')?>">
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
                    <label for="jenislkh" class="col-sm-3 col-form-label">MESIN</label>
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
  //$("#table-spk").dataTable();
  <?=$this->session->userdata('swal');$this->session->unset_userdata('swal');?>
});
</script>