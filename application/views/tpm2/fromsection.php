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
          <div class="card-shadow-primary border mb-3 card card-body border-primary">

            <div class="card-header">
              <div class="card-tool row">
                <label for="id_mesin" class="col-lg-2 label">Filter Mesin</label>
                <div class="col-lg-4">
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
                <div class="col-lg-6">
                  <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modal-formtag"><i
                      class="fa fa-plus-circle"></i>&nbsp;Buat Tag Baru</button>
                </div>

              </div>
            </div>
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
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
                    foreach ($tpm as $item) {
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
                    <td><div class='input-group-prepend'>
                    <button type='button' class='btn btn-block btn-secondary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                      Aksi
                    </button>
                    <div class='dropdown-menu'>
                    <a href='javascript:void(0);' class='dropdown-item btn-riwayat' id_tag='$item->id_tag'><i class='far fa-clock'></i>&nbsp;Riwayat</a>
                    <a href='javascript:void(0);' class='dropdown-item btn-edit' id_tag='$item->id_tag'><i class='far fa-edit'></i>&nbsp;Edit</a>
                    <a onclick='javascript: return confirm(\"yakin menghapus TAG ini?\");' class='dropdown-item' href='".base_url('tpm2fromsection/delete/').$item->id_tag."'><i class='far fa-trash-alt'></i>&nbsp;&nbsp;Hapus</a>
                    </div>
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
  $(document).ready(function() {
    $("#data_id_unit").hide();
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
    // PILIH UNIT DARI MESIN
    $('#id_mesin_input').change(function() {
      $('#data_id_unit').show();
      var id_mesin = $(this).val();
      $('#id_unit').empty();
      $('#id_unit').append('<option value="">Pilih Unit</option>');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('unitmesin/readbymesin/'); ?>" +
          id_mesin,
        data: csrf,
        cache: false,
        success: function(hasil) {
          unitmesin = jQuery.parseJSON(hasil);
          console.log(unitmesin);
          $.each(unitmesin, function(i, item) {
            $('#id_unit').append('<option value="' + unitmesin[i].id_unitmesin + '">' +
              unitmesin[i].nama_unitmesin + '<td></td></option>');
          });
        }
      });
      $.ajax({
        type: "POST",
        url: '<?=base_url('tpm/set_mesin/ALL');?>',
        data: csrf,
        cache: false,

      });
    });

    // PILIH UNIT DARI MESIN EDIT
    $('#id_mesin_edit').change(function() {
      var id_mesin = $(this).val();
      $('#id_unit_edit').empty();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('unitmesin/readbymesin/'); ?>" +
          id_mesin,
        data: csrf,
        cache: false,
        success: function(hasil) {
          unitmesin = jQuery.parseJSON(hasil);
          console.log(unitmesin);
          $.each(unitmesin, function(i, item) {
            $('#id_unit_edit').append('<option value="' + unitmesin[i].id_unitmesin + '">' +
              unitmesin[i].nama_unitmesin + '<td></td></option>');
          });
        }
      });
      $.ajax({
        type: "POST",
        url: '<?=base_url('tpm/set_mesin/ALL');?>',
        data: csrf,
        cache: false,

      });
    });

    /// PILIH SEKSI PIC DAN TENTUKAN DEPT PIC
    $("#id_pic").change(function(e) {
      e.preventDefault();
      var id_sect = $(this).val();
      $.getJSON(
        "<?=base_url('tpm2fromsection/readdeptbysect/')?>" +
        id_sect, csrf,
        function(data, textStatus, jqXHR) {
          $.each(data, function(i, item) {
            $("#dept_pic").val(data[i].id_dept);
          });
        }
      );

    });

    /// PILIH SEKSI PIC EDIT DAN TENTUKAN DEPT PIC
    $("#id_pic_edit").change(function(e) {
      e.preventDefault();
      var id_sect = $(this).val();
      $.getJSON(
        "<?=base_url('tpm2fromsection/readdeptbysect/')?>" +
        id_sect, csrf,
        function(data, textStatus, jqXHR) {
          $.each(data, function(i, item) {
            $("#dept_pic_edit").val(data[i].id_dept);
          });
        }
      );

    });

  });
  // RIWAYAT
  $('.btn-riwayat').click(function() {
    var id_tag = $(this).attr('id_tag');
    $("#riwayat").load(
      '<?=base_url('tpm/riwayat2/');?>' + id_tag);
  })
  // RELEASE
  $('.btn-release').click(function() {
    var id_tag = $(this).attr('id_tag');
    $("#release").load(
      '<?=base_url('tpm/release/');?>' + id_tag);
  })
  // EDIT FORM
  $(".btn-edit").click(function(e) {
    e.preventDefault();
    var id_tag = $(this).attr('id_tag');
    $.getJSON(
      "<?=base_url('tpm2fromsection/readdetail/');?>" +
      id_tag, csrf,
      function(data, textStatus, jqXHR) {
        $.each(data, function(i, item) {
          $("#dept_pic_edit").val(data[i].dept_pic);
          $("#id_mesin_edit").val(data[i].id_mesin);
          $("#id_mesin_edit").trigger('change');
          $("#deskripsi_edit").val(data[i].deskripsi);
          $("#id_pic_edit").val(data[i].id_pic);
          $("#tager_edit").val(data[i].tager);
          $("#tager_edit").trigger('change');
          $("#form-edit").attr("action",
            "<?=base_url('tpm2fromsection/update/')?>" +
            id_tag);
          $.getJSON(
            "<?php echo base_url('unitmesin/readbymesin/'); ?>" +
            data[i].id_mesin, csrf,
            function(unit, textStatus, jqXHR) {
              $.each(unit, function(a, itemmesin) {
                if (unit[a].id_unitmesin == data[i].id_unit) {
                  var pilih = 'selected';
                } else {
                  var pilih = '';
                }
                $("#id_unit_edit").append('<option value="' + unit[a].id_unitmesin + '", ' + pilih +
                  '>' +
                  unit[a]
                  .nama_unitmesin + '</option>');
              });
            }
          );
        });
      }
    );
    $("#modal-edittag").modal('show');
  });
  document.title =
    "Tag TPM <?php if ($this->session->userdata('id_mesin')=="ALL") {
                $mesinnya="SEMUA MESIN";
            } else {
                $mesinnya=$item->nama_mesin;
            } echo $mesinnya;?>";
</script>