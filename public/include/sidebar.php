<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php getFiles($_SESSION['foto']) ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama'] ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <?php  
          $request = new \engine\http\Request();
          $halaman = $request->get(0);

          if($halaman){
            $user = new \model\User();
            if($halaman == 'Pemeriksaan-detail'){
              $user->queryCustom("desc tb_pemeriksaan_detail")->ready();
            }else{
              $user->queryCustom("desc tb_".strtolower($halaman))->ready();
            }

            $field = array();
            $i = 0;
            while ($row = $user->getStatement()->fetch()) {
              $field[$i++] =  $row[0];
            }
        ?>
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
        <a href="#">
          <i class="fa fa-search"></i> <span>Field yang bisa dicari</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu" id="chooseField">
          <?php for($i = 1;$i < count($field);$i++){ ?>
            <li><a href="#"><?= $field[$i] ?></a></li>
          <?php } ?>
          <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                  Penggunaan search
              </button></li><br>
          </ul>
      </ul>
      <?php } ?>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
      <?php 
      switch ($_SESSION['hak_akses']) {
        case 'A': ?>
        <li class="header">Main Data</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php url("Pasien/") ?>"><i class="fa fa-users"></i><span>Pasien</span></a></li>
        <li><a href="<?php url("Dokter/") ?>"><i class="fa fa-user-md"></i><span>Dokter</span></a></li>
        <li><a href="<?php url("Resepsionis/") ?>"><i class="fa fa-user"></i><span>Resepsionis</span></a></li>
        <li><a href="<?php url("User/") ?>"><i class="fa fa-user-secret"></i><span>User</span></a></li>

        <li class="header">Transaction Data</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Pendaftaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i>Tambah Data
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>
                  <form action="<?php url('cariPendaftaran/') ?>" method="post" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="cari_pendaftar" class="form-control" placeholder="Masukan id pasien">
                      <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                </form>
                  </li>
                </ul>
            </li>
            <li><a href="<?php url('Pendaftaran/') ?>"><i class="fa fa-circle-o"></i> Lihat Selengkapnya</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-stethoscope"></i> <span>Pemeriksaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i>Tambah Data
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>
                  <form action="<?php url('cariPemeriksaan/') ?>" method="post" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="cari_pemeriksa" class="form-control" placeholder="Masukan id pasien">
                      <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                </form>
                  </li>
                </ul>
            </li>
            <li><a href="<?php url('Pemeriksaan/') ?>"><i class="fa fa-circle-o"></i> Lihat Selengkapnya</a></li>
          </ul>
        </li>  
          <?php 
          break;
        case 'R': ?>
          <li class="header">Main Data</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?php url("Pasien/") ?>"><i class="fa fa-users"></i><span>Pasien</span></a></li>
        <li><a href="<?php url("Dokter/") ?>"><i class="fa fa-user-md"></i><span>Dokter</span></a></li>
        <li><a href="<?php url("Resepsionis/") ?>"><i class="fa fa-user"></i><span>Resepsionis</span></a></li>

        <li class="header">Transaction Data</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Pendaftaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i>Tambah Data
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>
                  <form action="<?php url('cariPendaftaran/') ?>" method="post" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="cari_pendaftar" class="form-control" placeholder="Masukan id pasien">
                      <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                </form>
                  </li>
                </ul>
            </li>
            <li><a href="<?php url('Pendaftaran/') ?>"><i class="fa fa-circle-o"></i> Lihat Selengkapnya</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-stethoscope"></i> <span>Pemeriksaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i>Tambah Data
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>
                  <form action="<?php url('cariPemeriksaan/') ?>" method="post" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="cari_pemeriksa" class="form-control" placeholder="Masukan id pasien">
                      <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                    </div>
                </form>
                  </li>
                </ul>
            </li>
            <li><a href="<?php url('Pemeriksaan/') ?>"><i class="fa fa-circle-o"></i> Lihat Selengkapnya</a></li>
          </ul>
        </li>  
        <?php
          break;
        case 'D': ?>
        <li class="header">Transaction Data</li>
        <li class="treeview">
        <a href="#">
          <i class="fa fa-stethoscope"></i> <span>Pemeriksaan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Tambah Data
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                <form action="<?php url('cariPemeriksaan/') ?>" method="post" class="sidebar-form">
                  <div class="input-group">
                    <input type="text" name="cari_pemeriksa" class="form-control" placeholder="Masukan id pasien">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                      </span>
                  </div>
              </form>
                </li>
              </ul>
          </li>
          <li><a href="<?php url('Pemeriksaan/') ?>"><i class="fa fa-circle-o"></i> Lihat Selengkapnya</a></li>
        </ul>
      </li>  
        <?php 
          break;
        default:
          # code...
          break;
      } ?>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Struktur Pencarian</h4>
        </div>
        <div class="modal-body">
          <p><b>NamaField:NilaiField</b> <br>
          <b>NamaField</b> = kolom field yang akan dicari datanya, kolom field bisa dilihat pada menu field yang tersedia. <br>
          <b>NilaiField</b> = nilai yang akan dicari berdasarkan nama field.<br>
          contoh = nama:nita, penjelasannya yaitu mencari nilai nita pada kolom nama. 
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
        <!-- /.modal -->
