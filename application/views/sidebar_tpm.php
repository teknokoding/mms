 <!-- Main Sidebar Container -->
 <?php error_reporting(0);?>
 <aside class="main-sidebar elevation-4 sidebar-dark-indigo">
   <!-- Brand Logo -->
   <a href="#" class="brand-link navbar-indigo">
     <img src="<?= base_url();?>assets/dist/img/logo.png" alt="MMS"
       class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">MMS Online V3.0</span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="<?= base_url();?>assets/dist/img/avatar5.png"
           class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a title="Profil User"
           href="<?=base_url('profil')?>"
           class="d-block judul"><?= $this->session->userdata('namalengkap');?></a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <?php
      $id_level = $this->session->userdata('id_level');
      // PERHATIKAN, KLO APP ADA DI ROOT MAKA PAKE ARRAY KE-0. KALO APP MASUK KE SUB FOLDER ROOT MAKA URI PAKE ARRAY KE-2
      $uri = uri_string();
      $uri = explode('/', $uri);
      $uri = $uri[0];
      if (empty($uri)) {
          $uri = 'login';
      }
      $this->db->order_by('Urutan', 'ASC');
      $this->db->like('Level', $id_level);
      $menu = $this->db->get('sidebar_tpm')->result_array();
      $query = $this->db->query("SELECT parent FROM sidebar_tpm WHERE controller='$uri' LIMIT 1");
      $row = $query->row();
      $parentcontroller = $row->parent;
      foreach ($menu as $itemmenu) {
          $parent = $itemmenu['Parent'];
          $controller = $itemmenu['Controller'];
          if ($uri == $parent || $parent == $parentcontroller) {
              $aktif = 'active';
              $open = 'menu-open';//kasih nilai menu-open buat otomatis open menu
          } else {
              $aktif = '';
              $open ='';
          } // UNTUK MENU PARENT
          $where = array('Parent' => $parent, 'Icon' => '' ,'Level LIKE' => '%' . $id_level . '%');
          $child = $this->db->get_where('sidebar_tpm', $where)->num_rows();
          if ($child == 0) {
              echo'
          <li class="nav-item">
            <a href="' . base_url() . $itemmenu['Controller'] . '" class="nav-link '.$aktif.'">
            <i class="nav-icon fas ' . $itemmenu['Icon'] . '"></i>
              <p>
              ' . $itemmenu['NamaMenu'] . '
              </p>
            </a>
          </li>
          ';
          } elseif ($itemmenu['Icon'] != '') {
              echo '
          <li class="nav-item has-treeview '.$open.'">
          <a href="#" class="nav-link '.$aktif.'">
            <i class="nav-icon fas ' . $itemmenu['Icon'] . '"></i>
            <p>
            ' . $itemmenu['NamaMenu'] . '
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          ';
              $wherechild = array('Parent' => $parent, 'Icon' => '', 'Level LIKE' => '%' . $id_level . '%');
              $this->db->order_by('Urutan', 'ASC');
              $submenu = $this->db->get_where('sidebar_tpm', $wherechild)->result_array();
              foreach ($submenu as $itemsubmenu) {
                  if ($uri == $itemsubmenu['Controller']) {
                      $aktifsub = 'active'; //untuk aktifkan sub menu
                  } else {
                      $aktifsub = '';
                  }
                  echo '
            <li class="nav-item">
              <a href="' . base_url() . $itemsubmenu['Controller'] . '" class="nav-link ' . $aktifsub . '">
                
                <p>' . $itemsubmenu['NamaMenu'] . '</p>
              </a>
            </li>';
              }
              echo'
          </ul>
        </li>
          ';
          }
      }
      ?>
         <li class="nav-item">
           <a onclick="PlayLogout();" href="#" data-toggle="modal" data-target="#modal-logout" class="nav-link">
             <i class="nav-icon fas fa-power-off"></i>
             <p>
               Logout
             </p>
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>
 <div class="modal fade show" id="modal-loader" aria-modal="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-body">
         <!--- LOADER --->
         <div class="spinner">
           <img id="img-spinner"
             src="<?=base_url('assets/dist/img/loading.gif')?>"><br>
           <h5>Sedang Memuat Data..</h5>
         </div>
         <!-- END LOADER -->
       </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>