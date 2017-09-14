<?php
namespace Aspen\Ultilities\Database;

class DatabaseConnectionFactory {
	public static $connection;
	public static function disconnect(){
		self::$connection = null;
		return self::$connection;
	}
	public static function connect(){
		self::$connection = new AspenPDO();
		return self::$connection;
	}
}