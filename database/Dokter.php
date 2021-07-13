<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\DDLQuery;
use engine\database\order\OtherQuery;
/**
 * Description of Dokter
 *
 * @author Irwansyah
 */
class Dokter {
    //put your code here
    public $ddl,$other,
            $tableName = "tb_dokter";
    
    
    
    public function __construct() {
        $this->ddl = new DDLQuery();
        $this->other = new OtherQuery();
    }
    
    public function create() {
        // (nama kolom,kosong atau tidak atau default,panjang length,nilai default,autoIncrement{khusus int})
        $this->ddl->varchar("id_dokter","not null",8);
        $this->ddl->varchar("nama_dokter","not null",25);
        $this->ddl->typeData("jenis_kelamin","enum('L','P')");
        $this->ddl->varchar("no_telepon","not null",15);
        $this->ddl->typeData("alamat","text");
        $this->ddl->varchar("foto","null",35);

        $this->ddl->primaryKey("id_dokter");

        /*$this->ddl->varchar("varchar","not null",10);
        $this->ddl->integer("int","not null",10,"","autoIncrement");
        $this->ddl->floats("float","default",10,6.5);
        $this->ddl->char("char","null");
        $this->ddl->text("text");
        $this->ddl->typeData("columnName","date", "null", 20,"autoIncrement");
        
        $this->ddl->primaryKey("columnName");
        $this->ddl->foreignKey("columnName","tableName","columnNameTable");
        $this->ddl->unique("columnName");*/
        
        $this->ddl->createTable($this->tableName)->ready();
    }
    
    public function alter(){
        //$this->ddl->alterTable($this->tableName)->addPrimaryKey("namaKolom");
        $this->ddl->alterTable($this->tableName)->add("tanggal_lahir","date null","nama_dokter");
        
        //$this->ddl->alterTable($this->tableName)->change($columnBefore, $columnAfter);
        //$this->ddl->alterTable($this->tableName)->modify($columnBefore,$typeData);
        //$this->ddl->alterTable($this->tableName)->drop($columnName);
        
        
        $this->ddl->execute($this->ddl->executeAlter());
    }
    
    public function truncate(){
        $this->other->truncate($this->tableName);
        
        $this->other->ready();
    }

    public function drop(){
        $this->other->dropTable($this->tableName);
        
        $this->other->ready();
    }
}
