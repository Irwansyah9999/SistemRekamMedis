<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class UserController extends Controller{
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

        $id_user = $this->request->post('id_user');
        $nama_user = $this->request->post('nama_user');
        $username = $this->request->post('username');
        $password = $this->request->post('password');

        
        $exampleValidation = [
            'id_user' => 'null',
            'nama_user'=> 'null',
            'password' => 'null',
            'username' => 'null'
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);

        $model = new \model\User();
        
        $model->fields = [$id_user,$nama_user,$username,$password,'A',getFiles('aktor.png')];
        $model->save();
        
        $this->response->redirect('User/','data berhasil ditambah');
    }
    
    function update() {
        $id_user = $this->request->post('id_user');
        $nama_user = $this->request->post('nama_user');
        $username = $this->request->post('username');
        $password = $this->request->post('password');
        
        $exampleValidation = [
            'id_user' => 'null',
            'nama_user'=> 'null',
            'password' => 'null',
            'username' => 'null'
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        $model = new \model\User();
        
        $model->fields = [$id_user,$nama_user,$username,$password,'A',getFiles('aktor.png')];
        $model->update($id_user,'string');
        
        $this->response->redirect('User/user-profile/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $model = new \model\User();
        
        $model->remove($id,'string');
        
        $this->response->redirect('User/','data berhasil di hapus');
    }
    
    function search() {
        $colom = $this->request->post('sort','mhsID');
        $type = $this->request->post('type','ASC');
        
        echo $colom;
        echo $type;
        
        $this->response->redirect('help/1/column/'.$colom.'/tipe/'.$type.'/');
    }
	
	function login(){
        
        $username = $this->request->post('username','null');
        $password = $this->request->post('password','null');

        $user = new \model\User();

        $user->select($user->getTable())->where()->comparing("username",$username)->ready();

        $row = $user->getStatement()->fetch();

        if($row){
            
            $user = new \model\User();
            $user->select($user->getTable())->where()->comparing("username",$username)
            ->and()->comparing("password",$password)->ready();

            $rowWithPassword = $user->getStatement()->fetch();

            if($rowWithPassword){
                $class = "\\model\\";
                $id = "";

                if($rowWithPassword['hak_akses'] == 'R'){
                    $class .= "Resepsionis";
                    $id = "nip";
                }else if($rowWithPassword['hak_akses'] == 'D'){
                    $class .= "Dokter";
                    $id = "id_dokter";
                }else if($rowWithPassword['hak_akses'] == 'A'){
                    $class .= "User";
                    $id = "id_user";
                }

                $model = new $class();
                $model->select($model->getTable())->where()
                ->comparing($id,$rowWithPassword['id_user'])->ready();

                $rowPegawai = $model->getStatement()->fetch();

                $this->session->set('hak_akses',$rowWithPassword['hak_akses']);

                $this->session->set('id_user',$rowWithPassword['id_user']);

                $this->session->set('foto',$rowPegawai['foto']);

                $this->session->set('nama',$rowPegawai[1]);
                
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

        $this->response->redirect('page/Login/');
    }
    
}
