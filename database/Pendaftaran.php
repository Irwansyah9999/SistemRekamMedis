<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\DDLQuery;
use engine\database\order\OtherQuery;
/**
 * Description of Pendaftaran
 *
 * @author Irwansyah
 */
class Pendaftaran {
    //put your code here
    public $ddl,$other,
            $tableName = "tb_pendaftaran";
    
    public function __construct() {
        $this->ddl = new DDLQuery();
        $this->other = new OtherQuery();
    }
    
    public function create() {
        // (nama kolom,kosong atau tidak atau default,panjang length,nilai default,autoIncrement{khusus int})
        
        $this->ddl->varchar("no_pendaftaran","not null",10);
        $this->ddl->typeData("tanggal_pendaftaran","datetime");
        $this->ddl->varchar("status_pendaftar","not null",10);
        $this->ddl->integer("id_pasien","not null",10);
        $this->ddl->varchar("nip","not null",10);

        /*
        $this->ddl->varchar("varchar","not null",10);
        $this->ddl->integer("int","not null",10,"","autoIncrement");
        $this->ddl->floats("float","default",10,6.5);
        $this->ddl->char("char","null");
        $this->ddl->text("text");
        $this->ddl->typeData("columnName","date", "null", 20,"autoIncrement");
        */

        $this->ddl->primaryKey("no_pendaftaran");
        $this->ddl->foreignKey("nip","tb_resepsionis","nip");
        //$this->ddl->unique("columnName");
        
        $this->ddl->createTable($this->tableName)->ready();
    }
    
    public function alter(){
        $this->ddl->alterTable($this->tableName)->addPrimaryKey("namaKolom");
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
