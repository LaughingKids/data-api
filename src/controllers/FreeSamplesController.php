<?php
namespace Aspen\Controllers;
use Aspen\Models\FreeSamples;

class FreeSamplesController {
	public function __construct() {
		$this->model = new FreeSamples();
	}
	public function index($path) {
		$data['payload']['data'] = $path;
		$data['inner_code'] = 621002;
		return $data;
	}
}