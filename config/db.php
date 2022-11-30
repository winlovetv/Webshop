<?php
namespace Database;

use PDO;

error_reporting(0);
error_reporting(E_ALL); 
date_default_timezone_set('Asia/Bangkok');
class dbconnect {
    private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $dbName = "";

	protected $connect;

	public static function connect() {
		$dsn = "mysql:host=localhost;dbname=webshop;charset=utf8";
		$connect = new PDO($dsn, "root", "");
		$connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connect;
	}
}

?>
