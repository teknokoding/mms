<?php
foreach ($akunedit as $itemedit) {
}
?>
<div class="modal fade" id="modal-edit">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<div class="modal-title">
<h5>Edit Akun</h5>
</div>
</div>
<form role="form" method="post" action="<?=base_url('masterakun/update/').$itemedit->iduser;?>">
                <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="form-group">
                    <label for="username">NIK / Username</label>
                    <input onkeypress='return HanyaAngka(event, false)' value="<?=$itemedit->username;?>" onclick="javascript:HanyaAngka();" type="text" name="username" id="username" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group">
                    <label for="namalengkap">Nama Lengkap</label>
                    <input value="<?=$itemedit->namalengkap;?>" type="text" name="namalengkap" id="namalengkap_edit" class="form-control form-control-sm" required>
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

                  <div class="form-group">
                    <label for="id_sect">Level</label>
                    <select name="id_level" class="form-control form-control-sm" required><option value="">Pilih Level</option>
                    <?php
                    foreach ($level as $itemlevel) {
                      $itemedit->id_level==$itemlevel->id_level?$pilih="selected":$pilih="";
                      echo"
                      <option value='$itemlevel->id_level', $pilih>$itemlevel->nama_level</option>
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
  $("#namalengkap").keyup(function (e) { 
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
$("#nama_akun_edit").keyup(function (e) { 
  $(this).val($(this).val().toUpperCase());

});
</script>