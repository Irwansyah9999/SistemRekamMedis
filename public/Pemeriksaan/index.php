<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME ?> Pemeriksaan</title>
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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <?php inc("include.logo") ?>

    <!-- Navigasi -->
    <?php inc("include/navigation") ?>
    
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php inc("include/sidebar") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class ="row">
        <div class="col-md-4">
            <h1>
                Pemeriksaan
                <small>Optional description</small>
            </h1>
        </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-xs-10">
        <div class="box">

            <div class="box-header">
            <a class="btn btn-success btn-lg" href="<?php url("Pemeriksaan/report/") ?>"><span class="fa fa-print"></span></a><br><br>
              <h3 class="box-title">Data Pemeriksaan</h3>
            </div>
            <!-- /.box-header -->
            <br>
            <?php 
                $request = new \engine\http\Request;
                $notifikasi = $request->getNotification();
                
                if($notifikasi != ''){
            ?>
                <br><div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> <?php echo $notifikasi; ?> </h4>
                </div><br>
            <?php } ?>
            <div class="box-body">
              <?php 
              if($_SESSION['hak_akses'] == 'A' || $_SESSION['hak_akses'] == 'R'){ ?>
                <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id Pemeriksaan</th>
                    <th>Tanggal_pemeriksaan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Id Pasien</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    inc('include.search');

                    $request = new \engine\http\Request();

                    // proses pencarian
                    $pemeriksaan = new \model\Pemeriksaan();
                    $pemeriksaan->queryCustom("desc tb_".strtolower($request->get(0)))->ready();

                    $field = array();
                    $i = 0;
                    while ($row = $pemeriksaan->getStatement()->fetch()) {
                      $field[$i++] =  $row[0];
                    }

                    $search = new Search();
                    $search->setField($field);
                    $search->setDelimiter(':');
                    // jadi bentuk search yang diinput menjadi nama_kolom:nilai_kolom

                    // set paging
                    $page = 1;

                    $no = 1;
                    $batas = 5;

                    $nilaiAwal = 0;

                    if($column = $search->matchingColumn($request->getValue('q'))){
                      $pemeriksaan->select($pemeriksaan->getTable())->where()
                      ->searchCharacter($column[0],$column[1])->ready();
                    }else{
                      $pemeriksaan->select($pemeriksaan->getTable())->ready();
                    }

                    $pemeriksaan->select($pemeriksaan->getTable())->ready();
                    $total = $pemeriksaan->getstatement()->rowCount();

                    $totalPage = ceil($total / $batas);

                    if($request->get(2) !== ""){
                      $page = $request->get(2);
                      $nilaiAwal = ($page - 1)  * $batas;
                      $no = $nilaiAwal+1;
                    }else{
                      $page = 0;
                      $nilaiAwal = 0;
                      $no = 1;
                    }

                    if($column = $search->matchingColumn($request->getValue('q'))){
                      $pemeriksaan->select($pemeriksaan->getTable())->where()->
                      searchCharacter($column[0],$column[1])->limit($nilaiAwal,$batas)->ready();
                    }else{
                      $pemeriksaan->select($pemeriksaan->getTable())->limit($nilaiAwal,$batas)->ready();
                    }

                    if($pemeriksaan->getStatement()->rowCount()){
                    while($row = $pemeriksaan->getStatement()->Fetch()){ 
                    ?>
                      <tr>
                        <td><?php echo $row['id_pemeriksaan'] ?></td>
                        <td><?php echo $row['tanggal_pemeriksaan'] ?></td>
                        <td><?php echo $row['keterangan'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td>
                        <?php 
                        $pasien = new \model\Pasien();
                        $pasien->select($pasien->getTable())->where()->comparing('id_pasien',$row['id_pasien'])->ready();
                        $rowPasien = $pasien->getStatement()->fetch();

                        echo $row['id_pasien'].' - '.$rowPasien[1] ?></td>

                        <td><a href="<?php url('Pemeriksaan-detail/'.$row['id_pemeriksaan'].'/') ?>" class="btn btn-success">Cek Detail</a></td>
                      </tr> 
                      <?php
                      }
                    }else{
                      echo "<td>No data</td>";
                    }
                      ?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>

              <small> <?= $page ?> of <?= $totalPage ?></small>

              <ul class="pagination">
                <li class="page-item"><a href="<?php if($page <= 1){ echo"#"; }else{ if($request->getValue('q')){ url('Pemeriksaan/page/'.--$page.'/?q='.$request->getValue('q')); }else{ url('Pemeriksaan/page/'.--$page.'/'); } /* end request*/ } /* end page*/ ?>" class="page-link">Sebelumnya</a></li>
                <?php
                if($request->get(2) !== ""){
                    $page = $request->get(2);
                }else{
                    $page = 1;
                }
                
                for($i=1; $i <= $totalPage;$i++){ ?>
                    <li class="page-item <?php if($page == $i){?> active <?php } ?>"><a href="<?php if($request->getValue('q')){ url('Pemeriksaan/page/'.$i.'/?q='.$request->getValue('q')); }else{ url('Pemeriksaan/page/'.$i.'/'); } /* end request*/ ?>" class="page-link"><?= $i ?></a></li>
                <?php } ?>

                <li class="page-item"><a href="<?php if($page >= $totalPage){ echo"#"; }else{ if($request->getValue('q')){ url('Pemeriksaan/page/'.++$page.'/?q='.$request->getValue('q')); }else{ url('Pemeriksaan/page/'.++$page.'/'); } /* end request*/ } ?>" class="page-link">Setelahnya</a></li>
              </ul>
              <?php }
              // session sama dengan D
              else if($_SESSION['hak_akses'] == 'D'){ ?>
                <br>
            <?php 
                $request = new \engine\http\Request;
                $notifikasi = $request->getNotification();
                
                if($notifikasi != ''){
            ?>
                <br><div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> <?php echo $notifikasi; ?> </h4>
                </div><br>
            <?php } ?>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id Pemeriksaan detail</th>
                    <th>Id Pemeriksaan</th>
                    <th>Id Pasien</th>
                    <th>Tanggal_pemeriksaan</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Status</th>
                    <th>Id dokter</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    inc('include.search');

                    $request = new \engine\http\Request();

                    // proses pencarian
                    $pemeriksaan = new \model\PemeriksaanDetail();
                    $pemeriksaan->queryCustom("desc tb_pemeriksaan_detail")->ready();

                    $field = array();
                    $i = 0;
                    while ($row = $pemeriksaan->getStatement()->fetch()) {
                      $field[$i++] =  $row[0];
                    }

                    $search = new Search();
                    $search->setField($field);
                    $search->setDelimiter(':');
                    // jadi bentuk search yang diinput menjadi nama_kolom:nilai_kolom

                    // set paging
                    $page = 1;

                    $no = 1;
                    $batas = 5;

                    $nilaiAwal = 0;

                    if($column = $search->matchingColumn($request->getValue('q'))){
                      $pemeriksaan->select($pemeriksaan->getTable())->where()
                      ->searchCharacter($column[0],$column[1])->ready();
                    }else{
                      $pemeriksaan->select($pemeriksaan->getTable())->ready();
                    }

                    $pemeriksaan->select($pemeriksaan->getTable())->ready();
                    $total = $pemeriksaan->getstatement()->rowCount();

                    $totalPage = ceil($total / $batas);

                    if($request->get(2) !== ""){
                        $page = $request->get(2);
                        $nilaiAwal = ($page - 1)  * $batas;
                        $no = $nilaiAwal+1;
                    }else{
                      $page = 0;
                      $nilaiAwal = 0;
                      $no = 1;
                    }

                    if($column = $search->matchingColumn($request->getValue('q'))){
                      $pemeriksaan->select($pemeriksaan->getTable())->where()->
                      searchCharacter($column[0],$column[1])->where()->comparing("id_dokter",$_SESSION['id_user'])->limit($nilaiAwal,$batas)->ready();
                    }else{
                      $pemeriksaan->select($pemeriksaan->getTable())->where()->comparing("id_dokter",$_SESSION['id_user'])->limit($nilaiAwal,$batas)->ready();
                    }

                    if($pemeriksaan->getStatement()->rowCount()){
                    while($row = $pemeriksaan->getStatement()->Fetch()){ 
                    ?>
                      <tr>
                        <td><?php echo $row['id_pemeriksaan_detail'] ?></td>
                        <td><?php
                        $periksa = new \model\Pemeriksaan();
                        $periksa->select($periksa->getTable())->where()->comparing('id_pemeriksaan',$row['id_pemeriksaan'])->ready();
                        $rowPeriksa = $periksa->getStatement()->fetch();

                        $pasien = new \model\Pasien();
                        $pasien->select($pasien->getTable())->where()->comparing('id_pasien',$rowPeriksa['id_pasien'])->ready();
                        $rowPasien = $pasien->getStatement()->fetch();

                        echo $row['id_pemeriksaan']; ?></td>
                        <td><?php echo $rowPeriksa['id_pasien'].'-'.$rowPasien['nama_pasien'] ?></td>
                        <td><?php echo $row['tanggal_pemeriksaan_detail'] ?></td>
                        <td><?php echo $row['keluhan'] ?></td>
                        <td><?php echo $row['diagnosa'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td>
                        
                        <?php 
                        $dokter = new \model\Dokter();
                        $dokter->select($dokter->getTable())->where()->comparing('id_dokter',$row['id_dokter'])->ready();
                        $rowPasien = $pasien->getStatement()->fetch();

                        echo $row['id_dokter'].' - '.$rowPasien[1] ?></td>

                        <td><a class="btn btn-warning" href="<?php url('Pemeriksaan/update/'.$row['id_pemeriksaan'].'/') ?>">Update</a></td>
                      </tr> 
                      <?php
                      }
                    }else{
                      echo "<td>No data</td>";
                    }
                      ?>
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>

              <small> <?= $page ?> of <?= $totalPage ?></small>

              <ul class="pagination">
                <li class="page-item"><a href="<?php if($page <= 1){ echo"#"; }else{ url('Pemeriksaan/page/'.--$page.'/'); } ?>" class="page-link">Sebelumnya</a></li>
                <?php
                if($request->get(2) !== ""){
                    $page = $request->get(2);
                }else{
                    $page = 1;
                }
                
                for($i=1; $i <= $totalPage;$i++){ ?>
                    <li class="page-item <?php if($page == $i){?> active <?php } ?>"><a href="<?php url('Pemeriksaan/page/'.$i.'/') ?>" class="page-link"><?= $i ?></a></li>
                <?php } ?>

                <li class="page-item"><a href="<?php if($page >= $totalPage){ echo"#"; }else{ url('Pemeriksaan/page/'.++$page.'/'); } ?>" class="page-link">Setelahnya</a></li>
              </ul>
              <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- row -->
      </div>
    </section>


      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

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
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <?php inc("include/control-sidebar") ?>

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