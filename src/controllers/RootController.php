<?php

namespace Aspen\Controllers;

class RootController extends BaseController {
	public function __construct() {}
	/**
	 * @return mixed
	 */
	public function index(){
		return $this->errorDispature('path-not-exist','Path not exist');
	}
}