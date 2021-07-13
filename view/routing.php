<?php

/*
 * init variabel dengan variabel random
 * jika menampilkan data berdasarkan kategori tertentu
 * route->get(url, view, acces)
 * route->get(url data -> url default namaprojek/public/,
 *            tampilan yang ingin digunakan bisa dengan halaman web atau controller,
 *              hak akses dari halaman tersebut -> default bisa akses oleh semua, ['nama session' => 'value']);
 * 
 */

use engine\http\Route;
use engine\http\Response;
use engine\errors\ErrorCode;
use engine\errors\SessionError;

class Routing{
    public $routes,$response;
    
    public function __construct() {
        
        
        
        $this->routes = new Route();
        $this->response = new Response();
        
        $route = $this->routes;

        /*
        * set error location
        */
        ErrorCode::setPageError("error-configuration.php");
        ErrorCode::setLocationError("view");

        /*
        * set Session Error location 
        */
        SessionError::setLocationSession('logout/');

        /*
        * Add Route this
        */

       // homepage
        $route->get('', function ($id){
            $id['halaman'] = '';
            $id['halamanAktif'] = 'Home';

            $this->response->view('index',$id);
        },["hak_akses" => ["A","R","D"]]);

        // login
        $route->get('page/Login/',function($id){
            $id['halaman'] = '/ > ';

            $this->response->view('Pages/login',$id);
        });

        
        $route->post('login/',function($id){
            $id['halaman'] = 'login/';

            $this->response->view('UserController&login',$id);
        },'submit');

        // logout
        $route->get('logout/',function($id){
            $id['halaman'] = 'page/login/';

            $this->response->view('UserController&logout',$id);
        });

       // Pasien
        $route->get('Pasien/', function ($id){
            $id['halaman'] = '/ > Pasien > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pasien/index',$id);
        });

        $route->get('Pasien/page/(id)/', function ($id){
            $id['halaman'] = '/ > Pasien > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pasien/index',$id);
        });

        $route->get('Pasien/add/', function ($id){
            $id['halaman'] = '/ > Pasien > ';
            $id['halamanAktif'] = 'Form Tambah';

            $this->response->view('Pasien/form-input',$id);
        });

        $route->post('addPasien/', function ($id){
            $id['halaman'] = 'Pasien/';

            $this->response->view('PasienController&save',$id);
        },'submit');

        $route->get('Pasien/update/(id)/', function ($id){
            $id['halaman'] = '/ > Pasien > ';
            $id['halamanAktif'] = 'Form Perbarui';

            $this->response->view('Pasien/form-perbarui',$id);
        });

        $route->post('updatePasien/', function ($id){
            $id['halaman'] = 'Pasien/';

            $this->response->view('PasienController&update',$id);
        },'submit');

        $route->get('removePasien/(id)/', function ($id){
            $id['halaman'] = 'Pasien/';

            $this->response->view('PasienController&remove',$id);
        });

        // Dokter
        $route->get('Dokter/', function ($id){
            $id['halaman'] = '/ > Dokter > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Dokter/index',$id);
        });

        // Dokter
        $route->get('Dokter/page/(id)/', function ($id){
            $id['halaman'] = '/ > Dokter > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Dokter/index',$id);
        });

        $route->get('Dokter/add/', function ($id){
            $id['halaman'] = '/ > Dokter > ';
            $id['halamanAktif'] = 'Form Tambah';

            $this->response->view('Dokter/form-input',$id);
        });

        $route->post('addDokter/', function ($id){
            $id['halaman'] = 'Dokter/';

            $this->response->view('DokterController&save',$id);
        },'submit');

        $route->get('Dokter/update/(id)/', function ($id){
            $id['halaman'] = '/ > Dokter > ';
            $id['halamanAktif'] = 'Form Perbarui';

            $this->response->view('Dokter/form-perbarui',$id);
        });

        $route->post('updateDokter/', function ($id){
            $id['halaman'] = 'Dokter/';

            $this->response->view('DokterController&update',$id);
        },'submit');

        $route->get('removeDokter/(id)/', function ($id){
            $id['halaman'] = 'Dokter/';

            $this->response->view('DokterController&remove',$id);
        });

        // Resepsionis
        $route->get('Resepsionis/', function ($id){
            $id['halaman'] = '/ > Resepsionis > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Resepsionis/index',$id);
        });

        $route->get('Resepsionis/page/(id)/', function ($id){
            $id['halaman'] = '/ > Resepsionis > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Resepsionis/index',$id);
        });

        $route->get('Resepsionis/add/', function ($id){
            $id['halaman'] = '/ > Dokter > ';
            $id['halamanAktif'] = 'Form Tambah';

            $this->response->view('Resepsionis/form-input',$id);
        });

        $route->post('AddResepsionis/', function ($id){
            $id['halaman'] = 'Resepsionis/';

            $this->response->view('ResepsionisController&save',$id);
        },'submit');

        $route->get('Resepsionis/update/(id)/', function ($id){
            $id['halaman'] = '/ > Resepsionis > ';
            $id['halamanAktif'] = 'Form Perbarui';

            $this->response->view('Resepsionis/form-perbarui',$id);
        });

        $route->post('updateResepsionis/', function ($id){
            $id['halaman'] = 'Resepsionis/';

            $this->response->view('ResepsionisController&update',$id);
        },'submit');

        $route->get('removeResepsionis/(id)/', function ($id){
            $id['halaman'] = 'Resepsionis/';

            $this->response->view('ResepsionisController&remove',$id);
        });

        // User
        $route->get('User/', function ($id){
            $id['halaman'] = '/ > User > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('User/index',$id);
        });

        $route->get('User/page/(id)/', function ($id){
            $id['halaman'] = '/ > User > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('User/index',$id);
        });

        $route->get('User/add/', function ($id){
            $id['halaman'] = '/ > User > ';
            $id['halamanAktif'] = 'Form Tambah';

            $this->response->view('User/form-input',$id);
        });

        $route->post('addUser/', function ($id){
            $id['halaman'] = 'User/';

            $this->response->view('UserController&save',$id);
        },'submit');

        $route->get('User/update/(id)/', function ($id){
            $id['halaman'] = '/ > User > ';
            $id['halamanAktif'] = 'Form Perbarui';

            $this->response->view('User/form-perbarui',$id);
        });

        $route->get('User/user-profile/', function ($id){
            $id['halaman'] = '/ > User > ';
            $id['halamanAktif'] = 'User Profile';

            $this->response->view('User/user-profile',$id);
        });

        $route->get('updateUser/', function ($id){
            $id['halaman'] = '/ > User > ';
            $id['halamanAktif'] = 'User Profile';

            $this->response->view('UserController&update',$id);
        });

        // Pemeriksaan dan pemeriksaan detail
        $route->get('Pemeriksaan/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pemeriksaan/index',$id);
        });

        $route->get('Pemeriksaan/page/(id)/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pemeriksaan/index',$id);
        });

        $route->get('Pemeriksaan-detail/(id)/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pemeriksaan/index-detail',$id);
        });

        $route->get('Pemeriksaan-detail/(id)/page/(id_page)/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pemeriksaan/index-detail',$id);
        });

        $route->post('cariPemeriksaan/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('PemeriksaanController&search',$id);
        },'search');

        $route->get('Pemeriksaan/add/(id)/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Form Tambah';

            $this->response->view('Pemeriksaan/form-input',$id);
        });

        $route->get('Pemeriksaan/report/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Laporan';

            $this->response->view('Pemeriksaan/laporan2',$id);
        });

        $route->get('Pemeriksaan-detail/report/(id)/', function ($id){
            $id['halaman'] = '/ > Pemeriksaan > ';
            $id['halamanAktif'] = 'Laporan';

            $this->response->view('Pemeriksaan/laporan',$id);
        });

        $route->post('addPemeriksaan/', function ($id){
            $id['halaman'] = 'Pemeriksaan/';

            $this->response->view('PemeriksaanController&save',$id);
        },'submit');

        // Pendaftaran
        $route->get('Pendaftaran/', function ($id){
            $id['halaman'] = '/ > Pendaftaran > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pendaftaran/index',$id);
        });
        $route->get('Pendaftaran/page/(id_page)/', function ($id){
            $id['halaman'] = '/ > Pendaftaran > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('Pendaftaran/index',$id);
        });

        $route->post('cariPendaftaran/', function ($id){
            $id['halaman'] = '/ > Pendaftaran > ';
            $id['halamanAktif'] = 'Home';

            $this->response->view('PendaftaranController&search',$id);
        },'search');

        $route->get('Pendaftaran/add/(id)/', function ($id){
            $id['halaman'] = '/ > Pendaftaran > ';
            $id['halamanAktif'] = 'Form Tambah';

            $this->response->view('Pendaftaran/form-input',$id);
        });

        $route->post('addPendaftaran/', function ($id){
            $id['halaman'] = 'Pendaftaran/';

            $this->response->view('PendaftaranController&save',$id);
        },'submit');
        /*
        * example
        
        $route->get('Perbaikan/', function ($array){
            //$array['id'] = 1;
        
            $this->response->view('Perbaikan/index');
        },['hak_akses' => ['ITO','O']]);

        $route->get('Perbaikan/add/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('Perbaikan/form-input');
        },['hak_akses' => ['ITO','O']]);

        $route->post('addPerbaikan/', function (){
            $this->response->view('PerbaikiController&save');
        },'submit',['hak_akses' => ['ITO','O']]);

        $route->get('Perbaikan/perbarui/(id)/', function ($array){
            //$array['id'] = 1;

            $this->response->view('Perbaikan/form-perbarui',$array);
        },['hak_akses' => ['ITO','O']]);

        $route->post('perbaruiPerbaikan/', function (){
            $this->response->view('PerbaikiController&update');
        },'submit',['hak_akses' => ['ITO','O']]);

        $route->get('hapusPerbaikan/(id)/', function ($array){
            $this->response->view('PerbaikiController&remove',$array);
        },['hak_akses' => ['ITO','O']]);
		*/


       // End added route
       $route->checkRoute();
    }
}
?>