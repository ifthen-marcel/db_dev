<?php
error_reporting(E_ALL);
require_once('./includes/db.class.php');
$db=new db();
$db->queryDB();
$where=array(
	array(
		"column"=>"name",
		"value"=>"volbeat",
		"param"=>"or"
		),
	array(
		"column"=>"type",
		"value"=>"irish punk",
		"param"=>""
		)
	);

/** 
 * types of select to cover
 */
$db->select('*','bands'); //select * from table
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


