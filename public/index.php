<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME ?> Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <?php inc("include/includeCSS") ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <?php inc("include/logo") ?>

    <?php inc("include/navigation") ?>
    
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php inc("include/sidebar") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo $id['halaman'] ?></a></li>
        <li class="active"><?php echo $id['halamanAktif'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div class="row">
        <?php inc('include.list-box') ?>

        <?php 

        switch ($_SESSION['hak_akses']) {
          case 'A':
            $pasien = new \model\Pasien();
            $pasien->select($pasien->getTable())->ready();
            listBox("aqua",'Pasien',$pasien->getStatement()->rowCount(),'users','Pasien/');

            $dokter = new \model\Dokter();
            $dokter->select($pasien->getTable())->ready();
            listBox("green",'Dokter',$dokter->getStatement()->rowCount(),'user-md','Dokter/'); 
            
            $resepsionis = new \model\Resepsionis();
            $resepsionis->select($resepsionis->getTable())->ready();
            listBox("red",'Resepsionis',$resepsionis->getStatement()->rowCount(),'user','Resepsionis/');

            $pemeriksaan = new \model\Pemeriksaan();
            $pemeriksaan->select($pemeriksaan->getTable())->ready();
            listBox("yellow",'Pemeriksaan',$pemeriksaan->getStatement()->rowCount(),'stethoscope','Pemeriksaan/');

            $user = new \model\User();
            $user->select($user->getTable())->ready();
            listBox("blue",'User',$user->getStatement()->rowCount(),'user','User/');

            $pendaftaran = new \model\Pendaftaran();
            $pendaftaran->select($pendaftaran->getTable())->ready();
            listBox("purple",'Pendaftaran',$pendaftaran->getStatement()->rowCount(),'user','Pendaftaran/');

            break;
          case 'R':
            $pasien = new \model\Pasien();
            $pasien->select($pasien->getTable())->ready();
            listBox("aqua",'Pasien',$pasien->getStatement()->rowCount(),'users','Pasien/');

            $dokter = new \model\Dokter();
            $dokter->select($pasien->getTable())->ready();
            listBox("green",'Dokter',$dokter->getStatement()->rowCount(),'user-md','Dokter/'); 
            
            $resepsionis = new \model\Resepsionis();
            $resepsionis->select($resepsionis->getTable())->ready();
            listBox("red",'Resepsionis',$resepsionis->getStatement()->rowCount(),'user','Resepsionis/');

            $pemeriksaan = new \model\Pemeriksaan();
            $pemeriksaan->select($pemeriksaan->getTable())->ready();
            listBox("yellow",'Pemeriksaan',$pemeriksaan->getStatement()->rowCount(),'stethoscope','Pemeriksaan/');

            $pendaftaran = new \model\Pendaftaran();
            $pendaftaran->select($pendaftaran->getTable())->ready();
            listBox("purple",'Pendaftaran',$pendaftaran->getStatement()->rowCount(),'user','Pendaftaran/');
            break;
          case 'D':
            $pemeriksaan = new \model\Pemeriksaan();
            $pemeriksaan->select($pemeriksaan->getTable())->ready();
            listBox("yellow",'Pemeriksaan',$pemeriksaan->getStatement()->rowCount(),'stethoscope','Pemeriksaan/');
            break;
          default:
            
            break;
        }

        ?>
    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <?php inc("include.control-sidebar") ?>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<?php  inc("include/includeJS") ?>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>