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
$db->select('*,test|tester,dorst','bands',$where);