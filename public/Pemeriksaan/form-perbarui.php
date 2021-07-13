<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Form Perbarui Mahasiswa</title>

    <?php
    
    inc("include/includeCSS") ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Logo -->
        <?php inc("include.logo") ?>
        
        <!-- Navigation -->
        <?php inc("include/navigation") ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form Mahasiswa</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Perbarui Data
                        </div>
                        <?php 
                        
                        $request = new \engine\http\Request();
                        $mahasiswa = new \model\Mahasiswa();
                        
                        $mahasiswa->select($mahasiswa->getTable())->where()
                        ->comparing("nim", $request->get(2))->ready();

                        $row = $mahasiswa->getStatement()->fetch();

                        ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php url("perbaruiMahasiswa/") ?>" method="post">
                                        <div class="form-group">
                                            <label>Nim</label>
                                            <input class="form-control" placeholder="Masukan NIM" name="nim" 
                                            value="<?php echo $row[0] ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" placeholder="Masukan Nama" name="nama_mhs" value="<?php echo $row[1] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input class="form-control" placeholder="Masukan Tempat Lahir" 
                                            name="tempat_lahir" value="<?php echo $row[2] ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $row[3] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" rows="3" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-default" name="submit">Perbarui</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php inc("include/includeJS") ?>

</body>
</html>
