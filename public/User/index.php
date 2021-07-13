<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME ?> User</title>
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

    <!-- navigasi -->
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
                User
            </h1>
        </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-xs-10">
        <div class="box">

            <div class="box-header">
              <a class="btn btn-primary btn-lg" href="<?php url("User/add/") ?>"><span class="fa fa-user-plus"></span></a><br><br>
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <br>
            <?php 
                $request = new \engine\http\Request;
                $notifikasi = $request->getNotification();
                
                if($notifikasi != ''){
            ?>
                <br><div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-info"></i> <?php echo $notifikasi; ?> </h4>
                </div><br>
            <?php } ?>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id User</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Hak Akses</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    inc('include.search');

                    $request = new \engine\http\Request();

                    // proses pencarian
                    $user = new \model\User();
                    $user->queryCustom("desc tb_".strtolower($request->get(0)))->ready();

                    $field = array();
                    $i = 0;
                    while ($row = $user->getStatement()->fetch()) {
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
                      $user->select($user->getTable())->where()
                      ->searchCharacter($column[0],$column[1])->ready();
                    }else{
                      $user->select($user->getTable())->ready();
                    }

                    $user = new \model\User();
                    $user->select($user->getTable())->ready();
                    $total = $user->getstatement()->rowCount();

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
                      $user->select($user->getTable())->where()->
                      searchCharacter($column[0],$column[1])->limit($nilaiAwal,$batas)->ready();
                    }else{
                      $user->select($user->getTable())->limit($nilaiAwal,$batas)->ready();
                    }

                    if($user->getStatement()->rowCount()){
                    while($row = $user->getStatement()->Fetch()){ 
                       ?>
                        <tr>
                          <td><?php echo $row[0] ?></td>
                          <td><?php echo $row[1] ?></td>
                          <td><?php echo $row[2] ?></td>
                          <td><?php echo $row[3] ?></td>
                          <td><?php echo $row[4] ?></td>
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
                <li class="page-item"><a href="<?php if($page <= 1){ echo"#"; }else{ url('User/page/'.--$page.'/'); } ?>" class="page-link">Sebelumnya</a></li>
                <?php
                if($request->get(2) !== ""){
                    $page = $request->get(2);
                }else{
                    $page = 1;
                }
                
                for($i=1; $i <= $totalPage;$i++){ ?>
                    <li class="page-item <?php if($page == $i){?> active <?php } ?>"><a href="<?php url('User/page/'.$i.'/') ?>" class="page-link"><?= $i ?></a></li>
                <?php } ?>

                <li class="page-item"><a href="<?php if($page >= $totalPage){ echo"#"; }else{ url('User/page/'.++$page.'/'); } ?>" class="page-link">Setelahnya</a></li>
              </ul>
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
<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<!--Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience. -->
</body>
</html>