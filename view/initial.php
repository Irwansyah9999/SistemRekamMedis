<?php

/*
 * semua file yang digunakan di includekan pada file ini 
 * dari model controller dan getter, getter = class objek yang dibuat sendiri,
 * tata penulisannya,
 * "NamaKelas => directori pada file projek"
 */
class Initial{
    
    public $web = [
        'Model' => 'engine/abstraction',
        'Controller' => 'engine/abstraction',
        'BasicQuery' => 'engine/databases',
        'Database' => 'engine/databases',
        'Connection' => 'engine/databases',
        'QueryExp' => 'engine/databases',
        'DMLQuery' => 'engine/databases/order',
        
        'Response' => 'engine/http',
        'Request' => 'engine/http',
        'Route' => 'engine/http',
        'Session'=> 'engine/http',
        
        'ErrorCode'=>'engine/errors',
        'SessionError' => 'engine/errors',
        
        'Pagination'=>'engine/pagination',
        'filter'=>'engine/pagination',
        
        'Files' => 'engine/files',
        'JsonManipulation' => 'engine/utility',
        'ArrayManipulation' => 'engine/utility',
        'MysqlConnection' => 'engine/databases/driver',
        //'PosgreConnection' => 'engine/databases/driver',
        'Acces' => 'view'
    ]; //endEngine
    
    /*
     * class model include
     * 
     */
    public $model = [
        'ModelExample' => 'model',
	'Pasien' => 'model',
	'Dokter' => 'model',
	'User' => 'model',
	'Resepsionis' => 'model',
	'Pemeriksaan' => 'model',
	'PemeriksaanDetail' => 'model',
	'Pendaftaran' => 'model',
	'PendaftaranBaru' => 'model',
	'Staff' => 'model'
    ];// endModel
    
    /*
     * class controller include
     */
    public $controller = [
        'ControllerExample' => 'controller',
        'PasienController' => 'controller',
        'DokterController' => 'controller',
        'ResepsionisController' => 'controller',
        'UserController' => 'controller',
        'PemeriksaanController' => 'controller',
        'PemeriksaanDetailController' => 'controller',
        'PendaftaranController' => 'controller',
        'PendaftaranBaruController' => 'controller'
    ]; // endController
    
    /*
     * class getter include
     */
    public $getter = [
        
    ];// endGetter
   
    
    public function addInitial($param) {
        
    }
}
?>