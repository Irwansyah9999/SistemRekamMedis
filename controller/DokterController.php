<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class DokterController extends Controller{
    //put your code here
    protected $file;

    public function __construct() {
        parent::__construct();
        $this->file = new \engine\files\Files();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        // post(requestData,tipeData yang diinginkan(string,angka),validasi satuan(null,string,number))

        $id_dokter = $this->request->post('id_dokter');
        $nama_dokter = $this->request->post('nama_dokter');
        $tanggal_lahir = $this->request->post('tanggal_lahir');
        $jenis_kelamin = $this->request->post('jenis_kelamin');
        $no_telepon = $this->request->post('no_telepon');
        $email = $this->request->post('email');
        $alamat = $this->request->post('alamat');

        $uploadFoto = $this->file->upload('foto',$nama_dokter,"user/dokter/");


        $exampleValidation = [
            'id_dokter' => 'null',
            'nama_dokter' => 'null',
            'tanggal_lahir' => 'null',
            'jenis_kelamin' => 'null',
            'no_telepon' => 'null',
            'email' => 'null',
            'alamat' => 'null'
        ];
        
        $this->request->validation($exampleValidation);
        
        if($uploadFoto['pesan'] == ''){
            $model = new \model\Dokter();
            //['id_dokter','nama_dokter','tanggal_lahir','jenis_kelamin','email','no_telepon','alamat','foto']
            $model->fields = [$id_dokter,$nama_dokter,$tanggal_lahir,$jenis_kelamin,$email,$no_telepon,$alamat,$uploadFoto['file']];
            $model->save();

            $tanggalLahir =str_replace("-","",$tanggal_lahir);

            $user = new \model\User();
            $user->fields = [$id_dokter,$nama_dokter,$email,$tanggalLahir,'D',$uploadFoto['file']];
            $user->save();
            
            $this->response->redirect('Dokter/','data berhasil ditambah');
        }else{
            $this->response->back($uploadFoto['pesan']);
        }
    }
    
    function update() {
        $nama_dokter = $this->request->post('nama_dokter');
        $tanggal_lahir = $this->request->post('tanggal_lahir');
        $password = $this->request->post('password');
        $jenis_kelamin = $this->request->post('jenis_kelamin');
        $no_telepon = $this->request->post('no_telepon');
        $email = $this->request->post('email');
        $alamat = $this->request->post('alamat');

        
        // var cek ganti gambar atau tidak
        $ubah_foto = $this->request->post('ubah_foto','null');

        $foto = "";

        $id_dokter = $this->request->post('id_dokter');
        $id_user = $this->request->post('id_dokter','');
        
        if($ubah_foto == 'ganti'){
            $foto = $this->file->upload('ganti_foto',$nama_dokter,"user/dokter/");
        }else if($ubah_foto == 'tidak'){
            $foto = $this->request->post('tidak_ganti','null');
        }
        
        $exampleValidation = [
            'nama_dokter' => 'null',
            'email' => 'null',
            'no_telepon' => 'null',
            'alamat' => 'null'
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        
        $dokter = new \model\Dokter();

        // ganti
        if(is_array($foto)){
            if($foto['pesan'] == ''){
                $dokter->fields = [$id_dokter,$nama_dokter,$tanggal_lahir,$jenis_kelamin,$email,$no_telepon,$alamat,$foto['file']];
                $dokter->update($id_dokter,'string');
    
                $user = new \model\User();
                $user->fields = [$id_user,$nama_dokter,$email,$password,"D",$foto['file']];
                $user->update($id_user,'string');
                
                $this->response->redirect('Dokter/','data berhasil diperbarui');
            }else{
               $this->response->back($foto['pesan']);
            }   
        // tidak
        }else{
            $dokter->fields = [$id_dokter,$nama_dokter,$tanggal_lahir,$jenis_kelamin,$email,$no_telepon,$alamat,$foto];
            $dokter->update($id_dokter,'string');

            $user = new \model\User();
            $user->fields = [$id_user,$nama_dokter,$email,$password,"D",$foto];
            $user->update($id_user,'string');

            $this->response->redirect('Dokter/','data berhasil diperbarui');
        }
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $dokter = new \model\Dokter();
        $user = new \model\User();
        
        $pemeriksaan_detail = new \model\PemeriksaanDetail();
        $pemeriksaan_detail->setPrimaryKey('id_dokter');
        
        $pemeriksaan_detail->remove($id,'string');

        $user->remove($id,'string');
        $dokter->remove($id,'string');
        $this->response->redirect('Dokter/','data berhasil di hapus');
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
