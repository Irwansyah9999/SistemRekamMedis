<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class PasienController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        // post(requestData,tipeData yang diinginkan(string,angka),validasi satuan(null,string,number))

        $nama_pasien = $this->request->post('nama_pasien');
        $tanggal_lahir = $this->request->post('tanggal_lahir');
        $jenis_kelamin = $this->request->post('jenis_kelamin');
        $golongan_darah = $this->request->post('golongan_darah');
        $pekerjaan = $this->request->post('pekerjaan');
        $no_telepon = $this->request->post('no_telepon');
        $alamat = $this->request->post('alamat');
        
        $exampleValidation = [
            'nama_pasien' => 'null',
            'tanggal_lahir' => 'null',
            'jenis_kelamin' => 'null',
            'golongan_darah' => 'null',
            'pekerjaan' => 'null',
            'no_telepon' => 'null',
            'alamat' => 'null'
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        
        $model = new \model\Pasien();
        
        $model->fields = [$nama_pasien,$tanggal_lahir,$jenis_kelamin,$golongan_darah,$pekerjaan,$no_telepon,$alamat];
        $model->save();
        
        $this->response->redirect('Pasien/','data berhasil ditambah');
        
    }
    
    function update() {
        $id = $this->request->post('id_pasien','null');
        
        $nama_pasien = $this->request->post('nama_pasien');
        $tanggal_lahir = $this->request->post('tanggal_lahir');
        $jenis_kelamin = $this->request->post('jenis_kelamin');
        $golongan_darah = $this->request->post('golongan_darah');
        $pekerjaan = $this->request->post('pekerjaan');
        $no_telepon = $this->request->post('no_telepon');
        $alamat = $this->request->post('alamat');
        
        $exampleValidation = [
            'nama_pasien' => 'null',
            'tanggal_lahir' => 'null',
            'jenis_kelamin' => 'null',
            'golongan_darah' => 'null',
            'pekerjaan' => 'null',
            'no_telepon' => 'null',
            'alamat' => 'null'
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        
        $model = new \model\Pasien();
        
        $model->fields = [$nama_pasien,$tanggal_lahir,$jenis_kelamin,$golongan_darah,$pekerjaan,$no_telepon,$alamat];
        $model->update($id);
        
        $this->response->redirect('Pasien/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $model = new \model\Pasien();
        
        $model->remove($id);
        
        $this->response->redirect('Pasien/','data berhasil di hapus');
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
