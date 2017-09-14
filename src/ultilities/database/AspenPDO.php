<?php
namespace Aspen\Ultilities\Database;
use PDO;

class AspenPDO extends PDO{
	/**
	 * AspenPDO constructor.
	 *
	 * @param string $file
	 */
	function __construct( $file = __DIR__.'/../../config/db.conf' ) {
		if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
		$dns = $settings['driver'] .
		       ':host=' . $settings['host'] .
		       ((!empty($settings['port'])) ? (';port=' . $settings['port']) : '') .
		       ';dbname=' . $settings['schema'];
		parent::__construct($dns, $settings['user'], $settings['password']);
	}
}