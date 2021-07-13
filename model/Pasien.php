<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace model;

use engine\abstraction\Model;

class Pasien extends Model {

    // Field yg di masukan ialah yang tidak mempunyai atribut Auto Increment
    function __construct() {
        $this->initial();
        
        $this->setPrimaryKey('id_pasien');
        
        $this->setTable("tb_pasien");
        
        $this->setField(['nama_pasien','tanggal_lahir','jenis_kelamin','golongan_darah','pekerjaan','no_telepon','alamat']);
        
    }
}
