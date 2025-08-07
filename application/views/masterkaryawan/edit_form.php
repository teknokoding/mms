<?php
foreach ($karyawanedit as $itemedit) {
}
?>
<div class="modal fade" id="modal-edit">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Edit Karyawan</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterkaryawan/update/').$itemedit->nik;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="nik">NIK </label>
                    <input onkeypress='return HanyaAngka(event, false)' value="<?=$itemedit->nik;?>" onclick="javascript:HanyaAngka();" type="text" name="nik" id="nik" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group">
                    <label for="nama_karyawan">Nama Lengkap</label>
                    <input value="<?=$itemedit->nama_karyawan;?>" type="text" name="nama_karyawan" id="nama_karyawan_edit" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group">
                    <label for="id_sect">Departmen</label>
                    <select id="id_dept_edit" name="id_dept" class="form-control form-control-sm" required>
                     <?php
                    foreach ($dept as $itemdept) {
                      $itemedit->id_dept==$itemdept->id_dept?$pilih="selected":$pilih="";
                      echo"
                      <option value='$itemdept->id_dept', $pilih>$itemdept->nama_dept</option>
                      ";
                    }
                    ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="id_sect">Section</label>
                    <select id="id_sect_edit" name="id_sect" class="form-control form-control-sm" required>
                    <?php
                      foreach ($sect as $itemsect) {
                        $itemedit->id_sect==$itemsect->id_sect?$pilih="selected":$pilih="";
                        echo"
                        <option value='$itemsect->id_sect', $pilih>$itemsect->nama_sect</option>
                        ";
                      }
                    ?>
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
<script>
$(document).ready(function () {
  $("#nama_karyawan").keyup(function (e) { 
  $(this).val($(this).val().toUpperCase());});
  //dept di klik
$('#id_dept_edit').change(function()
{
var id_dept = $(this).val();
$('#id_sect_edit').empty();
$('#id_sect_edit').append('<option value="">Pilih Section</option>');
$.ajax({
        type: "POST",
        url: "<?php echo base_url('mastersect/readbydept/'); ?>" + id_dept,
        data: csrf,
        cache: false,
        success: function(hasil) {
          sect = jQuery.parseJSON(hasil);
          console.log(sect);
          $.each(sect, function(i, item) {
            $('#id_sect_edit').append('<option value="'+sect[i].id_sect+'">'+sect[i].nama_sect+'</option>');
          }); 
        }
      });
    });
});
$('#modal-edit').modal('show');
$(".judul").tooltip();
$("#nama_karyawan_edit").keyup(function (e) { 
  $(this).val($(this).val().toUpperCase());

});
</script>