 <!-- summernote -->
 <link rel="stylesheet"
   href="<?=base_url('assets/')?>plugins/summernote/summernote-bs4.css">
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark"> SGA - Horenso</h1>
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
                 <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-sga"><i
                     class="fa fa-plus"></i>&nbsp;Buat Dokumen </button>

               </div>
             </div>
             <div class="card-body">
               <table id="tabel-mesin" class="table  table-striped">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th>Jenis</th>
                     <th>Tanggal</th>
                     <th>Waktu</th>
                     <th>Topik</th>
                     <th>Uraian</th>
                     <th>Peserta</th>
                     <th>Edit</th>
                     <th>Hapus</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    $no=0;
                      foreach ($sga as $item) {
                          $no++;
                          echo"
                        <tr>
                        <td>$no</td>
                        <td>$item->jenis_dok</td>
                        <td>$item->tgl_dok</td>
                        <td>$item->jam_mulai<br>$item->jam_selesai</td>
                        <td>$item->topik</td>
                        <td>$item->uraian</td>
                        <td><button class='btn btn-xs btn-default'>Peserta</button></td>
                        <td><button class='btn btn-xs btn-primary editmesin' id_mesin='$item->id_dok'>Edit</button></td>
                        <td><a onclick=\"javascript: return confirm('yakin menghapus $item->id_dok ?');\" href='".base_url('mastermesin/hapus/').$item->id_dok."'><button class='btn btn-danger btn-xs'>Hapus</button></a></td>
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
 <div class="modal fade show" id="modal-sga" aria-modal="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">SGA / Horenso</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
           <div class="col-md-12">

             <div class="card-body pad">
               <div class="mb-3">
                 <textarea class="textarea" placeholder=""
                   style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
               </div>
             </div>
           </div>
           <!-- /.col-->
         </div>
         <!-- ./row -->
       </div>
       <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary">Save changes</button>
       </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 <div id="form_edit"></div>
 <script
   src="<?=base_url('assets/');?>/plugins/summernote/summernote-bs4.min.js">
 </script>
 <script>
   var csrf = {
     data: 'data',
     '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
   };
   // EDIT DATA
   $('.editmesin').click(function() {
     var id_mesin = $(this).attr('id_mesin');
     $("#form_edit").load(
       '<?=base_url('mastermesin/edit_form/');?>' +
       id_mesin);
   })
   $("#nama_mesin").keyup(function(e) {
     $(this).val($(this).val().toUpperCase());

   });

   $(function() {
     // Summernote
     $('.textarea').summernote()
   })
 </script>