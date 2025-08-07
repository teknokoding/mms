<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon"
    href="<?= base_url();?>assets/dist/img/mms.png">
  <title>MMS V3.0</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/dist/css/adminlte.css">
  <!-- Loader -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/dist/css/loader.css">
  <!-- Animasi -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/dist/css/animate.min.css">
  <!-- Select2 -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Daterange[icker] -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- Data Table Button -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/datatables/buttons.dataTables.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <!-- DataTables -->
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet"
    href="<?= base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js"></script>
  <script>
    function hideLoader() {
      //$("#modal-loader").removeClass("in");
      $(".modal-backdrop").remove();
      $("#modal-loader").hide();
    }

    function showLoader() {
      $("#modal-loader").show();
      $("#modal-loader").modal({
        backdrop: 'static',
        keyboard: false
      });
    }
  </script>
  <style type="text/css">
    .spinner {
      position: ;
      margin-left: 0px;
      margin-right: 0px;
      text-align: center;
      overflow: auto;
      padding: 10px 10px 10px 10px;
    }

    #img-spinner {
      width: 400px;
      height: 300px;
    }
  </style>
</head>

<body class="hold-transition layout-fixed text-sm">

  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-purple">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-sm-inline-block">
          <a href="#" class="nav-link"><?=$this->session->userdata('judul');?></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <?php if ($this->session->userdata('id_level')<4) {?>
        <li class="nav-item">
          <a title="Pilih Sesi" class="judul nav-link"
            href="<?=base_url('sesi/exchange')?>"
            role="button"><i class="fas fa-universal-access"></i></a>
        </li>
        <?php }?>

      </ul>
    </nav>
    <!-- /.navbar -->
    <audio id="ChatAudio"
      src="<?php echo base_url('assets/dist/audio/') ?>notif.mp3">
      Your browser does not support the audio element.
    </audio>
    <audio id="LogoutAudio"
      src="<?php echo base_url('assets/dist/audio/') ?>logout.mp3">
      Your browser does not support the audio element.
    </audio>
    <script>
      $(document).ready(function() {
        $(".judul").tooltip();
      })
    </script>