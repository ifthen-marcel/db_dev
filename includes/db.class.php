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
	
	/**
	 * Connect to DB or throw exception
	 */
	public function __construct() {
		try{
			$this->dbh = new PDO("mysql:host=$this->dsbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	/**
	 * 'execute what I tell ya' function, use as little as possible
	 * @param type $query 
	 */
	public function queryDB($query) {
		$this->dbh->query($query);
	}
	
	/**
	 * 
	 * select function
	 * 
	 * @param String $what (comma separated column names [optionally followed by a pipe plus value to add an alias to]  or *)
	 * @param String $from (comma separated tablenames)
	 * @param Array $where (array containing sub-arrays per equation (column=>columnname, value=>value, param=>AND,OR)
	 */
	public function select($what,$from,$where){
		/* prepare the SQL statement */
		
		/*
		 * COLUMNS START
		 */
		
		$whatProc=array();//array to store columns in
		//split $what, add possible aliases and enclose by backticks
		$whatArr=explode(',',$what);
		foreach($whatArr as $k=>$v){
			if($v==='*'){//if 'all' just add to array 
				$whatProc[]=$v;
			}else{
				$whatTmp=explode('|',$v);
				if($whatTmp[1]){//if an alias is given add 'as' 
					$whatProc[]='`'.$whatTmp[0].'` as '.$whatTmp[1];
				}else{//else just add column name
					$whatProc[]='`'.$whatTmp[0].'`';
				}
			}
		}
		$whatString=implode(',',$whatProc);//implode array to create string for stmt
		
		/*
		 * WHERE START
		 */
		/** 
		 * @todo add feature to decide on compare (=, >, >=, != etc)
		 */
		$whereString="";
		foreach($where as $field=>$value){
			$whereString.=" ";//you can never add too much space, so we just add it to be sure ;-)
			$whereString.=$value['column']."=:".$value['column']." ".$value['param'];//remember, it's a prepared statement, so we add placeholders here, not the final value, that happens when we bind the parameters
		}
		$stmt = $this->dbh->prepare("SELECT $whatString FROM $from WHERE $whereString");//
		
		// bind the parameters (insert the values)
		foreach($where as $field=>$value){
			$stmt->bindParam(':'.$value['column'], $value['value']);
		}

		// finally execute the prepared statement 
		$stmt->execute();


/**
 *  TEST lines follow below
 */

		// fetch the results
		$result = $stmt->fetchAll();

		// loop through the results
		
		foreach($result as $row){
			echo $row['name'].'-';
			echo $row['type'].'<br />';
		}
	}
}
