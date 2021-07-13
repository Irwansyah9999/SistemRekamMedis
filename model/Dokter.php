<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace model;

use engine\abstraction\Model;

class Dokter extends Model {

    // Field yg di masukan ialah yang tidak mempunyai atribut Auto Increment
    function __construct() {
        $this->initial();
        
        $this->setPrimaryKey('id_dokter');
        
        $this->setTable("tb_dokter");
        
        $this->setField(['id_dokter','nama_dokter','tanggal_lahir','jenis_kelamin','email','no_telepon','alamat','foto']);
        
    }
}
