<?php
namespace StoreFinder;

class Database {
	
	private $config = array(
		'host'	=> 'localhost',
		'username'	=> 'root',
		'password'	=> '',
		'dbname' => 'storefinder'
		);
	
	private $conn;
	
	public function __construct() 
	{
		try {
			$this->conn = new \PDO('mysql:host='.$this->config['host'].';dbname='.$this->config['dbname'], $this->config['username'], $this->config['password']);
			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(\PDO::ATTR_PERSISTENT, true);
			
		} catch (\PDOException $e) {
			echo 'Storefinder Error: '.$e->getMessage();
		}
	}
	
	public function find($center_lat,$center_lng,$radius) 
	{
		
		try {
			$stmt = $this->conn->prepare('SELECT address, name, lat, lng, ( 3959 * acos( cos( radians(:center_lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(:center_lng) ) + sin( radians(:center_lat) ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < :radius ORDER BY distance LIMIT 0 , 20');
			$params = array('center_lat' => $center_lat,'center_lng' => $center_lng,'radius' => $radius);

    		$stmt->execute($params);
			return $stmt->fetchAll();
		} catch (\PDOException $e) {
			echo 'Storefinder Error: '.$e->getMessage();
		}
	}
	
	public function get_stores() 
	{
		try {
			$stmt = $this->conn->prepare('SELECT * FROM markers');
    		$stmt->execute();
			return $stmt->fetchAll();
		} catch (\PDOException $e) {
			echo 'Storefinder Error: '.$e->getMessage();
		}	
	}
	
	public function add_store($name,$address,$lat,$lng) 
	{
		
	}	

}