<?php
error_reporting(E_ALL);
require_once('./includes/db.class.php');
$db=new db();
$db->queryDB();


/** 
 * types of select to cover
 */
$db->select('*','bands'); //select * from table

$where=[["name","volbeat","!=","OR"],["type","irish punk","="]]; //column,value,comparisson type,connector
$db->select('*,name|newname','bands',$where);//select * from table where 1=1

/** 
 * types of insert to cover
 */

/**
 * types of update to cover
 */

/** 
 * types of delete to cover
 */


