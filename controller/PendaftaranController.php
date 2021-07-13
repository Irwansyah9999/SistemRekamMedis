<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class PendaftaranController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        // post(requestData,tipeData yang diinginkan(string,angka),validasi satuan(null,string,number))

        $id_pasien = $this->request->post('id_pasien');
        $tanggal_pendaftaran = date('Y-m-d H:i:s');
        $status_pendaftar = $this->request->post('status_pendaftar');
        $nip = $_SESSION['id_user'];
        
        $exampleValidation = [
            
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        
        $model = new \model\Pendaftaran();
        
        $model->fields = [$tanggal_pendaftaran,$status_pendaftar,$id_pasien,$nip];
        $model->save();
        
        $this->response->redirect('Pendaftaran/','data berhasil ditambah');
        
    }
    
    function update() {
        $id = $this->request->post('id','null');

        $id_pasien = $this->request->post('id_pasien');
        $tanggal_pendaftaran = date('Y-m-d H:i:s');
        $status_pendaftar = $this->request->post('status_pendaftar');
        $nip = $_SESSION['id_user'];
        
        $model = new \model\Pendaftaran();
        
        $model->fields = [$tanggal_pendaftaran,$status_pendaftar,$id_pasien,$nip];
        $model->update($id);
        
        $this->response->redirect('Pendaftaran/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $model = new ModelExample();
        
        $model->remove($id);
        
        $this->response->redirect('help/','data berhasil di hapus');
    }
    
    function search() {
        $id_pasien = $this->request->post('cari_pendaftar');
        
        $pasien = new \model\Pasien();
        $pasien->select($pasien->getTable())->where()->comparing("id_pasien",$id_pasien)->ready();

        $row = $pasien->getStatement()->fetch();

        if($row){
            $this->response->redirect('Pendaftaran/add/'.$id_pasien.'/');
        }else{
            $this->response->redirect('Pasien/',"silahkan daftarkan dahulu jika pasien belum terdata");
        }
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
