<?php

/**
 * Database class using PDO
 *
 * @author if then
 */

//include defaults
require_once('./includes/defaults.inc.php');

class db {
	private $dbhost=DBHOST;
    private $dbname=DBNAME;
    private $dbuser=DBUSER;
    private $dbpass=DBPASS;
	private $dbh;
	
	/*
	 * Connect to DB or throw exception
	 */
	public function __construct() {
		try{
			$this->dbh = new PDO("mysql:host=$this->dsbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function queryDB() {
		foreach($this->dbh->query("SELECT * FROM bands") as $row){
			echo $row['name'] .' - '. $row['type'] . '<br />';
		}
	}
	
	public function select($what,$from,$where){
		/*** prepare the SQL statement ***/
		$whereString="";
		foreach($where as $field=>$value){
			$whereString.=" ";
			$whereString.=$value['column']."=:".$value['column']." ".$value['param'];
		}
		$stmt = $this->dbh->prepare("SELECT $what FROM $from WHERE $whereString");
//
//		/*** bind the paramaters ***/
		foreach($where as $field=>$value){
			$stmt->bindParam(':'.$value['column'], $value['value']);
		}
//
//		/*** execute the prepared statement ***/
		$stmt->execute();
//
//		/*** fetch the results ***/
		$result = $stmt->fetchAll();
//
//		/*** loop of the results ***/
		
		foreach($result as $row)
			{
			echo $row['name'].'-';
			echo $row['type'].'<br />';
			}
//
//		/*** close the database connection ***/
//		$dbh = null;
	}
	
}
