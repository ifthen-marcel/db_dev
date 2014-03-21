<?php

/**
 * Description of db
 *
 * @author if then
 */

//include defaults
require_once('defaults.inc.php');

class db {
	private $dbhost=DBHOST;
    private $dbname=DBNAME;
    private $dbuser=DBUSER;
    private $dbpass=DBPASS;
	
	public function __construct() {
		try{
			$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
			echo 'Connected to database';
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
