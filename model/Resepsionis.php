<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace model;

use engine\abstraction\Model;

class Resepsionis extends Model {

    // Field yg di masukan ialah yang tidak mempunyai atribut Auto Increment
    function __construct() {
        $this->initial();
        
        $this->setPrimaryKey('nip');
        
        $this->setTable("tb_resepsionis");
        
        $this->setField(['nip','nama_resepsionis','tanggal_lahir','no_telepon','email','alamat','foto']);
        
    }
}
