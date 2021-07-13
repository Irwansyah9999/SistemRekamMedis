<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME ?>Resepsionis</title>
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
      <h1>
        Resepsionis
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <div class="col-xs-10">
      <div class="box">
        <div class="box-header">
            <h3>Perbarui Data</h3>
        </div>

        <br>

        <?php 
            $request = new \engine\http\Request;
            $id_resepsionis = $request->get(2);


            $resepsionis = new \model\Resepsionis();
            $resepsionis->select($resepsionis->getTable())->where()->comparing("nip",$id_resepsionis)->ready();

            $row = $resepsionis->getStatement()->fetch();

            $user = new \model\User();
            $user->select($user->getTable())->where()->comparing("username",$row['email'])->ready();
            $rowUser = $user->getStatement()->fetch();

            $notifikasi = $request->getNotification();
            
            if($notifikasi != ''){
        ?>
            <br><div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> <?php echo $notifikasi; ?> </h4>
            </div><br>
        <?php } ?>

        <form action="<?php url("updateResepsionis/") ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="idResepsionis">Id Resepsionis</label>
                    <input type="text" class="form-control" id="idResepsionis" placeholder="Masukan id" name="nip" value="<?php echo $row['nip'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="namaResepsionis">Nama Resepsionis</label>
                    <input type="text" class="form-control" id="namaResepsionis" name="nama_resepsionis" placeholder="Masukan nama" value="<?php echo $row['nama_resepsionis'] ?>">
                </div>
                <div class="form-group">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir'] ?>">
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="text" class="form-control" id="Email" name="email" placeholder="masukan email" value="<?php echo $row['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="noTelepon">No Telepon</label>
                    <input type="text" class="form-control" id="noTelepon" placeholder="Masukan nomor telepon" name="no_telepon" value="<?php echo $row['no_telepon'] ?>">
                </div>

                <div class="form-group <?php if($_SESSION['id_user'] != $row[0]){ ?> hide <?php } ?>">
                  <label for="noTelepon">Password</label>
                  <input type="text" class="form-control" id="password" placeholder="Masukan password" name="password" value="<?php echo $rowUser['password'] ?>">
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="3" placeholder="Masukan alamat"><?php echo $row['alamat'] ?></textarea>
                </div>
                
                <div class="form-group" id="gantiDiv">
                    <label for="gantiFoto">Ganti foto</label>
                    <select name="ubah_foto" id="gantiSelect" class="form-control">
                      <option value="tidak">Tidak</option>
                      <option value="ganti">Ganti</option>
                    </select>
                </div>

                <div class="form-group" id="ganti">
                  <label for="exampleFoto">Foto</label>
                  <input type="file" name="ganti_foto">
                  <img src="<?php getFiles($row['foto'])?>" alt="None" style="width: 25%; margin: 2% 3%;"><br>
                  <p class="help-block">Harap masukan foto full body</p>
                </div>

                <div class="form-group" id="tidak">
                  <label for="exampleFoto">Foto</label>
                  <input type="text" name="tidak_ganti" class="form-control" id="exampleInputfoto" value="<?php echo $row['foto'] ?>" readonly>
                </div>
            </div>
            <!-- /.box-body -->
            &nbsp
            <button type="submit" class="btn btn-primary" name="submit">Perbarui</button><br><br>
          </form>
      </div>
    </div>
    </section>
    
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

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<?php  inc("include/includeJS") ?>
<script type="text/javascript">
  $(document).ready(function () {
    $('.sidebar-menu').tree();
      
      $('#ganti').hide();
      $('#gantiSelect').change(function () {
        var listGanti = $('#gantiSelect').val();
        if(listGanti == "tidak"){
          $('#ganti').hide();
          $('#tidak').show();
        }else if(listGanti == "ganti"){
          $('#tidak').hide();
          $('#ganti').show();
        }
      });
  })
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>