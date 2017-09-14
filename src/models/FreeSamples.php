<?php
namespace Aspen\Models;
use Aspen\Models\BaseModel;

class FreeSamples extends BaseModel {
	private $table='free_samples';

	/**
	 * @return array
	 */
	public function all() {
		$query = $this->db->prepare("select * from " . $this->table . " limit 10");
		$query->execute();
		$payload = $query->fetchAll();
		return $payload;
	}
}