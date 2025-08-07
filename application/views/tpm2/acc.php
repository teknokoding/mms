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
          <div class="card-shadow-success border mb-3 card card-body border-success">

            <br>
            <div class="">
              <div class="table-responsive">
                <table id="table-tag" class="table table-sm table-hover table-bordered">
                  <thead>
                    <tr class='table-primary'>
                      <th>No</th>
                      <th>Id Tag</th>
                      <th>Tgl Tag</th>
                      <th>Mesin</th>
                      <th>Unit</th>
                      <th>Deskripsi</th>
                      <th>Tag By</th>
                      <th>Ditujukan</th>
                      <th>Acc</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
                    foreach ($acc as $item) {
                        $no++;
                        echo "
                    <tr>
                    <td>$no</td>
                    <td>$item->id_tag</td>
                    <td>".date('d M Y', strtotime($item->tgl_tag))."</td>
                    <td>$item->nama_mesin</td>
                    <td>$item->nama_unitmesin</td>
                    <td>$item->deskripsi</td>
                    <td>$item->nama_karyawan</td>
                    <td>$item->nama_sect</td>
                    <td><button class='btn btn-success btn-sm btn-riwayat' id_tag='$item->id_tag'>Acc</button>
                  </div>
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
<!-- FORM MODAL INPUT -->
<div class="modal fade" id="modal-formtag">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <h5>Tambah Tag Baru</h5>
        </div>
      </div>
      <form role="form" method="post"
        action="<?=base_url('tpm2fromsection/create')?>">
        <div class="modal-body">
          <input type="hidden"
            name="<?php echo $this->security->get_csrf_token_name(); ?>"
            value="<?php echo $this->security->get_csrf_hash(); ?>">
          <!-- Tgl Tag -->
          <input type="hidden" name='tgl_tag'
            value="<?=date('Y-m-d');?>">
          <!-- Id Dept -->
          <input type="hidden" name='id_dept'
            value="<?=$this->session->userdata('id_dept');?>">
          <!-- Id Sect -->
          <input type="hidden" name='id_sect'
            value="<?=$this->session->userdata('id_sect');?>">
          <!-- Input Tag User -->
          <input type="hidden" name='input_tag'
            value="<?=$this->session->userdata('username');?>">
          <!-- DEPT PIC -->
          <input id="dept_pic" type="hidden" name='dept_pic'>
          <!-- Jenis Tag FIX DULU -->
          <input type="hidden" name="jenis_tag" value="failure">
          <!-- MESIN  -->
          <div class="form-group">
            <label for="id_mesin">Mesin</label>
            <select name="id_mesin" id="id_mesin_input" class="form-control form-control-sm select2" required>
              <option value="">PILIH MESIN</option>
              <?php
                foreach ($mesin as $itemmesin) {
                    echo "<option value='$itemmesin->id_mesin'>$itemmesin->nama_mesin</option>";
                }
            ?>
            </select>
          </div>
          <!-- ID UNIT MESIN  -->
          <div class="form-group" id="data_id_unit">
            <label for="id_unit">Unit Mesin</label>
            <select name="id_unit" id="id_unit" required class="form-control form-control-sm"></select>
          </div>
          <!-- Deskripsi Tag -->
          <div class="form-group">
            <label for=" deskripsi">Uraian Tag</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
          </div>
          <!--Seksi Tujuan  -->
          <div class="form-group">
            <label for="id_pic">Ditujukan Untuk</label>
            <select name="id_pic" id="id_pic" class="form-control form-control-sm" required>
              <option value="">PILIH SEKSI TUJUAN</option>
              <?php
                foreach ($sect as $itemsect) {
                    echo "<option value='$itemsect->id_sect'>$itemsect->nama_sect</option>";
                }
            ?>
            </select>
          </div>
          <!--Di Tag Oleh  -->
          <div class="form-group">
            <label for="tager">Ditag Oleh</label>
            <select name="tager" id="tager" class="form-control form-control-sm select2" required>
              <option value="">PILIH KARYAWAN</option>
              <?php
                foreach ($karyawan as $itemkaryawan) {
                    echo "<option value='$itemkaryawan->nik'>$itemkaryawan->nama_karyawan</option>";
                }
            ?>
            </select>
          </div>

        </div>
        <!-- /.modal-body -->

        <div class="modal-footer justify-content-between">
          <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
          <button id="simpan" type="submit" class="btn btn-sm btn-success">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- FORM MODAL EDIT -->
<div class="modal fade" id="modal-edittag">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <h5>Edit Tag</h5>
        </div>
      </div>
      <form id="form-edit" role="form" method="post" action="">
        <div class="modal-body">
          <input type="hidden"
            name="<?php echo $this->security->get_csrf_token_name(); ?>"
            value="<?php echo $this->security->get_csrf_hash(); ?>">

          <!-- DEPT PIC -->
          <input id="dept_pic_edit" type="hidden" name='dept_pic'>

          <!-- MESIN  -->
          <div class="form-group">
            <label for="id_mesin">Mesin</label>
            <select name="id_mesin" id="id_mesin_edit" class="form-control form-control-sm select2" required>
              <option value="">PILIH MESIN</option>
              <?php
                foreach ($mesin as $itemmesin) {
                    echo "<option value='$itemmesin->id_mesin'>$itemmesin->nama_mesin</option>";
                }
            ?>
            </select>
          </div>
          <!-- ID UNIT MESIN  -->
          <div class="form-group" id="data_id_unit">
            <label for="id_unit">Unit Mesin</label>
            <select name="id_unit" id="id_unit_edit" required class="form-control form-control-sm"></select>
          </div>
          <!-- Deskripsi Tag -->
          <div class="form-group">
            <label for=" deskripsi">Uraian Tag</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi_edit"></textarea>
          </div>
          <!--Seksi Tujuan  -->
          <div class="form-group">
            <label for="id_pic">Ditujukan Untuk</label>
            <select name="id_pic" id="id_pic_edit" class="form-control form-control-sm" required>
              <option value="">PILIH SEKSI TUJUAN</option>
              <?php
                foreach ($sect as $itemsect) {
                    echo "<option value='$itemsect->id_sect'>$itemsect->nama_sect</option>";
                }
            ?>
            </select>
          </div>
          <!--Di Tag Oleh  -->
          <div class="form-group">
            <label for="tager">Ditag Oleh</label>
            <select name="tager" id="tager_edit" class="form-control form-control-sm select2" required>
              <option value="">PILIH KARYAWAN</option>
              <?php
                foreach ($karyawan as $itemkaryawan) {
                    echo "<option value='$itemkaryawan->nik'>$itemkaryawan->nama_karyawan</option>";
                }
            ?>
            </select>
          </div>

        </div>
        <!-- /.modal-body -->

        <div class="modal-footer justify-content-between">
          <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
          <button id="simpan" type="submit" class="btn btn-sm btn-success">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };

  // RIWAYAT
  $('.btn-riwayat').click(function() {
    var id_tag = $(this).attr('id_tag');
    $("#riwayat").load(
      '<?=base_url('tpm2acc/acc_form/');?>' +
      id_tag);
  });

  document.title =
    "Acc Tag TPM";
  $(document).ready(function() {
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
    $("#table-tag").dataTable({
      "paging": true,
      "searh": true,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf', 'print'
      ]
    });
  });
</script>