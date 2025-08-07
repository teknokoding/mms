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
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card-shadow-danger border mb-3 card card-body border-danger">

            <div class="">
              <div class="card-tool">
                <select name="id_mesin" id="setid_mesin" required class="select2 form-control form-control-sm"
                  placeholder="">
                  <option value="ALL">SEMUA MESIN</option>
                  <?php
                    foreach ($mesin as $itemmesin) {
                        $itemmesin->id_mesin==$this->session->userdata('id_mesin')?$pilih="selected":$pilih="";
                        echo '<option value="'.$itemmesin->id_mesin.'" '.$pilih.'>'.$itemmesin->nama_mesin.'</option>';
                    }
                    ?>
                </select>
              </div>
            </div>
            <br>
            <div class="">
              <div class="table-responsive">
                <table id="table-tag" class="table table-sm table-hover table-bordered">
                  <thead>
                    <tr class='table-danger'>
                      <th>Id Tag</th>
                      <th>Tgl Tag</th>
                      <th>Mesin</th>
                      <th>Unit</th>
                      <th>Deskripsi</th>
                      <th>Tag By</th>
                      <th>Section</th>
                      <th><i class='far fa-clock'></i></th>
                      <th><i class='far fa-paper-plane'></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($tpm as $item) {
                        echo "
                    <tr>
                    <td>$item->id_tag</td>
                    <td>".date('d M Y', strtotime($item->tgl_tag))."</td>
                    <td>$item->nama_mesin</td>
                    <td>$item->nama_unitmesin</td>
                    <td>$item->deskripsi</td>
                    <td>$item->nama_karyawan</td>
                    <td>$item->nama_sect</td>
                    <td><button  title='Riwayat' class='btn-riwayat btn btn-xs btn-outline-info judul' id_tag='$item->id_tag'><i class='far fa-clock'></i></button></td>
                    <td><button  title='Release' class='btn-release btn btn-xs btn-outline-success judul' id_tag='$item->id_tag'><i class='far fa-paper-plane'></i></button></td>
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
      <!-- CONTAINER FLUID -->
    </div>
    <!-- CONTENT -->
  </div>
  <!-- CONTENT WRAPPER -->
</div>
<div id="riwayat"></div>
<div id="release"></div>
<script>
  var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
  $(document).ready(function() {
    // TOOLTIP
    $(".judul").tooltip();
    // FILTER MESINNYA
    $("#setid_mesin").change(function() {
      var id_mesin = $(this).val();
      $.ajax({
        type: "POST",
        url: '<?=base_url('tpm/set_mesin/');?>' +
          id_mesin,
        data: csrf,
        cache: false,
        success: function(html) {
          window.location.reload();
        }

      });
    });
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>

    $("#table-tag").dataTable({
      "paging": false,
      "searh": false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf', 'print'
      ]
    });
  });
  // EDIT DATA
  $('.btn-riwayat').click(function() {
    var id_tag = $(this).attr('id_tag');
    $("#riwayat").load(
      '<?=base_url('tpm/riwayat/');?>' + id_tag);
  })
  // RELEASE
  $('.btn-release').click(function() {
    var id_tag = $(this).attr('id_tag');
    $("#release").load(
      '<?=base_url('tpm/release/');?>' + id_tag);
  })
  document.title =
    "Tag TPM <?php if ($this->session->userdata('id_mesin')=="ALL") {
                        $mesinnya="SEMUA MESIN";
                    } else {
                        $mesinnya=$item->nama_mesin;
                    } echo $mesinnya;?>";
</script>