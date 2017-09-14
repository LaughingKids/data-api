<?php
namespace Aspen\Models;
use Aspen\Ultilities\Database\DatabaseConnectionFactory;

abstract class BaseModel {
	public $perpage = 10;
	public $db;
	public function __construct(){
		$this->db = DatabaseConnectionFactory::connect();
	}
	/* creation*/
	public function create(){}
	/* update */
	public function update(){}
	/* readings */
	public function all($page){}
	public function findById($id){}
	public function count(){}
	/* delete */
	public function delete(){}
}