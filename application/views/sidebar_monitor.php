 <!-- Main Sidebar Container -->
 <?php error_reporting(0);?>
 <aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-orange">
      <img src="<?= base_url();?>assets/dist/img/logo.png" alt="MMS" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MMS Online V3.0</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url();?>assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a title="Profil User" href="#"><?php if(get_cookie('mmsnamalengkap')!=null){echo get_cookie('mmsnamalengkap');}else{echo 'Pengguna Umum';}?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
           <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=base_url('monitor/qr/').$id_mesin;?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('monitor/preventive/').$id_mesin;?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Preventive
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('monitor/breakdown/').$id_mesin;?>" class="nav-link">
              <i class="nav-icon fas fa-bolt"></i>
              <p>
                Breakdown
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('monitor/tpm/').$id_mesin;?>" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Tag TPM
              </p>
            </a>
          </li>
          <?php
            if (get_cookie('mmsiduser')!="") {
                ?>
          <li class="nav-item">
            <a href="<?=base_url('logout/monitor/'.$id_mesin)?>" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <?php
            }
            ?>
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
<img id="img-spinner" src="<?=base_url('assets/dist/img/loading.gif')?>" ><br>
<h5>Sedang Memuat Data..</h5>
</div>
<!-- END LOADER -->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
                    
