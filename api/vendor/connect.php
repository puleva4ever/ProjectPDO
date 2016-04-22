<?php

function getDB(){
	$dbconf['driver']='mysql';
	$dbconf['dbhost']='localhost';
	$dbconf['dbname']='alorman_projectpdo'; // projectpdo
	$dbconf['dbuser']='alorman_root';		// root
	$dbconf['dbpass']='linuxlinux';			// no password
	$dsn=$dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
	$usr=$dbconf['dbuser'];
	$pwd=$dbconf['dbpass'];
	$conf['dsn']=$dsn;
	$conf['usr']=$usr;
	$conf['pwd']=$pwd;

	try{
		$dbh=new PDO($conf['dsn'],$conf['usr'],$conf['pwd']);
	}catch(PDOException $e){
		return null;
	}

	return $dbh;
}

?>