<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\OtherQuery;
/**
 * Description of Dosen
 *
 * @author Irwansyah
 */
class QueryCustoming {
    //put your code here
    
    public function exe() {
        $other = new OtherQuery();
        
        $other->setQuery("create database SIHH");
        
        $other->execute($other->exeQuery());
    }
    
}

?>