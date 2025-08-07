<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Master Karyawan</h1>
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
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-formuser"><i class="fa fa-plus"></i>&nbsp;Tambah Karyawan</button>
                  
                    </div>
                    </div>
                    <div class="card-body">
                    <table id="tabel-user" class="table  table-striped">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Departmen</th>
                    <th>Section</th>
                    <th>Edit</th>
                    <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=0;
                      foreach($karyawan as $item)
                      {
                        $no++;
                        if($item->aktif=="N")
                        {$kelas="table-danger";
                          $tombol ="<a onclick=\"javascript: return confirm('yakin mengaktifkan $item->nama_karyawan ?');\" href='".base_url('masterkaryawan/aktif/').$item->nik."'><button class='btn btn-success btn-xs'>Aktifkan</button></a>";
                        }
                          else
                        {
                          $kelas="";
                          $tombol ="<a onclick=\"javascript: return confirm('yakin menonaktifkan $item->nama_karyawan ?');\" href='".base_url('masterkaryawan/nonaktif/').$item->nik."'><button class='btn btn-danger btn-xs'>Non Aktifkan</button></a>";
                        }
                        echo"
                        <tr class='$kelas'>
                        <td>$no</td>
                        <td>$item->nik</td>
                        <td>$item->nama_karyawan</td>
                        <td>$item->nama_dept</td>
                        <td>$item->nama_sect</td>
                        <td><button class='btn btn-xs btn-primary editkaryawan' nik='$item->nik'>Edit</button></td>
                        
                        <td>$tombol</td>
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
     <!-- CONTAINER FLUID --> 
      </div>
    <!-- CONTENT -->
    </div>
<!-- CONTENT WRAPPER -->
</div>
<div class="modal fade" id="modal-formuser">
<div class="modal-dialog ">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Tambah Karyawan Baru</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterkaryawan/insert/')?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="nik">NIK </label>
                    <input onkeypress='return HanyaAngka(event, false)' type="text" name="nik" id="nik" class="form-control form-control-sm" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="nama_karyawan">Nama Lengkap</label>
                    <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control form-control-sm" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="id_sect">Departmen</label>
                    <select id="id_dept" name="id_dept" class="form-control form-control-sm" required>
                    <option value="">Pilih Departmen</option>
                    <?php
                    foreach ($dept as $itemdept) {
                      echo"
                      <option value='$itemdept->id_dept'>$itemdept->nama_dept</option>
                      ";
                    }
                    ?>
                    </select>
                  </div>

                  <div class="form-group" id="select_sect">
                    <label for="id_sect">Section</label>
                    <select id="id_sect" name="id_sect" class="form-control form-control-sm" required>
                    </select>
                  </div>

                  
                 
                </div>
                <!-- /.modal-body -->

                <div class="modal-footer justify-content-between">
                  <button  type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                  <button id="simpan" type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
              </form>
</div>
</div>
</div>
<div id="form_edit"></div>
<script>
var csrf = {
    data: 'data',
    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
  };
  $(document).ready(function()
  {
    $('#select_sect').hide();
    document.title='MMS V3.0 - Daftar Akun';
    // BUAT TAMPILIN SWEAT ALERT 
    <?=$this->session->userdata("swal");$this->session->unset_userdata("swal");?>
    // BUAT DATA TABLE
    $("#tabel-user").DataTable( {
        "info": false,
        "paging": true,
        "searching": true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );
  });
// EDIT DATA
$('.editkaryawan').click(function()
{
  var nik = $(this).attr('nik');
  $("#form_edit").load('<?=base_url('masterkaryawan/edit_form/');?>'+nik); 
})
$("#nama_karyawan").keyup(function (e) { 
  $(this).val($(this).val().toUpperCase());

});

//dept di klik
$('#id_dept').change(function()
{
$('#select_sect').show();
var id_dept = $(this).val();
$('#id_sect').empty();
$('#id_sect').append('<option value="">Pilih Section</option>');
$.ajax({
        type: "POST",
        url: "<?php echo base_url('mastersect/readbydept/'); ?>" + id_dept,
        data: csrf,
        cache: false,
        success: function(hasil) {
          sect = jQuery.parseJSON(hasil);
          console.log(sect);
          $.each(sect, function(i, item) {
            $('#id_sect').append('<option value="'+sect[i].id_sect+'">'+sect[i].nama_sect+'</option>');
          }); 
        }
      });
    });
$("#nama_karyawan").keyup(function (e) { 
      $(this).val($(this).val().toUppperCase());
});
</script>