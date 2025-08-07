<?php if ($cari) {?><script>
  showLoader();
</script><?php }?>
<div id="detail"></div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php if ($cari) {
    echo"Hasil Pencarian LKH";
}?>
          </h1>
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
                <a
                  href="<?= base_url('lkh/create'); ?>"><button
                    class="btn btn-sm btn-success"><i class="far fa-edit"></i> Buat Laporan</button></a> &nbsp;
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-search"><i
                    class="fas fa-search"></i> Cari Data</button>&nbsp;
                <a id="all_lkh"
                  href="<?= base_url('lkh'); ?>"><button
                    class="btn btn-sm btn-warning"><i class="far fa-eye"></i> Semua Laporan</button></a> &nbsp;
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="tabel-lkh" class="table table-sm table-bordered">
                  <thead class="table-active">
                    <tr>
                      <th>Jenis</th>
                      <th>Waktu</th>
                      <th>Shft</th>
                      <th>Mesin</th>
                      <th>Unit</th>
                      <th>Keluhan</th>
                      <th>Uraian Kerja</th>
                      <th>Status</th>
                      <th>Acc</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
    $no = $page;
   // BERI HAK ACC LAPORAN
    if ($this->session->userdata('id_level')<6) {
        $acc_able = "";
    } else {
        $acc_able = "disabled";
    }
    foreach ($lkh as $item) {
        $no++;
        // BUAT WARNA ROW
        if ($item->status!='OK' and $item->finish!='1') {
            $kelas = 'table-danger';
        } elseif ($item->jenislkh=="LLN" || $item->jenislkh=="PRV") {
            $kelas='table-info';
        } else {
            $kelas = '';
        }
        // INFO ACC
        if (empty($item->acc)) {
            $acc_status="";
        } else {
            $acc_status="checked";
        }
        // LANJUTAN
        $item->finish==0?$menu_lanjut='<a class="dropdown-item" href="'.base_url('lkh/createnext/').$item->reff_id.'"><i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;Lanjutkan</a>':$menu_lanjut="";
        echo'
      <tr class="'.$kelas.'">
      <td>'.$item->jenislkh.'</td>
      <td>'.$item->tgllkhformat.'<br>'.date("H:i", strtotime($item->waktumulai)).' '.date("H:i", strtotime($item->waktuselesai)).'
      <br><small><font color="blue">'.durasi_jam($item->tgllkh, $item->waktumulai, $item->waktuselesai).'</font></small></td>
      <td>'.$item->shift.'</td>
      <td>'.$item->nama_mesin.'</td>
      <td>'.$item->nama_unitmesin.'</td>
      <td>'.$item->keluhan.'</td>
      <td>'.$item->uraian.'</td>
      <td>'.$item->status.'</td>
      <td><div  id_lkh="'.$item->id_lkh.'" class="icheck-primary d-inline do_acc">
      <input  type="checkbox"  '.$acc_status.'>
      <label>
      </label>
      </div></td>
      <td>
      <div class="input-group-prepend">
                    <button type="button" class="btn btn-block btn-secondary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" style="">
                    '.$menu_lanjut.'
                    <a class="dropdown-item detail" id_lkh="'.$item->id_lkh.'" href="#"><i class="far fa-eye"></i>&nbsp;Detail</a>
                      <a class="dropdown-item" href="'.base_url('lkh/edit/').$item->id_lkh.'"><i class="far fa-edit"></i>&nbsp;Edit</a>
                      <a onclick="javascript: return confirm(\'yakin menghapus LKH ini?\');" class="dropdown-item" href="'.base_url('lkh/delete/').$item->id_lkh.'"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Hapus</a>
                    </div>
                  </div>
      </td>
      </tr>';
    }
    ?>
                  </tbody>
                </table>
                <?php if (!$cari) {
        echo $pagination;
    }?>
              </div>

            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
      <!---------------- UNTUK MENU PENCARIAN --------------------------------------------------------------->
      <div class="modal fade" id="modal-search">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari Data LKH </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" method="POST"
              action="<?=base_url('lkh')?>">
              <div class="modal-body">
                <input type="hidden"
                  name="<?php echo $this->security->get_csrf_token_name(); ?>"
                  value="<?php echo $this->security->get_csrf_hash(); ?>">
                <!-- CARI AWAL -->
                <div class="form-group row">
                  <label for="start_cl" class="col-sm-3 col-form-label">Mulai</label>
                  <div class="col-sm-9">
                    <input value="" name="start" type="text" class="form-control form-control-sm tanggalan"
                      placeholder="" required>
                  </div>
                </div>
                <!-- CARI AKHIR -->
                <div class="form-group row">
                  <label for="stop_cl" class="col-sm-3 col-form-label">Sampai</label>
                  <div class="col-sm-9">
                    <input value="" name="stop" type="text" class="form-control form-control-sm tanggalan"
                      placeholder="" required>
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
    </div>
    <!-- MENU PENCARIAN SAMPAI SINI-->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  $("#all_lkh").hide();
  var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
  $(".detail").click(function() {
    var id_lkh = $(this).attr('id_lkh');
    $("#detail").load('<?=base_url('lkh/detail/')?>' +
      id_lkh);
  });
  $(document).ready(function() {
    hideLoader();
    <?php if ($cari) {?>
    $("#all_lkh").show();
    $("#tabel-lkh").DataTable({
      "info": true,
      "paging": true,
      "searching": true,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'print'
      ]
    });
    <?php }?>
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
    // ACC =======================
    $('.do_acc').click(function() {
      var id_lkh = $(this).attr('id_lkh');
      $.ajax({

        url: "<?=base_url('lkh/acc/')?>" +
          id_lkh,

        success: function() {
          location.reload();
        }
      });
    });

  })
</script>