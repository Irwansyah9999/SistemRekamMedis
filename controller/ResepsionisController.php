<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class ResepsionisController extends Controller{

    protected $file;

    //put your code here
    public function __construct() {
        parent::__construct();

        $this->file = new \engine\files\Files();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        // post(requestData,tipeData yang diinginkan(string,angka),validasi satuan(null,string,number))

        $nip = $this->request->post('nip');
        $nama_resepsionis = $this->request->post('nama_resepsionis');
        $tanggal_lahir = $this->request->post('tanggal_lahir');
        $no_telepon = $this->request->post('no_telepon');
        $email = $this->request->post('email');
        $alamat = $this->request->post('alamat');

        $uploadFoto = $this->file->upload('foto',$nama_resepsionis,"user/resepsionis/");
        
        $exampleValidation = [
            'nip' => 'null',
            'nama_resepsionis' => 'null',
            'no_telepon' => 'null',
            'email' => 'null',
            'alamat' => 'null'
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        
        if($uploadFoto['pesan'] == ''){
            
            $resepsionis = new \model\Resepsionis();
            
            $resepsionis->fields = [$nip,$nama_resepsionis,$tanggal_lahir,$no_telepon,$email,$alamat,$uploadFoto['file']];
            $resepsionis->save();

            $tanggalLahir =str_replace("-","",$tanggal_lahir);

            $user = new \model\User();
            $user->fields = [$nip,$nama_resepsionis,$email,$tanggalLahir,'R',$uploadFoto['file']];
            $user->save();
            
            $this->response->redirect('Resepsionis/','data berhasil ditambah');
        }else{
            $this->response->back($uploadFoto['pesan']);
        }
    }
    
    function update() {
        $nama_resepsionis = $this->request->post('nama_resepsionis');
        $tanggal_lahir = $this->request->post('tanggal_lahir');
        $no_telepon = $this->request->post('no_telepon');
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $alamat = $this->request->post('alamat');
        
        // var cek ganti gambar atau tidak
        $ubah_foto = $this->request->post('ubah_foto','null');

        $foto = "";

        $id = $this->request->post('nip');
        $id_user = $this->request->post('nip');

        
        if($ubah_foto == 'ganti'){
            $foto = $this->file->upload('ganti_foto',$nama,"user/resepsionis/");
        }else if($ubah_foto == 'tidak'){
            $foto = $this->request->post('tidak_ganti','null');
        }
        
        $exampleValidation = [
            'nama_resepsionis' => 'null',
            'email' => 'null',
            'no_telepon' => 'null',
            'alamat' => 'null'
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        
        $resepsionis = new \model\Resepsionis();

        // ganti
        if(is_array($foto)){
            if($foto['pesan'] == ''){
                $resepsionis->fields = [$id,$nama_resepsionis,$tanggal_lahir,$no_telepon,$email,$alamat,$foto['file']];
                $resepsionis->update($id,'string');
    
                $user = new \model\User();
                $user->fields = [$id_user,$nama_resepsionis,$email,$password,"R",$foto['file']];

                $user->update($id_user,'string');
                
                $this->response->redirect('Resepsionis/','data berhasil diperbarui');
            }else{
               $this->response->back($foto['pesan']);
            }   
        // tidak
        }else{
            $resepsionis->fields = [$id,$nama_resepsionis,$tanggal_lahir,$no_telepon,$email,$alamat,$foto];
            $resepsionis->update($id,'string');

            $user = new \model\User();
            $user->fields = [$id_user,$nama_resepsionis,$email,$password,"R",$foto];
            $user->update($id_user,'string');

            $this->response->redirect('Resepsionis/','data berhasil diperbarui');
        }
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $resepsionis = new \model\Resepsionis();
        $user = new \model\User();
        
        $pendaftaran = new \model\Pendaftaran();
        $pendaftaran->setPrimaryKey('nip');
        
        $pendaftaran->remove($id,'string');
        $user->remove($id,'string');
        $resepsionis->remove($id,'string');
        
        $this->response->redirect('Resepsionis/','data berhasil di hapus');
    }
    
    function search() {
        $colom = $this->request->post('sort','mhsID');
        $type = $this->request->post('type','ASC');
        
        echo $colom;
        echo $type;
        
        $this->response->redirect('help/1/column/'.$colom.'/tipe/'.$type.'/');
    }
	
	function login(){
        
        $username = $this->request->post('email','null');
        $password = $this->request->post('password','null');

        $user = new ModelExample();

        $user->select($user->getTable())->where()->comparing("username",$username)->ready();

        $row = $user->getStatement()->fetch();

        if($row){
            
            $user = new ModelExample();
            $user->select($user->getTable())->where()->comparing("username",$username)
            ->and()->comparing("password",$password)->ready();

            $rowWithPassword = $user->getStatement()->fetch();

            if($rowWithPassword){

                $pegawai = new Pegawai();
                $pegawai->select($pegawai->getTable())->where()
                ->comparing("nip",$rowWithPassword['nip'])->ready();

                $rowPegawai = $pegawai->getStatement()->fetch();

                $this->session->set('hak_akses',$rowWithPassword['hak_akses']);

                $this->session->set('nip',$rowPegawai['nip']);
                $this->session->set('nama_pegawai',$rowPegawai['nama_pegawai']);
                
                $this->response->redirect('');
            }else{
                $this->response->back('password yang dimasukan salah');
            }
        }else{
            $this->response->back('username tidak ditemukan');
        }
    }

    function logout(){
        session_destroy();

        $this->response->redirect('User/Login/');
    }
    
}
