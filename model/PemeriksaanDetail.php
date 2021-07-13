<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace model;

use engine\abstraction\Model;

class PemeriksaanDetail extends Model {

    // Field yg di masukan ialah yang tidak mempunyai atribut Auto Increment
    function __construct() {
        $this->initial();
        
        $this->setPrimaryKey('id_pemeriksaan_detail');
        
        $this->setTable("tb_pemeriksaan_detail");
        
        $this->setField(['id_pemeriksaan','tanggal_pemeriksaan_detail','status','keluhan','diagnosa','id_dokter']);
        
    }
}
