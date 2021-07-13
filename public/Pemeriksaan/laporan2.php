<!DOCTYPE html>
<html lang="en">
<?php
    $request = new \engine\http\Request();
    $id_pemeriksaan = $request->get(2);

    $pemeriksaan = new \model\PemeriksaanDetail();
    $pemeriksaan->select($pemeriksaan->getTable())->where()->comparing("id_dokter",$_SESSION['id_user'])->ready();
    $row = $pemeriksaan->getStatement()->fetch();
    
    $dokter = new \model\Dokter();
    $dokter->select($dokter->getTable())->where()->comparing("id_dokter",$row['id_dokter'])->ready();

    $rowDokter = $dokter->getStatement()->fetch();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>

    <?php inc("include/includeCSS") ?>
</head>
<body>
<div class="container">
<script>
    window.print();
</script>
    <div class="box">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="logo-lg"><b>Sistem Informasi Rekam Medis</b></h1>
            </div>
            <div class="col-sm-8 text-center">
                <h1>Laporan Pemeriksaan</h1>
                <h2>KLINIK WAHYUNINGSIH</h2>
                <p>Desa Kosambi Timur RT.001/RW.015 No.102, Kec. Kosambi, Kab. Tangerang,Kota. Tangerang, Prov. Banten</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <header>
            <table width="50%" style="">
                <tr>
                    <td>Id</td>
                    <td>:</td>
                    <td><?php echo $rowDokter['id_dokter'] ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $rowDokter['nama_dokter'] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Rekap</td>
                    <td>:</td>
                    <td><?php $tanggal_sekarang = date('d F Y');
                    echo $tanggal_sekarang; ?></td>
                </tr>
            </table>
            </header><br><br>
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
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $request = new \engine\http\Request();
                    $pemeriksaan = new \model\PemeriksaanDetail();
                    $pemeriksaan->select($pemeriksaan->getTable())->where()->comparing('id_dokter',$_SESSION['id_user'])
                    ->ready();
                    if($pemeriksaan->getStatement()->rowCount()){
                    while($row = $pemeriksaan->getStatement()->Fetch()){ 
                    ?>
                        <tr>
                        <td><?php echo $row['id_pemeriksaan_detail'] ?></td>
                        <td><?php echo $row['id_pemeriksaan'] ?></td>
                        <td><?php $periksa = new \model\Pemeriksaan();
                        $periksa->select($periksa->getTable())->where()->comparing('id_pemeriksaan',$row['id_pemeriksaan'])->ready();
                        $rowPeriksa = $periksa->getStatement()->fetch();

                        $pasien = new \model\Pasien();
                        $pasien->select($pasien->getTable())->where()->comparing('id_pasien',$rowPeriksa['id_pasien'])->ready();
                        $rowPasien = $pasien->getStatement()->fetch(); 
                        
                        echo $rowPeriksa['id_pasien'].'-'.$rowPasien['nama_pasien'] 
                        ?></td>
                        <td><?php echo $row['tanggal_pemeriksaan_detail'] ?></td>
                        <td><?php echo $row['keluhan'] ?></td>
                        <td><?php echo $row['diagnosa'] ?></td>
                        <td><?php echo $row['status'] ?></td>
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
        </div>

    </div>
</div>
</body>
<?php  inc("include/includeJS") ?>
</html>