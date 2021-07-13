<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class PemeriksaanController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        // post(requestData,tipeData yang diinginkan(string,angka),validasi satuan(null,string,number))

        $id_pemeriksaan = $this->request->post('id_pemeriksaan');
        $id_pasien = $this->request->post('id_pasien');
        $keterangan1 = $this->request->post('keterangan1');
        $status1 = "Dibuat";
        $cek_pemeriksaan = $this->request->post('cek_pemeriksaan');

        $status2 = $this->request->post('status2');
        $keluhan = $this->request->post('keluhan');
        $diagnosa = $this->request->post('diagnosa');
        $id_dokter = $_SESSION['id_user'];

        $tanggalPemeriksaan = date('Y-m-d');
        
        $exampleValidation = [
            'keluhan' => 'null',
            'diagnosa' => 'null',
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);

        echo $cek_pemeriksaan;
        if($cek_pemeriksaan == ''){
            $pemeriksaan = new \Model\Pemeriksaan();
        
            $pemeriksaan->fields = [$tanggalPemeriksaan,$keterangan1,$status1,$id_pasien];
            $pemeriksaan->save();

            $pemeriksaan->select($pemeriksaan->getTable())->where()->comparing('id_pasien',$id_pasien)->ready();
            $rowPemeriksaan = $pemeriksaan->getStatement()->fetch();
            
            $pemeriksaan_detail = new \Model\PemeriksaanDetail();
            $pemeriksaan_detail->fields = [$rowPemeriksaan['id_pemeriksaan'],$tanggalPemeriksaan,$status2,$keluhan,$diagnosa,$id_dokter];
            $pemeriksaan_detail->save();
            
            $this->response->redirect('Pemeriksaan/','data berhasil ditambah');
        }else{
            $pemeriksaan_detail = new \Model\PemeriksaanDetail();

            $pemeriksaan_detail->fields = [$id_pemeriksaan,$tanggalPemeriksaan,$status2,$keluhan,$diagnosa,$id_dokter];
            $pemeriksaan_detail->save();

            $this->response->redirect('Pemeriksaan/','data berhasil ditambah');
            
        }
        
    }
    
    function update() {
        $id = $this->request->post('id','null');
        $namaDepan = $this->request->post('namaDepan','null');
        $namaBelakang = $this->request->post('namaBelakang','null');
        $umur = $this->request->post('umur','number');
        
        $pemeriksaan = new ModelExample();
        
        $pemeriksaan->fields = [$namaDepan,$namaBelakang,$umur];
        $pemeriksaan->update($id);
        
        $this->response->redirect('help/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $pemeriksaan = new ModelExample();
        
        $pemeriksaan->remove($id);
        
        $this->response->redirect('help/','data berhasil di hapus');
    }
    
    function search() {
        $id_pasien = $this->request->post('cari_pemeriksa');
        
        $pasien = new \model\Pasien();
        $pasien->select($pasien->getTable())->where()->comparing("id_pasien",$id_pasien)->ready();

        $row = $pasien->getStatement()->fetch();

        if($row){
            $this->response->redirect('Pemeriksaan/add/'.$id_pasien.'/');
        }else{
            $this->response->redirect('Pemeriksaan/',"id pasien $id_pasien tidak terdaftar");
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
