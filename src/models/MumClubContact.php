<?php
namespace Aspen\Models;
use Aspen\Models\BaseModel;
use Exception;
use PDO;

class MumClubContact extends BaseModel {
	private $table='contacts';
	/**
	 * @return array
	 */
	public function all() {
		$query = $this->db->prepare("select * from " . $this->table . " limit 10");
		$query->execute();
		$payload = $query->fetchAll(PDO::FETCH_CLASS,  get_class($this) );
		for ( $index = 0; $index < $this->perpage; $index++ ) {
			unset($payload[$index]->perpage);
			unset($payload[$index]->db);
		}
		return $payload;
	}

	/**
	 * @param $id
	 */
	public function findById($id){
		$query = $this->db->prepare('select * from ' . $this->table . " where id=:userId");
		$query->execute(array('userId'=>$id));
		$club_member = $query->fetchObject( get_class($this) );
		unset($club_member->perpage);
		unset($club_member->db);
		return $club_member;
	}
}